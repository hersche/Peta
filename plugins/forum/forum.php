<?php
class forum extends plugin {

	private $currentUser;
	private $templateObject;
	private $connection;
	private $folder;
	private $id;
	/**
	 *
	 * Constructor
	 * @param array $post all the post-datas..
	 * @param array $get all the get-datas
	 * @param unknown_type $currentUser
	 * @param unknown_type $connection
	 */
	public function __construct($id, $currentUser, $templateObject, $folder, $connection) {
		$this->id = $id;
		$this -> currentUser = $currentUser;
		$this -> templateObject = $templateObject;
		$this -> connection = $connection;
		$this -> folder = $folder;
	}

	public function getPluginName() {
		return "forum.skamster";
	}
	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "This is a forum and a reference for testing the core.";
	}
	public function deleteInstanceTables(){
		$this -> connection -> exec("DROP TABLE IF EXIST `".$this->getDbPrefix()."forum_threads`");
	}
	public function getId(){
		return $this->id;
	}
	public function getRequiredDojo(){
		if(($_GET['action']=="reply") or ($_GET['action']=="createthreads") or ($_GET['action']=="editthread")){
			return array("dojo/parser","dijit.Editor","dojox.editor.plugins.Preview");
		}
		return Null;
	}
	public function start() {
		require_once $this->folder."forum.class.php";
		$this -> connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."forum_threads` (
			`forumid` int(11) NOT NULL AUTO_INCREMENT,
			`userid` int(11) NOT NULL,
			`title` text NOT NULL,
			`text` text NOT NULL,
			`timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			`toptopic` int(11) NOT NULL,
			`threadstate` int(5) NOT NULL DEFAULT '0',
			`editcounter` int(5) NOT NULL DEFAULT '0',
			PRIMARY KEY (`forumid`)
		)");
		$template = $this -> templateObject;
		$template->addTemplateDir($this->folder."forum/");
		$connection = $this -> connection;
		// $template -> assign("allcss", $this->folder."forum/css/sprrtrteech.css");
		$template -> assign("pluginId",$_GET['plugin']);
		$template -> assign("folder",$this->folder);
		$template->assign("ownuserid",$this->currentUser->getId());
		$threads = new allThreads($connection, $_SESSION["user"],$this->getDbPrefix());
		switch($_GET['action']) {
			case "createthread" :
				$dojorequire = array("dijit.Editor", "dojo.parser");
				$template -> assign("dojorequire", $dojorequire);
				$template -> assign("savemethod", "new");
				$template -> display($this->folder.'forumPlugin_createThread.tpl');
				break;
			case "reply" :
				$thread = $threads -> getThreadById($_GET['threadid']);
				if (!is_null($thread)) {
					$dojorequire = array("dijit.Editor", "dojo.parser");
					$template -> assign("dojorequire", $dojorequire);
					$template -> assign("threadid", $thread -> getId());
					$template -> assign("threadtitle", $thread -> getTitle());
					$template -> assign("savemethod", "reply");
					$template -> display($this->folder.'forumPlugin_reply.tpl');
				}
				break;
			case "deletethread":
				if(!empty($_GET['threadid'])){
					$threads->deleteThread($_GET['threadid'], true);
				}
				break;
			case "editthread" :
				$thread = $threads -> getThreadById($_GET['threadid']);
				if (!is_null($thread)) {
					if (($thread -> getUserId() == $this -> currentUser -> getId()) || (usertools::containRoles($GLOBALS["adminRoles"], $_SESSION["user"] -> getRoles()))) {
						$dojorequire = array("dijit.Editor", "dojo.parser");
						$template -> assign("dojorequire", $dojorequire);
						$template -> assign("threadid", $thread -> getId());
						$template -> assign("savemethod", "edit");
						$template -> assign("threadtitle", $thread -> getTitle());
						$template -> assign("title", $thread -> getTitle());
						$template -> assign("text", $thread -> getText());
						$template -> display($this->folder.'forumPlugin_edit.tpl');
					} else {
						$template -> assign("errorTitle", "You haven't enough rights or the thread doesn't exist");
						$template -> assign("errorDescription", "Please check your roles and verify that this thread exists!");
						$template -> display('error.tpl');
					}
				}
				break;
			case "savethread" :
				if ((!empty($_POST['topictitle'])) && (!empty($_POST['topictext'])) && ($_GET['savemethod'] == "new")) {
					$threads -> createNewThread($_POST['topictitle'], $_POST['topictext']);
					$template -> assign('threads', $threads -> getAllTopThreads());
					//array_push($messages, "Thread opened");
					$template -> assign('messages', $messages);
					$template -> display($this->folder.'forumPlugin.tpl');
					break;
				} else if ((!empty($_POST['topictext'])) && (!empty($_GET['threadid']))) {
					$thread = $threads -> getThreadById($_GET['threadid']);
					if ((!is_null($thread)) && (($thread -> getThreadState() == forumtools::$THREADACTIVE) || $admin)|| ($allowedAccess=="Admin")) {
						if (empty($_POST['topictitle'])) { $_POST['topictitle'] = "";
						}
						if ($_GET['savemethod'] == "reply") {
							// threadid means here the topthreadid
							$threads -> createNewThread($_POST['topictitle'], $_POST['topictext'], $_GET['threadid']);
						} else if ($_GET['savemethod'] == "edit") {
							$threads -> editThread($_POST['topictitle'], $_POST['topictext'], $thread -> getEditCounter() + 1, $_GET['threadid']);
							$threads -> changeThreadState($thread -> getId(), $_POST['state']);
						}
					}
				} else {
					$template -> assign('errorTitle', _("No data submitted"));
					$template -> assign('errorDescription', _("Please use the normal form"));
					$template -> display('error.tpl');
					break;
				}
				header("Location: plugin.php?plugin=".$_GET['plugin']."&action=showthread&threadid=" . $threads -> getTopThreadId($_GET['threadid']));
				break;
			case "showthread" :
				if (!empty($_GET['threadid'])) {
					$thread = $threads -> getThreadById($_GET['threadid']);
					if ((!is_null($thread)) && (($thread -> getThreadState() != forumtools::$THREADHIDDEN) || $admin)|| ($allowedAccess=="Admin")) {
						$template -> assign('threadTitle', $thread -> getTitle());
						$template -> assign('threadText', $thread -> getText());
						$template -> assign('threadage', $thread -> getTimestamp());
						$template -> assign('threadid', $thread -> getId());
						$template -> assign('username', $thread -> getUsername());
						$template -> assign('userid', $thread -> getUserId());
						if (isset($user)) {
							$template -> assign('ownuserid', $user -> getId());
						}
						$subthreads = $threads -> getSubThreads($thread -> getId(), $admin);
						$template -> assign('subthreads', $subthreads);
						$template -> display($this->folder.'forumPlugin_view.tpl');
					} else {
						$template -> assign('errorTitle', _("No thread found by this id!"));
						$template -> assign('errorDescription', _("There was no thread with this id."));
						$template -> display('error.tpl');
					}
				} else {
					$template -> assign('errorTitle', _("No thread-id was given"));
					$template -> assign('errorDescription', _("There was no id for a thread!"));
					$template -> display('error.tpl');
				}
				break;
			default :
				$template -> assign('show', $_POST['topictext']);
				$template -> assign('threads', $threads -> getAllTopThreads());
				$template -> display($this->folder.'/forumPlugin.tpl');
		}
	}

}
?>
<?php
require_once 'class/default.php';
require_once 'class/forum.php';
$threads = new allThreads($connection, $_SESSION["user"]);
switch($_GET['action']){
	case "createthread":
		$dojorequire = array("dijit.Editor", "dojo.parser");
		$template->assign("dojorequire", $dojorequire);
		$template->display('forum_createThread.tpl');
		break;
	case "reply":
		$thread = $threads->getThreadById($_GET['threadid']);
		if(!is_null($thread)){
			$dojorequire = array("dijit.Editor", "dojo.parser");
			$template->assign("dojorequire", $dojorequire);
			$template->assign("threadid", $thread->getId());
			$template->assign("threadtitle", $thread->getTitle());
			$template->display('forum_reply.tpl');
		}
		break;
	case "savethread":
		if((!empty($_POST['topictitle']))&&(!empty($_POST['topictext']))&&(empty($_GET['threadid']))){
			$threads->createNewThread($_POST['topictitle'], $_POST['topictext']);
			$template->assign('show', $_POST['topictext']);
			$template->assign('threads', $threads->getAllTopThreads());
			$template->display('forum.tpl');
			break;
		}
		else if((!empty($_POST['topictext']))&&(!empty($_GET['threadid']))){
			if (empty($_POST['topictitle'])){ $_POST['topictitle'] = ""; }
			$threads->createNewThread($_POST['topictitle'], $_POST['topictext'], $_GET['threadid']);
		}
		else{
			$template->assign('errorTitle', _("No data submitted"));
			$template->assign('errorDescription', _("Please use the normal form"));
			$template->display('error.tpl');
			break;
		}
		array_push($messages, _("Message saved!"));
		$template->assign('messages', $messages);
		#don't place a break here!!! it have to go to showthread!
	case "showthread":
		if(!empty($_GET['threadid'])){
			$thread = $threads->getThreadById($_GET['threadid']);
			if(!is_null($thread)){
				$template->assign('threadTitle', $thread->getTitle());
				$template->assign('threadText', $thread->getText());
				$template->assign('threadage', $thread->getTimestamp());
				$template->assign('threadid', $thread->getId());
				$template->assign('username', $thread->getUsername());
				$subthreads = $threads->getSubThreads($thread->getId());
				$template->assign('subthreads', $subthreads);
				$template->display('forum_view.tpl');
			}
			else{
				$template->assign('errorTitle', _("No thread found by this id!"));
				$template->assign('errorDescription', _("There was no thread with this id."));
				$template->display('error.tpl');
			}
		}
		else{
			$template->assign('errorTitle', _("No thread-id was given"));
			$template->assign('errorDescription', _("There was no id for a thread!"));
			$template->display('error.tpl');
		}
		break;
	default:
		$template->assign('show', $_POST['topictext']);
		$template->assign('threads', $threads->getAllTopThreads());
		$template->display('forum.tpl');
}


?>
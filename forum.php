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
	case "savethread":
		array_push($messages, "Message saved!");
		$template->assign('messages', $messages);
		$threads->createNewThread($_POST['topictitle'], $_POST['topictext']);
		$template->assign('show', $_POST['topictext']);
		$template->display('forum.tpl');
		break;
	default:
		$template->assign('show', $_POST['topictext']);
		$template->assign('threads', $threads->getAllTopThreads());
		$template->display('forum.tpl');
}


?>
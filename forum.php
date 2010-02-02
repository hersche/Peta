<?php
require_once 'class/default.php';

switch($_GET['action']){
	case "createthread":
		$dojorequire = array("dijit.Editor", "dojo.parser");
		$template->assign("dojorequire", $dojorequire);
		$template->display('forum_createThread.tpl');
		break;
	default:
		$template->assign('show', $_POST['blubb']);
		$template->display('forum.tpl');
}


?>
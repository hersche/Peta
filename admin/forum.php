<?php
require_once '../class/forum.php';
require_once 'default.php';
$allThreads = new allThreads($connection, $user);
/**
 * This is the site for managing the users as admin
 */
switch($_GET['action']){

	default:
		$template->assign("threads", $allThreads->getAllTopThreads());
		$template->display("forum.tpl");
		break;
	
}

?>
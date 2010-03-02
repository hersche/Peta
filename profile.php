<?php
require_once 'class/default.php';
switch($_GET['action']){
	case "edit":
		break;
	default:
		if(isset($_GET['userid'])){
			$user = usertools::getAlienUserbyId($_GET['userid'], $connection);
		}
		$template->assign("name", $user->getName());
		$template->assign("username", $user->getUsername());
		$template->display("profile.tpl");
		break;
}

?>
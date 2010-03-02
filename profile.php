<?php
require_once 'class/default.php';
switch($_GET['action']){
	case "edit":
		break;
	default:
		$template->assign("name", $_SESSION["user"]->getName());
		$template->assign("username", $_SESSION["user"]->getUsername());
		$template->assign("roles", $_SESSION["user"]->getRoles());
		$template->display("profile.tpl");
		break;
}

?>
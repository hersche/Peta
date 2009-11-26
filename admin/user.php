<?php
require_once 'default.php';

switch($_GET['action']){
	case "edituser":
		
		break;
	case "deleteuser":
		
		break;
	case "createuser":
		
		break;
		
	default:
	$users = admin::showUsers($connection);
	$template->assign("users", admin::extractFromArray($users, "username"));
	$template->display('user.tpl');	
}

?>
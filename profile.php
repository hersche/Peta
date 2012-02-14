<?php
require_once 'class/default.php';
switch($_GET['action']){
	case "edit":
		usertools::editUser($user->getId(), $_POST, $connection);
		$template->assign("username", $user->getUsername());
		
		$template->assign("roles", $user->getRoles());
		$template->display('profile_edit.tpl');
		break;
	default:
		if((isset($_GET['userid']))&&(usertools::userIdExists($_GET['userid'], $connection))&&($_GET['userid']!=$user->getId())){
			$user = usertools::getAlienUserbyId($_GET['userid'], $connection);
		}
		else{
			$template->assign("own", true);
			$template->assign("roles", $user->getRoles());
		}
		$template->assign("username", $user->getUsername());
		$template->display("profile.tpl");
		break;
}

?>
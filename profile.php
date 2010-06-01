<?php
require_once 'class/default.php';
switch($_GET['action']){
	case "edit":
		if((!empty($_POST['password']))&&(!empty($_POST['confirmpassword']))){
			if(($_POST['password']==$_POST['confirmpassword'])&&($_SESSION["user"]->getId()==$user->getId())){
				usertools::setPassword($_POST['username'], $_POST['password'], $connection);
			}
		}
		$template->assign("name", $user->getName());
		$template->assign("username", $user->getUsername());
		$template->assign("roles", $user->getRoles());
		$template->display('profile_edit.tpl');
		break;
	default:
		if((isset($_GET['userid']))&&(usertools::userIdExists($_GET['userid'], $connection))){
			$user = usertools::getAlienUserbyId($_GET['userid'], $connection);
		}
		$template->assign("name", $user->getName());
		$template->assign("username", $user->getUsername());
		if($_SESSION["user"]->getId()==$user->getId()){
			$template->assign("own", true);
			$template->assign("roles", $user->getRoles());
		}
		$template->display("profile.tpl");
		break;
}

?>
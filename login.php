<?php
require_once 'class/default.php';
if((isset($_SESSION['user']))&&($_SESSION['user']->isValid())){
	header("Location: index.php");
}
switch($_GET['action']) {
	case "register":
		if(!empty($_POST)){
			$_POST['role'] = "admin";
			array_push($messages, usertools::registerUser($_POST, $connection));
			$template->assign("messages", $messages);
		}
		$template->display('register.tpl');
		break;
	case "logout":
		$_SESSION["user"]->logout();
		header("Location: login.php");
		break;
	default:
		if((!empty($_POST['username']))&&(!empty($_POST['password']))){
			$user = new user($_POST['username'], $_POST['password'], $connection);
			if((isset($_SESSION["user"]))&&($user->isValid())){
				header("Location: index.php");
			}
			else{
				array_push($messages, _("Wrong Password or user"));
			}
		}
		$template->assign("messages", $messages);
		$template->display('login.tpl');
}

?>
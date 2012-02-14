<?php
require_once 'class/default.php';
if((isset($_SESSION['user']))&&($_SESSION['user']->isValid())){
	header("Location: index.php");
}
switch($_GET['action']) {
	case "register":
		if(!empty($_POST)){
			$userResult = usertools::registerUser($_POST, $connection);
			if($userResult=="0"){
				array_push($messages, $userResult);
				array_push($messages, "User ".$_POST['username']." was created successfull!");
				$template->assign("messages", $messages);
				$template->display('login.tpl');
				break;
			}
			else{
			array_push($messages, $userResult);
			$template->assign("messages", $messages);
			}
			
		}
		$template->display('register.tpl');
		break;
	case "logout":
		if(isset($_SESSION["user"])){
			$_SESSION["user"]->logout();
			header("Location: login.php");
		}
		else{
				$template->assign('errorTitle', "You couldn't logout without a user");
	$template->assign('errorDescription', "If you like to logout, please login first ;)");
	$template->display('error.tpl');
		}
		break;
	default:
		if((!empty($_POST['username']))&&(!empty($_POST['password']))){
			$user = new user($_POST['username'], $_POST['password'], $connection);
			if((isset($_SESSION["user"]))&&($user->isValid())){
				array_push($messages, $user->getUrow());
				$template->assign("messages", $messages);
				$template->display('index.tpl');
				break;
			}
			else{
				array_push($messages, _("Wrong Password or user"));
			}
		}
		$template->assign("messages", $messages);
		$template->display('login.tpl');
}

?>
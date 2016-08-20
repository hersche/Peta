<?php
require_once 'class/default.php';
if((isset($_SESSION['user']))&&($_SESSION['user']->isValid())){
	header("Location: index.php");
}
$template->assign("registration", $GLOBALS['registration']);
switch($_GET['action']) {
	case "register":
		if(!empty($_POST)){
			$userResult = usertools::registerUser($_POST, $connection);
			if($userResult=="0"){
				$messages[] = "User ".$_POST['registerUsername']." was created successfull!";
				$template->assign("messages", $messages);
				$template->display('login.tpl');
				break;
			}
			else{
				var_dump($userResult);
				$messages[] = $userResult;
				$template->assign("messages", $messages);
				$template->assign('errorTitle', "ERROR! Registration failed!");
				$template->assign('errorDescription', "There was a failure on registration. Description: ".$userResult);
				$template->display('error.tpl');
				die();
			}
			
		}
		$template->display('login.tpl');
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
		$template->assign("messages", $messages);
		$template->display('login.tpl');
}

?>
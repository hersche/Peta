<?php
require_once 'class/default.php';
if((isset($_SESSION['user']))&&($_SESSION['user']->isValid())){
	header("Location: index.php");
}
switch($_GET['action']) {
	case "register":
		if((!empty($_POST['name']))&&(!empty($_POST['username']))&&(!empty($_POST['password']))&&(!empty($_POST['password2']))){
			if($_POST["password"]==$_POST["password2"]){
				// FIXME use default-value from db for role!
				array_push($messages, usertools::registerUser($_POST["name"], $_POST["username"], $_POST["password"], 1, $connection));
			}
			else{
				array_push($messages, _("Passwords doesn't match"));
			}
		}
		$template->assign("messages", $messages);
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
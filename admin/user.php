<?php
require_once 'default.php';
$users = admin::getUsers($connection);
switch($_GET['action']){
	case "edituser":
		if(!empty($_POST['editusername'])){
			$_SESSION['editUser'] = admin::getUser($_POST["editusername"], $users);
		}
		$template->assign("name", $_SESSION['editUser']["name"]);
		$template->assign("username", $_SESSION['editUser']["username"]);
		$template->assign("messages", $messages);
		$template->display('users_edituser.tpl');
		break;
	case "deleteuser":

		break;
	case "createuser":
		$template->assign("messages", $messages);
		$template->display('users_createuser.tpl');
		break;

	case "mkedit":
		if($_POST['sure']=="on"){
			if($_POST['password']==$_POST['password2']){
				$newUser = array("name"=>$_POST['name'], "password"=>hash($GLOBALS["password_hash"], $_POST['password']));
				usertools::editUser($_SESSION['editUser'], $newUser, $connection);
				array_push($messages, "Changes where successfull for user ".$_SESSION['editUser']['username']);
			}
			else{
				array_push($messages, "Passwords don't match!");
			}
		}
		unset($_SESSION['editUser']);
		break;



}

if((!isset($_GET['action']))||($_GET['action']=="mkedit")){
			$template->assign("messages", $messages);
		$template->assign("users", admin::extractFromArray($users, "username"));
		$template->display('user.tpl');
}

?>
<?php
require_once 'default.php';
/**
 * This is the site for managing the users as admin
 */
switch($_GET['action']){
	case "edituser":
		if(!empty($_POST['editusername'])){
			// TODO find a way to kill this session!
			$_SESSION['editUser'] = admin::getUser($_POST["editusername"], admin::getUsers($connection));
		}
		$template->assign("name", $_SESSION['editUser']["name"]);
		$template->assign("roles", admin::extractFromArray(admin::getRoles($connection), "role"));
		$template->assign("selectRole", $_SESSION['editUser']["role"]);
		$template->assign("username", $_SESSION['editUser']["username"]);
		$template->assign("messages", $messages);
		$template->display('users_edituser.tpl');
		break;
	case "deleteuser":

		break;
	case "createuser":
		$template->assign("roles", admin::extractFromArray(admin::getRoles($connection), "role"));
		$template->assign("messages", $messages);
		$template->display('user_createuser.tpl');
		break;

	case "mkedit":
		if($_POST['sure']=="on"){
			if($_POST['password']==$_POST['password2']){
				$roleid;
				foreach(admin::getRoles($connection) as $role){
					if($role['role'] == $_POST['role']){
						$roleid = $role['roleid'];
					}
				}
				$newUser = array("name"=>$_POST['name'], "password"=>$_POST['password'], "broleid" => $roleid);
				usertools::editUser($_SESSION['editUser'], $newUser, $connection);
				array_push($messages, "Changes where successfull for user ".$_SESSION['editUser']['username']);
			}
			else{
				array_push($messages, "Passwords don't match!");
			}
		}
		unset($_SESSION['editUser']);
		break;

	case "mkuser":
		if((!empty($_POST['username']))&&(!empty($_POST['name']))){
			if($_POST['password']==$_POST['password2']){
				foreach(admin::getRoles($connection) as $role){
					if($role['role'] == $_POST['role']){
						$roleid = $role['roleid'];
					}
				}
				array_push($messages, usertools::registerUser($_POST['username'], $_POST['name'], $_POST['password'], $roleid, $connection));
			}
		}
		break;



}

if((!isset($_GET['action']))||($_GET['action']=="mkedit")||($_GET['action']=="mkuser")){
	$template->assign("messages", $messages);
	$users = admin::getUsers($connection);
	$template->assign("users", admin::extractFromArray($users, "username"));
	$template->display('user.tpl');
}

?>
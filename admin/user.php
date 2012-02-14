<?php
require_once 'default.php';
/**
 * This is the site for managing the users as admin
 */
switch($_GET['action']){
	case "edituser":
		if(!empty($_POST['editusername'])){
			$editUser = usertools::getAlienUserbyUsername($_POST["editusername"], $connection);
		}
		$template->assign("name", $editUser->getName());
		$template->assign("roles", admin::extractFromArray(admin::getRoles($connection), "role"));
		$template->assign("selectRole", $editUser->getRole());
		$template->assign("username", $editUser->getUsername());
		$template->assign("userid", $editUser->getId());
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
				usertools::editUser($_GET['userid'], $_POST, $connection);
				array_push($messages, "Changes where successfull for user ".$_SESSION['editUser']['username']);
			}
			else{
				array_push($messages, "Passwords don't match!");
			}
		}
		break;

	case "mkuser":
//		if((!empty($_POST['username']))&&(!empty($_POST['name']))){
//			if($_POST['password']==$_POST['password2']){
//				foreach(admin::getRoles($connection) as $role){
//					if($role['role'] == $_POST['role']){
//						$roleid = $role['roleid'];
//					}
//				}
//				array_push($messages, usertools::registerUser($_POST['username'], $_POST['name'], $_POST['password'], $roleid, $connection));
//			}
//		}

		array_push($messages, usertools::registerUser($_POST, $connection));
		break;



}

if((!isset($_GET['action']))||($_GET['action']=="mkedit")||($_GET['action']=="mkuser")){
	$template->assign("messages", $messages);
	$users = admin::getUsers($connection);
	$template->assign("users", admin::extractFromArray($users, "username"));
	$template->display('user.tpl');
}

?>
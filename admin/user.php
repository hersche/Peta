<?php
require_once 'default.php';
/**
 * This is the site for managing the users as admin
 */
switch($_GET['action']) {
	case "edituser" :
		if (!empty($_POST['editusername'])) {

			$messages[] = $_POST['editusername'];
			$editUser = usertools::getAlienUserbyUsername($_POST["editusername"], $connection);
			$template -> assign("selectedRoles", $editUser -> getRoles());
			$template -> assign("username", $editUser -> getUsername());
			$template -> assign("userid", $editUser -> getId());
			$restRoles = array();
			foreach(usertools::mkRoleObjects(admin::getRoles($connection)) as $role){
				$notFound = True;
				foreach($editUser -> getRoles() as $userrole){
					if($userrole->getId()==$role->getId()){
						$notFound = False;
					}
					//print_f($role->getId());
				}
				if($notFound){
					array_push($restRoles, $role);
				}
			}
			$template -> assign("restRoles", $restRoles);
			$template -> assign("messages", $messages);
			$template -> display('users_edituser.tpl');
		}
		break;
	case "deleteuser" :
		break;
	case "createuser" :
		$template -> assign("roles", admin::extractFromArray(admin::getRoles($connection), "role"));
		$template -> assign("messages", $messages);
		$template -> display('user_createuser.tpl');
		break;

	case "mkedit" :
		if ($_POST['sure'] == "on") {

			if ($_POST['password'] == $_POST['password2']) {
				usertools::editUser($_GET['userid'], $_POST, $connection);
				$messages[] = "Changes where successfull for user " . $_SESSION['editUser']['username'];
			} else {
				$messages[] = "Passwords don't match!";
			}
		}
		break;

	case "mkuser" :
		$messages[] = usertools::registerUser($_POST, $connection);
		break;
}

if ((!isset($_GET['action'])) || ($_GET['action'] == "mkedit") || ($_GET['action'] == "mkuser")) {
	$template -> assign("messages", $messages);
	$users = admin::getUsers($connection);
	$template -> assign("users", admin::extractFromArray($users, "username"));
	$template -> display('user.tpl');
}
?>
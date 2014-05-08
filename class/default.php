<?php
/**
 * Code for the most sites for the beginning...
 */

require_once 'config.php';
date_default_timezone_set($GLOBALS["timezone"]);
require_once 'class/role.php';
require_once 'class/user.php';
require_once 'class/plugin.php';
require_once 'class/smarty/Smarty.class.php';
$messages = array();
$allcss = array();
$template = new Smarty();
$template -> addTemplateDir("plugins/");
$jsscripts = array();
$dojorequire = array();
session_start();

//SECURE SQL-INJECTION
function sqlsec($value) {
	$search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
	$replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

	return str_replace($search, $replace, $value);
}

//This stops SQL Injection in POST vars
foreach ($_POST as $key => $value) {
	$_POST[$key] = sqlsec($value);
}

//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
	$_GET[$key] = sqlsec($value);
}

try {
	$connection = new PDO($GLOBALS["db_type"] . ':dbname=' . $GLOBALS["db_dbname"] . ';host=' . $GLOBALS["db_host"] . '', $GLOBALS["db_loginname"], $GLOBALS["db_loginpassword"]);
} catch (PDOException $e) {
	array_push($messages, $e -> getMessage());
	$template -> assign('messages', $messages);
	$template -> assign('errorTitle', "DB-Failure");
	$template -> assign('errorDescription', "There was a DB-Failure! Please check the username and the password in config.php!");
	$template -> display('error.tpl');
	die();
}
if ($connection -> query("SHOW TABLES LIKE 'role'") -> rowCount() == 0) {
	$connection -> exec("CREATE TABLE IF NOT EXISTS `role` (
				`rid` int(11) NOT NULL AUTO_INCREMENT,
				`role` text NOT NULL,
				`r_admin` tinyint(1) NOT NULL,
				PRIMARY KEY (`rid`)
			)");
	$connection -> exec("INSERT INTO role (`role`,`r_admin`) VALUES ('admin', 1);");
	$connection -> exec("INSERT INTO role (`role`,`r_admin`) VALUES ('default', 1);");
	$connection -> exec("INSERT INTO role (`role`,`r_admin`) VALUES ('normal', 1);");

	// not table exist
}

		if((!empty($_POST['loginUsername']))&&(!empty($_POST['loginPassword']))){
			$user = new user($_POST['loginUsername'], $_POST['loginPassword'], $connection);
			$template -> assign("allowedPluginInstances", $allowedPluginInstances);
			
			if((isset($_SESSION["user"]))&&($user->isValid())){
				if($user->getWelcome()){
				  $messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
				  $user->disableWelcome();
				}
			}
			else{
				$messages[] = "Wrong Password or user";
			}
		}

if (isset($_SESSION["user"])) {
	if ((usertools::containRoles($GLOBALS["adminRoles"], $_SESSION["user"] -> getRoles()))) {
		$template -> assign("admin", true);
		$admin = true;
	}
	$user = $_SESSION["user"];
    if($admin){
        $user->setAdmin(true);
    }
	$template -> assign("user", $user);
}

if ($user == Null) {
	$user = new alienuser();
	$user -> setId(-1);
	$user -> setUsername("Public");
	$role = new role();
	$role -> setId(-1);
	$role -> setRole("Public");
	$user -> addRoleToRam($role);
	$_SESSION["user"] = $user;
	$template -> assign("user", $user);
}

$instancedPluginManager = new instancedPluginManager($user, $template, $connection);
$allowedPluginInstances = array();
$pluginInstance = Null;
$allowed = False;
$allowedAccess = "Null";
$fn = basename($_SERVER['PHP_SELF']);
foreach ($instancedPluginManager->getInstancedPlugins() as $pI) {
	foreach ($user->getRoles() as $uRole) {
		foreach ($pI->getUsedRoles() as $pRole) {
			if ($pRole -> getId() == $uRole -> getId()) {
				if (!in_array($pI, $allowedPluginInstances)) {
					array_push($allowedPluginInstances, $pI);
				}
				if ($_GET['plugin'] == $pI -> getId()) {
					$allowedAccess = $pRole -> getAccesRightsString();
					$template -> assign("allowedAccess", $allowedAccess);
					$allowed = True;
				}

				if (($_GET['rawPluginName'] == $pI -> getClassName()) && ($_GET['editPluginId'] == $pI -> getId())) {
					$paccess = $pRole -> getAccesRightsString();
					if ($paccess == "Admin") {
						$allowedAccess = $paccess;
					} elseif (($allowedAccess != "Admin") && ($paccess == "ReadWrite")) {
						$allowedAccess = $paccess;
					} elseif (($allowedAccess != "Admin") && ($allowedAccess != "ReadWrite") && ($paccess == "Read")) {
						$allowedAccess = $paccess;
					}
					$allowedAccess = $pRole -> getAccesRightsString();
					$template -> assign("allowedAccess", $allowedAccess);
					$allowed = True;
				}
			}
		}
	}
	if ($_GET['plugin'] == $pI -> getId()) {
		$pluginInstance = $pI;
	}
}
$user->setPluginAccess($allowedAccess);
$template -> assign("allowedPluginInstances", $allowedPluginInstances);
if (($pluginInstance != Null)&&($pluginInstance->getActive()==1)) {
    try{
	   $plugin = $pluginInstance -> getInstance();
    } catch (Exception $e) {
	   $template -> assign('messages', $messages);
	   $template -> assign('errorTitle', "Plugin-Failure");
	   $template -> assign('errorDescription', "There was a pluginfailure! Message: ".$e->getMessage());
	   $template -> display('error.tpl');
	   die();
    }
	$template -> assign("pluginInstance", $pluginInstance);
	$template -> assign("plugin", $plugin);

}

if ($user -> getUsername() == "Public") {
	if ($allowed) {
		//Hay!
	} else {
		if (($fn != "login.php")&&($fn != "profile.php")) {
			header("Location: login.php");
		}
	}

} elseif ((isset($_GET['plugin'])) && ($user -> getUsername() != "Public")) {
	if ($allowed) {
		//Hay!
	} else {
		array_push($messages, "You have no access to this plugin.");
		$template -> assign('messages', $messages);
		//$template->assign('errorTitle', "Plugin-Failure");
		//$template->assign('errorDescription', "Permission denied. What are u trying, dude?");
		//$template->display('error.tpl');
		//die();
	}
}
if ((isset($_GET['plugin'])) && ($pluginInstance == Null) && ($fn != "login.php") && ($fn != "index.php") && ($fn != "profile.php")) {
	array_push($messages, "No plugin found with your id, site is ".fn);
	$template -> assign('messages', $messages);
	$template -> assign('errorTitle', "Plugin-Failure");
	$template -> assign('errorDescription', "There was a pluginfailure! 404NotFound!");
	$template -> display('error.tpl');
	die();

}
?>
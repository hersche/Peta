<?php
/**
 * Code for the most sites for the beginning...
 */

require_once 'config.php';
date_default_timezone_set($GLOBALS["timezone"]);
require_once 'class/user.php';
require_once 'class/plugin.php';
require_once 'class/smarty/Smarty.class.php';
$messages = array();
$allcss = array();
$template = new Smarty();
$template->addTemplateDir("plugins/");
$jsscripts = array();
$dojorequire = array();
session_start();
try
{
	$connection = new PDO($GLOBALS["db_type"].':dbname='.$GLOBALS["db_dbname"].';host='.$GLOBALS["db_host"].'', $GLOBALS["db_loginname"], $GLOBALS["db_loginpassword"]);
}
catch (PDOException $e)
{
	array_push($messages, $e->getMessage());
	$template->assign('messages', $messages);
	$template->assign('errorTitle', "DB-Failure");
	$template->assign('errorDescription', "There was a DB-Failure! Please check the username and the password in config.php!");
	$template->display('error.tpl');
	die();
}
/**
 * @param unknown_type $url
 */
function checkNoNeedForLogin($url, $connection){
	foreach($connection->query('SELECT * FROM `config_loginneedlesssites` LIMIT 0 , 30') as $row){
		if(preg_match($row['site'], $url)){
			return true;
		}
	}
	return false;
}
//when user is public.. disabled for now.
if((!isset($_SESSION["user"]))&&(basename($_SERVER['PHP_SELF'])!="login.php")){
	//if(!checkNoNeedForLogin(basename($_SERVER['REQUEST_URI']), $connection)){
		header("Location: login.php");
	//}
}
else{
	if((isset($_SESSION["user"]))&&(usertools::containRoles($GLOBALS["adminRoles"], $_SESSION["user"]->getRoles()))){
		$template->assign("admin", true);
		$admin = true;
	}
	$user = $_SESSION["user"];
}



?>
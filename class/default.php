<?php
/**
 * Code for the most sites for the beginning...
 */
require_once 'config.php';
require_once 'class/user.php';
require_once 'class/smarty/Smarty.class.php';
$template = new Smarty();
session_start();
if((!isset($_SESSION["user"]))&&(basename($_SERVER['PHP_SELF'])!="login.php")){
	header("Location: login.php");
}
else{
	if((isset($_SESSION["user"]))&&(usertools::containRoles($GLOBALS["adminRoles"], $_SESSION["user"]->getRoles()))){
		$template->assign("admin", true);
	}
}
//setlocale(LC_MESSAGES, 'de_DE.utf8');
//bindtextdomain("*", "./locale");
//bind_textdomain_codeset("LearnCards", 'UTF-8'); 
//textdomain("LearnCards");
require('class/smarty/plugins/block.t.php');
$template->register_block('t', 'smarty-translate');
$messages = array();
try
{
	$connection = new PDO($GLOBALS["db_type"].':dbname='.$GLOBALS["db_dbname"].';host='.$GLOBALS["db_host"].'', $GLOBALS["db_loginname"], $GLOBALS["db_loginpassword"]);
}
catch (PDOException $e)
{
	array_push($messages, $e->getMessage());
}

?>
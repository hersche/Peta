<?php 
/**
 * Code for the most sites for the beginning...
 */
require_once 'config.php';
require_once 'class/user.php';
session_start();
require_once 'class/smarty/Smarty.class.php';

$template = new Smarty();
$template->assign("jsscripts", array("dojo/dojo/dojo.js", "js/extras.js"));
$messages = array();
$objDb;
		try
		{
			$connection = new PDO($GLOBALS["db_type"].':dbname='.$GLOBALS["db_dbname"].';host='.$GLOBALS["db_host"].'', $GLOBALS["db_loginname"], $GLOBALS["db_loginpassword"]);
		}
		catch (PDOException $e)
		{
			array_push($messages, $e->getMessage());
		}


?>
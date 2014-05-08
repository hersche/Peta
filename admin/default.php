<?php
require_once '../config.php';
require_once '../class/role.php';
require_once '../class/user.php';
require_once '../class/plugin.php';
require_once 'class/admin.php';
session_start();

date_default_timezone_set($GLOBALS["timezone"]);
if ((!isset($_SESSION["user"])) && (basename($_SERVER['PHP_SELF']) != "login.php")) {
	header("Location: ../login.php");
} else {
	$user = $_SESSION["user"];
	if (!usertools::containRoles($GLOBALS["adminRoles"], $_SESSION["user"] -> getRoles())) {
		die("Access denied! You must be in a admingroup!");
	}
}
require_once '../class/smarty/Smarty.class.php';

$template = new Smarty();
$template -> assign("jsscripts", array("dojo/dojo/dojo.js", "js/extras.js"));
$template -> assign("allcss", array("css/default.css"));
$messages = array();
$objDb;
try {
	$connection = new PDO($GLOBALS["db_type"] . ':dbname=' . $GLOBALS["db_dbname"] . ';host=' . $GLOBALS["db_host"] . '', $GLOBALS["db_loginname"], $GLOBALS["db_loginpassword"]);
} catch (PDOException $e) {
	array_push($messages, $e -> getMessage());
}
?>
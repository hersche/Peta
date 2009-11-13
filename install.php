<?php
require_once 'class/core.php';
$dbclass = new mysql_class();
$db = $dbclass->my_connect($GLOBALS["db_loginname"], $GLOBALS["db_loginpassword"], $GLOBALS['db_dbname'], $GLOBALS['db_host'], $GLOBALS['db_type']);
// $db->
?>
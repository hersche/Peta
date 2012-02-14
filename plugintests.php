<?php
include_once 'class/plugin.php';

$pluginmanager = new pluginmanager($_POST);
$pluginlist = $pluginmanager->getPlugins();
$connection = "dsfa";
foreach ($pluginlist as $plugin){
	echo $plugin->getPluginName()."<br />";
}
?>
<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

$pluginmanager = new pluginmanager($user,$template, $connection);

$tmpPluginNames = array();
$tmpPluginPaths = array();
foreach($pluginmanager->getRawPlugins() as $rawPlugin){
	array_push($tmpPluginNames, $rawPlugin->getName());
	array_push($tmpPluginPaths, $rawPlugin->getPath());
}
$template->assign("rawPluginNames", $tmpPluginNames);
$template->assign("rawPluginPaths", $tmpPluginPaths);

if(isset($_GET['rawPluginName'])){
$rawPlugin = $pluginmanager->getRawPluginByName($_GET['rawPluginName']);
require_once $rawPlugin->getPath();
$className = $rawPlugin->getName();
$instancedPluginManager = new instancedPluginManager($connection,$template,$currentUser);
// var_dump($instancedPluginManager);
//$instancedPlugin = $instancedPluginManager->getInstancedPluginByClassName($className);
//$plugin = $instancedPlugin->getInstance();
$template->assign("instancedPlugin", $instancedPlugin);
$template->assign("rawPlugin", $rawPlugin);
}


$template->assign("plugins", $pluginmanager->getPlugins());
if (isset($_GET['plugin'])){

	$plugin = $pluginmanager->getPluginbyid($_GET['plugin']);
	$template->assign("identifier", $plugin->getIdentifier());
	$template->assign("plugin", $plugin);
	// $messages[] = $plugin->getPluginName();
}


if($_GET['action'] == "getPluginEdit"){
	// var_dump($rawPlugin);
	$rawPluginName['name'] = $_GET['rawPluginName'];
	$rawPlugin = $pluginmanager->getRawPluginByName($_GET['rawPluginName']);
	$rawPluginName['path'] = $rawPlugin->getPath();
	$template->assign("getPluginEdit", $rawPluginName);
}
if(isset($_POST['createInstancedPlugin'])){
	// $plugin = 
}
// $var = array("content");
// $template->_smarty_include("plugins/exampleplugin/templates/content.tpl", $var);
$template->assign("messages", $messages);
$template->display('plugin.tpl');
?>
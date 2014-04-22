<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

$pluginmanager = new rawIOPluginManager($user,$template, $connection);
$instancedPluginManager = new instancedPluginManager($user,$template, $connection);

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
	
	//Just get the description - for that we have to init one plugin of this kind (empty, NOT START IT!)
	$instance = new $className("","","","",$connection);
	if(isset($instance)){
		$template->assign("rawPluginDescription",$instance->getPluginDescription());
	}
	
	$template->assign("instancedPlugin", $instancedPlugin);
	$template->assign("instancedPluginList", $instancedPluginManager->getInstancedPluginList($className));
	$template->assign("rawPlugin", $rawPlugin);
	
}


$template->assign("plugins", $pluginmanager->getPlugins());
if (isset($_GET['plugin'])){
	$pluginInstance = $instancedPluginManager->getInstancedPluginById($_GET['plugin']);
	$plugin = $pluginInstance->getInstance();
	$template->assign("plugin", $plugin);
	if($plugin->getRequiredDojo() != Null){
		$template->assign("dojorequire", $plugin->getRequiredDojo());
	}
	
	// $messages[] = $plugin->getPluginName();
}

if($_GET['action'] == "pluginInstanceDelete"){
	$pluginInstance = $instancedPluginManager->getInstancedPluginById($_GET['plugId']);
	$pluginInstance->delete();
}
if($_GET['action'] == "getPluginEdit"){
	// var_dump($rawPlugin);
	$rawPluginName['name'] = $_GET['rawPluginName'];
	$rawPlugin = $pluginmanager->getRawPluginByName($_GET['rawPluginName']);
	$rawPluginName['path'] = $rawPlugin->getPath();
	$rawPluginName['className'] = $rawPlugin->getName();
	$template->assign("getPluginEdit", $rawPluginName);
}
if($_GET['action'] == "editPluginInstance"){
	$pluginInstance = $instancedPluginManager->getInstancedPluginById($_GET['pluginId']);
	$pluginInstance->edit();
}
if($_GET['action'] == "createInstancedPlugin"){
	//var_dump($_GET);
	$newInstPlugin = $instancedPluginManager->createInstancedPlugin($_GET['name'], $_GET['description'], $_GET['path'], $_GET['className'],$_GET['active']);
	
}

// $var = array("content");
// $template->_smarty_include("plugins/exampleplugin/templates/content.tpl", $var);
$template->assign("messages", $messages);
$template->assign("plugins", $instancedPluginManager->getInstancedPlugins());
$template->display('plugin.tpl');
?>
<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

$pluginmanager = new rawIOPluginManager($user,$template, $connection);


$tmpPluginNames = array();
$tmpPluginPaths = array();
foreach($pluginmanager->getRawPlugins() as $rawPlugin){
	array_push($tmpPluginNames, $rawPlugin->getName());
	array_push($tmpPluginPaths, $rawPlugin->getPath());
}
$template->assign("rawPluginNames", $tmpPluginNames);
$template->assign("rawPluginPaths", $tmpPluginPaths);



if((isset($_GET['rawPluginName']))&&(!isset($_GET['editPluginId']))){
			var_dump($allowedAccess);
			$rawPluginName['name'] = $_GET['rawPluginName'];
			$rawPlugin = $pluginmanager->getRawPluginByName($_GET['rawPluginName']);
			$rawPluginName['path'] = $rawPlugin->getPath();
			$rawPluginName['className'] = $rawPlugin->getName();
			$template->assign("getPluginEdit", $rawPluginName);
		if(($allowedAccess=="Admin")||($admin)){
			$rawPlugin = $pluginmanager->getRawPluginByName($_GET['rawPluginName']);
			require_once $rawPlugin->getPath();
			$className = $rawPlugin->getName();
	
			//Just get the description - for that we have to init one plugin of this kind (empty, NOT START IT!)
			$instance = new $className("","","","",$connection);
			if(isset($instance)){
				$template->assign("rawPluginDescription",$instance->getPluginDescription());
			}
	
			$template->assign("instancedPluginList", $instancedPluginManager->getInstancedPluginList($className));
			$template->assign("rawPlugin", $rawPlugin);
		}
		else{
			//array_push($messages, "Not allowed to edit here!");
		}
}

if((isset($_GET['rawPluginName']))&&(isset($_GET['editPluginId']))){
		var_dump($allowedAccess);
		if(($allowedAccess=="Admin")||($admin)){
			$rawPlugin = $pluginmanager->getRawPluginByName($_GET['rawPluginName']);
			require_once $rawPlugin->getPath();
			$className = $rawPlugin->getName();
			
			//Just get the description - for that we have to init one plugin of this kind (empty, NOT START IT!)
			$instance = new $className("","","","",$connection);
			if(isset($instance)){
				$template->assign("rawPluginDescription",$instance->getPluginDescription());
			}
	
			$template->assign("instancedPlugin", $instancedPluginManager->getInstancedPluginById($_GET['editPluginId']));
			$template->assign("rawPlugin", $rawPlugin);
		}
		else{
			//array_push($messages, "Not allowed to edit here!");
		}
}

$template->assign("plugins", $pluginmanager->getPlugins());

if($_GET['action'] == "pluginInstanceDelete"){
	$pluginInstance = $instancedPluginManager->getInstancedPluginById($_GET['plugId']);
	$pluginInstance->delete();
}
if($_GET['action'] == "editPluginInstance"){
	$pluginInstance = $instancedPluginManager->getInstancedPluginById($_GET['pluginId']);
	$pluginInstance->edit();
}
if($_GET['action'] == "createInstancedPlugin"){
	$newInstPlugin = $instancedPluginManager->createInstancedPlugin($_GET['name'], $_GET['description'], $_GET['path'], $_GET['className'],$_GET['active']);
	
}
$template->assign("messages", $messages);
$template->assign("plugins", $instancedPluginManager->getInstancedPlugins());
$template->display('pluginEdit.tpl');
?>
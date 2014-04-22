<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

$pluginmanager = new rawIOPluginManager($user,$template, $connection);



if (isset($_GET['plugin'])){
	
	if($plugin->getRequiredDojo() != Null){
		$template->assign("dojorequire", $plugin->getRequiredDojo());
	}
	if($plugin->getRequiredCss() != Null){
		$template->assign("allcss", $plugin->getRequiredCss());
	}
	if($plugin->getOnLoadCode() != Null){
		$template->assign("onLoadCode", $plugin->getOnLoadCode());
	}
	// $messages[] = $plugin->getPluginName();
}

// $var = array("content");
// $template->_smarty_include("plugins/exampleplugin/templates/content.tpl", $var);
$template->assign("messages", $messages);
$template->assign("plugins", $instancedPluginManager->getInstancedPlugins());
$template->display('plugin.tpl');

?>
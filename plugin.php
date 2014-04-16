<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

$pluginmanager = new pluginmanager($user,$template, $connection);

$template->assign("plugins", $pluginmanager->getPlugins());
if (isset($_GET['plugin'])){
	$plugin = $pluginmanager->getPluginbyid($_GET['plugin']);
	$template->assign("identifier", $plugin->getIdentifier());
	$template->assign("plugin", $plugin);
	// $messages[] = $plugin->getPluginName();
}
// $var = array("content");
// $template->_smarty_include("plugins/exampleplugin/templates/content.tpl", $var);
$template->assign("messages", $messages);
$template->display('plugin.tpl');
?>
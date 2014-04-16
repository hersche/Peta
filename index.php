<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

$pluginmanager = new pluginmanager($_GET, $_POST, $user, $connection);

$template->assign("plugins", $pluginmanager->getPlugins());
if (isset($_GET['plugin'])){
	$plugin = $pluginmanager->getPluginbyid($_GET['plugin']);
	$messages[] = $plugin->getPluginName();
}
// $var = array("content");
// $template->_smarty_include("plugins/exampleplugin/templates/content.tpl", $var);
$template->assign("messages", $messages);
$template->display('index.tpl');
?>
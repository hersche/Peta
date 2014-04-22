<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}
$template->assign("messages", $messages);
$template->display('index.tpl');
?>
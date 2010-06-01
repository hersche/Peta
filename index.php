<?php
require_once 'class/default.php';

if($user->getWelcome()){
	array_push($messages, "Welcome ".$user->getName().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp());
	$user->disableWelcome();
}


$template->assign("messages", $messages);
$template->display('index.tpl');
?>
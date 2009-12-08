<?php
require_once 'class/default.php';
if(isset($_SESSION["user"])){
	$user = $_SESSION["user"];
	if($user->getWelcome()){
		array_push($messages, "Welcome ".$user->getName().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp());
		$user->disableWelcome();
	}
}

$template->assign("test", "hallo welt!");
$template->assign("messages", $messages);
$template->display('index.tpl');
?>
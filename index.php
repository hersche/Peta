<?php
require_once 'class/default.php';
if(isset($_SESSION["user"])){
$user = $_SESSION["user"];
if($user->getWelcome()){
array_push($messages, "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp());
$user->disableWelcome();
}
}
else{
	echo "Go to loginpage! (Redirect!)";
}
$template->assign("test", "hallo welt!");
$template->assign("messages", $messages);
$template->display('index.tpl');
?>
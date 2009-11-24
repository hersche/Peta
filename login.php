<?php
require_once 'class/default.php';
require_once 'class/user.php';
if($user = new user($_POST['username'], $_POST['password'], $connection)){
	array_push($messages, "login!!!!");
}
$messages = array_merge($messages, $user->getMessages());
$template->assign("messages", $messages);
$template->display('login.tpl');
?>
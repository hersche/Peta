<?php
require_once 'class/default.php';
$template->assign("messages", $messages);
$user = $_SESSION["user"];
echo $user->getUsername();
$template->assign("test", "hallo welt!");

$template->display('index.tpl');
?>
<?php
require_once 'class/default.php';
$template->assign("messages", $messages);
$template->assign("test", "hallo welt!");

$template->display('index.tpl')
?>
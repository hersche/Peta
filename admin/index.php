<?php 
require_once 'default.php';


$template->assign("test", "hallo welt!");
$template->assign("messages", $messages);
$template->display('index.tpl');

?>
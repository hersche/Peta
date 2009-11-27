<?php
require_once 'class/default.php';


$template->assign("test", "hallo welt!");
$template->assign("messages", $messages);
$template->display('cards.tpl');
?>
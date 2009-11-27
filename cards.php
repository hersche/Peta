<?php
require_once 'class/default.php';



$template->assign("messages", $messages);
$template->display('cards.tpl');
?>
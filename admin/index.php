<?php
require_once 'default.php';
$template -> assign("messages", $messages);
$template -> display('index.tpl');
?>
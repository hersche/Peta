<?php
require_once 'class/default.php';
$template->assign("messages", $messages);
$template->assign("test", "hallo welt!");

//$html = new htmlFunctions();
//$html->setIncludeHTML(true);
//$html->setTitle("Title");
//$html->setJs(array("first"=>"dojo/dojo/dojo.js"));
//$html->showMessage("test!", 100, "ds");
//$html->getHeader();
//
//$html->getFooter();
//echo phpinfo();
$template->display('index.tpl')
?>
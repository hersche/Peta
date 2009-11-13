<?php
require_once 'class/core.php';
require_once 'class/smarty/Smarty.class.php';
$smarty = new Smarty;
$smarty->assign("test", "hallo welt!");
$smarty->assign("jsscripts", array("dojo/dojo/dojo.js", "js/extras.js"));
$smarty->assign("messages", array("Dies ist ein Test!", "das auch", "und der soowieso!"));
//$html = new htmlFunctions();
//$html->setIncludeHTML(true);
//$html->setTitle("Title");
//$html->setJs(array("first"=>"dojo/dojo/dojo.js"));
//$html->showMessage("test!", 100, "ds");
//$html->getHeader();
//
//$html->getFooter();
//echo phpinfo();
$smarty->display('index.tpl')
?>
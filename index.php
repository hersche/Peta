<?php
require_once 'class/default.php';
if($user->getWelcome()){
	$messages[] = "Welcome ".$user->getUsername().'. Your last Login was at '.$user->getLastLogin().' from adress '.$user->getLastIp();
	$user->disableWelcome();
}

$connection -> exec("CREATE TABLE IF NOT EXISTS `options`( `id` INT(11) NOT NULL AUTO_INCREMENT , `key` VARCHAR(100) NOT NULL , `value` VARCHAR(100) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;");
$startpageId = $connection->query("SELECT * FROM `options` WHERE `key` LIKE 'startpage';");
if($startpageId->rowCount()==0){
$template->assign("messages", $messages);
$template->display('index.tpl');
} else {
    foreach($startpageId as $id){
        $fw = 'Location: /plugin.php?plugin='.$id[2];
        echo('Location: /plugin.php?plugin='.$id[2]);
        if(id[2]!=""){
        echo('Location: /plugin.php?plugin='.id[2]);
        }
   header($fw);
}
}
?>
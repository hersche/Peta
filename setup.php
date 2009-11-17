<?php
require_once 'class/default.php';

$template->assign("messages", $messages);

if($_GET['install']=="complete"){
	echo "beginn install!";
	$objDb->exec("CREATE TABLE `learncards`.`users` (
`id` INT( 11 ) NOT NULL ,
`username` VARCHAR( 11 ) NOT NULL ,
`realname` VARCHAR( 11 ) NOT NULL ,
`password` VARCHAR( 11 ) NOT NULL ,
`email` VARCHAR( 11 ) NOT NULL ,
`role` INT( 11 ) NOT NULL ,
PRIMARY KEY ( `id` ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE TABLE `learncards`.`roles` (
`id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`role` VARCHAR( 11 ) NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_unicode_ci;
INSERT INTO `learncards`.`roles` (`id`, `role`) VALUES (NULL, 'GUEST'), (NULL, 'USER'), (NULL, 'ADMIN');
");
}

$template->display("setup.tpl")

?>
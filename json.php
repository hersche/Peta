<?php
require_once 'class/default.php';
require_once 'class/card.php';
require_once 'class/forum.php';
$arr = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
$sets = new allThreads($connection, $user);
$jsonarray = array();
foreach ($sets->getAllTopThreads() as $thread){
	echo $thread;
	array_push($jsonarray, $thread->getTitle());
}
echo json_encode($sets->getAllTopThreads());
?>
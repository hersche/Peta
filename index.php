<?php
require_once 'class/default.php';
if(isset($_SESSION["user"])){
$user = $_SESSION["user"];
array_push($messages, "Wilkommen ".$user->getUsername());
}
else{
	echo "Go to loginpage! (Redirect!)";
}
$template->assign("test", "hallo welt!");
$template->assign("messages", $messages);
$template->display('index.tpl');
?>
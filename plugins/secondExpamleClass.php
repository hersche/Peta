<?php
class examplePluginSecond extends plugin{
	
	public function getPluginName(){
		return "examplePluginSecond";
	}
	public function getDependensies(){
		return "blubb";
	}
	
	public function start(){
		if($_GET["action"]=="test"){
			return "test-case..";
		}
		return "<ul><li>Content of second plugin!</li><li>Secndlistelmnt</li><li><a href='plugin.php?plugin=".$_GET['plugin']."&action=test'>Linky</a></ul>";
	}
}

?>
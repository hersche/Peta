<?php
class examplePluginOutside extends plugin{
	
	public function getPluginName(){
		return "examplePluginOutside";
	}
	public function getDependensies(){
		return "blubb";
	}
	
	public function start(){
		
		
		return "<h1>Content of examplePluginOutside</h2>";
	}
}

?>
<?php
class examplePluginOutside extends plugin{
	private $post;
	private $get;
	private $currentUser;
	private $templateObject;
	private $connection;
	public function __construct($post, $get, $currentUser, $templateObject, $connection){
		$this->post = $post;
	}
	
	public function getPluginName(){
		return "I am outside, but you see me!";
	}
	public function getDependensies(){
		return "blubb";
	}
	
	public function start(){
		return "Start";
	}
}

?>
<?php
class drittes extends plugin{
	
	private $currentUser;
	private $templateObject;
	private $connection;
	/**
	 *
	 * Constructor
	 * @param array $post all the post-datas..
	 * @param array $get all the get-datas
	 * @param unknown_type $currentUser
	 * @param unknown_type $connection
	 */
	public function __construct($currentUser, $templateObject,$folder, $connection) {
		$this -> currentUser = $currentUser;
		$this -> templateObject = $templateObject;
		$this -> connection = $connection;
	}
	function getIdentifier(){
		return get_called_class();
	}
	public function getPluginName(){
		return "drittes plugin";
	}
	public function getDependensies(){
		return "blubb";
	}
	
	public function start(){
		// var_dump($this->templateObject);
		$this->templateObject->display('drittes.tpl');
		//return "inhalt drittes";
	}
}

?>
<?php
class skamsterTplExample extends plugin{
	
	private $currentUser;
	private $templateObject;
	private $connection;
	private $id;
	private $folder;
	/**
	 *
	 * Constructor
	 * @param array $post all the post-datas..
	 * @param array $get all the get-datas
	 * @param unknown_type $currentUser
	 * @param unknown_type $connection
	 */
	public function __construct($id, $currentUser, $templateObject, $folder, $connection) {
		$this->id = $id;
		$this -> currentUser = $currentUser;
		$this -> templateObject = $templateObject;
		$this -> connection = $connection;
		$this->folder = $folder;
	}
	
	public function deleteInstanceTables(){ 
		//I've no db's
	}
	
	public function getPluginName(){
		return "tplExample.skamster";
	}	
	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "A plugindescription for tplExample.skamster .";
	}

	
	public function start(){
		$this->templateObject->display($this->folder.'tplExample.tpl');
	}
}

?>
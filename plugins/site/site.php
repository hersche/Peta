<?php
class skamsterSite extends plugin{
	
	private $currentUser;
	private $templateObject;
	private $connection;
	private $id;
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

	}
	public function deleteInstanceTables(){ 
		$this -> connection -> exec("DROP TABLE IF EXIST `".$this->getDbPrefix()."site`");
	}
	
	public function getPluginName(){
		return "site.skamster";
	}	
	
	public function getId(){
		return $this->id;
	}
	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "This should work as a usual web/info-site .";
	}
	
	
	public function start(){
		$this -> connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."site` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` text NOT NULL,
			`content` text NOT NULL,
			PRIMARY KEY (`id`)
		)");
		$this->templateObject->display('tplExample.tpl');
	}
}

?>
<?php

/**
 *
 * What's a plugin? This class should define these.. every plugin has to extend this class!
 * @author skamster
 *
 */
abstract class plugin {
	private $id;
	private $currentUser;
	private $templateObject;
	private $connection;
	private $folder;
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
		$this->folder =$folder;
	}

	abstract function getPluginName();
	abstract function getDependensies();
	function getIdentifier(){
		return get_called_class();
	}
	abstract function start();
	public function getId() {
		return $this -> id;
	}

	public function setId($id) {
		$this -> id = $id;
	}

}

class pluginmanager {
	private static $pluginManager;
	private $plugins;
	private $hooks;
	// private $pluginlist = array();
	private $rawPluginList = array();
	private $counter = 0;
	function __construct($currentUser, $template, $connection) {
		$this -> plugins = array();
		$this -> hooks = array();
		// Get a list of hte plugins from the plugin folder
		// include them, then initialise them
		// Once they have been init'd
		// the hooks dotted around the system can call on the plugins
		$plugin_dir = 'plugins/';

		$pluginsList = @opendir($plugin_dir);

		while ($PlugFolder = readdir($pluginsList)) {
			if ($PlugFolder != '.' && $PlugFolder != '..') {

				if ((is_file($plugin_dir . $PlugFolder)) && strtolower(substr($PlugFolder, strlen($PlugFolder) - 4)) == '.php') {
					$this->checkPHPPlugin($plugin_dir . $PlugFolder);
				}
				// Look for folders of plugins
				if (is_dir($plugin_dir . $PlugFolder)) {
					// Now we look at the files in the plugin folder
					$PlugList = opendir($plugin_dir . $PlugFolder);
					while ($Plug = readdir($PlugList)) {
						if ($Plug != '.' && $Plug != '..' && strtolower(substr($Plug, strlen($Plug) - 4)) == '.php') {
							if(strtolower(substr($PlugFolder, strlen($PlugFolder) - 1))!="/"){
								$PlugFolder = $PlugFolder."/";
							}
							//here we would add a file in plugins/individualPluginstuff/*.php
							if ((is_file($plugin_dir . $PlugFolder . $Plug)) && strtolower(substr($Plug, strlen($Plug) - 4)) == '.php') {
								$this->checkPHPPlugin($plugin_dir . $PlugFolder . $Plug);
							}
						}

					}
				}

			}
		}
	}

	
	

	// deprectated fallback
	public function getPlugins() {
		return array();
	}
	
	private function checkPHPPlugin($fullPath){
		$Code = file_get_contents($fullPath);
		preg_match_all('/^class\s+(\w+)\s+extends\s+plugin/im', $Code, $matching);
		if (!empty($matching[1][0])) {
			try {
				$notInitClass = new rawPlugin($matching[1][0],$fullPath);
				array_push($this->rawPluginList, $notInitClass);
			} catch (Exception $e) {
				echo $e;
				continue;
			}
		}
	}
	public function getRawPlugins() {
		return $this -> rawPluginList;
	}

	public function getPluginbyid($id) {
		foreach ($this->pluginlist as $plugin) {
			if ($plugin -> getId() == $id) {
				return $plugin;
			}
		}
	}
	
	public function getRawPluginByName($name){
		foreach ($this->rawPluginList as $rawPlugin) {
			if ($rawPlugin -> getName() == $name) {
				return $rawPlugin;
			}
		}
	}

}

class instancedPluginManager{
private $instancedPluginList = array();
private $connection;
	public function __construct($connection,$template,$currentUser){
		$this->connection = $connection;
		// Tableconstructor
		$connection->query('CREATE TABLE IF NOT EXISTS `plugin` (
		  `pl_id` int(16) NOT NULL AUTO_INCREMENT,
		  `pl_name` varchar(40) NOT NULL,
		  `pl_description` varchar(1024) NOT NULL,
		  `pl_path` varchar(255) NOT NULL,
		  `pl_className` varchar(128) NOT NULL,
		  `pl_active` tinyint(1) NOT NULL,
		  PRIMARY KEY (`pl_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
		
		foreach($connection->query('SELECT * FROM `plugin` LIMIT 0 , 30') as $row){
			array_push($this->instancedPluginList, new instancedPlugin($row['pl_id'],$row['pl_name'], $row['pl_description'], $row['pl_path'], $row['pl_className'],$row['pl_active'],$connection, $template,$currentUser));
		}
	}
	public function getInstancedPlugins(){
		return $this->instancedPluginList;
	}
	public function getInstancedPluginById($id){
	
		foreach($this->instancedPluginList as $iP){
			if($iP->getId()==$id){
				return $iP;
			}
		}
	}
	public function getInstancedPluginList($className){
		$list = array();
		foreach($this->instancedPluginList as $iP){
			if($iP->getClassName()==$className){
				array_push($list, $iP);
			}
		}
		return $list;		
	}
	public function createInstancedPlugin($name, $description, $path, $className,$active){
		
		$sql = "INSERT INTO plugin (`pl_name`,`pl_description`, `pl_path`,`pl_className`,`pl_active`) VALUES ('" . $name . "', '" . $description . "', '" . $path . "', '" . $className . "', " . $active . ");";
		$this->connection -> exec($sql);
		//var_dump($sql);
	}
}

class instancedPlugin{
	private $id;
	private $name;
	private $description;
	private $path;
	private $file;
	private $className;
	private $active;
	private $connection;
	private $pluginObj;
	private $currentUser;
	private $template;
	
	
	public function __construct($id,$name, $description, $path, $className,$active,$connection,$template,$currentUser){
		$this->id=$id;
		$this->name=$name;
		$this->description=$description;
		$this->path=$path;
		$this->file=basename($path);
		$this->className=$className;
		$this->active=$active;
		$this->connection=$connection;
		$this->currentUser = $currentUser;
		$this->template=$template;
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	public function getPath(){
		return $this->path;
	}
	public function getClassName(){
		return $this->className;
	}
	public function getActive(){
		return $this->active;
	}
	public function getInstance(){
		require_once $this->path;
		$this->pluginObj = new $this->className($this->currentUser, $this->template,dirname($this->path)."/", $this->connection);
		return $this->pluginObj;
	}
	
	public function edit(){
		$this->setName($_POST['instancePluginName']);
		$this->setDescription($_POST['instancePluginDescription']);
		
	}
	
	private function setName($name){
		if($name!=$this->name){
			$this->name=$name;
			$this->connection->exec('UPDATE plugin SET pl_name="' . $name . '" WHERE pl_id="' . $this->id. '";');
		}
	}
	
	private function setDescription($description){
		if($description!=$this->description){
			var_dump('UPDATE plugin SET pl_description="' . $description . '" WHERE pl_id="' . $this->id. '";');
			$this->description=$description;
			$this->connection->exec('UPDATE plugin SET pl_description="' . $description . '" WHERE pl_id="' . $this->id. '";');
		}
	}
	
	public function delete(){
		$this -> connection -> exec("DELETE FROM plugin WHERE pl_id = " . $this->id . "; ");
	}

}

class rawPlugin{
	private $name;
	private $path;
	public function __construct($name,$path){
		$this->name = $name;
		$this->path = $path;
	}
	public function getName(){
		return $this->name;
	}
	
	public function getPath(){
		return $this->path;
	}
	public function getFolder(){
		return dirname($path);
	}
	
}
?>
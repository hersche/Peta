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
	private $pluginlist = array();
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

					$Code = file_get_contents($plugin_dir . $PlugFolder);
					preg_match_all('/^class\s+(\w+)\s+extends\s+plugin/im', $Code, $matching);
					if (!empty($matching[1][0])) {
						try {
							require_once $plugin_dir . '/' . $PlugFolder;
							$class = new $matching[1][0]($currentUser, $template,$plugin_dir, $connection);
							$class -> setId($this -> counter);
							//classname + path in db speichern, wenn exist + aktiviert
							//initialisieren und hinzufügen. voll easy.
							$this -> counter += 1;
							$notInitClass = new rawPlugin($matching[1][0],$plugin_dir . '/' . $PlugFolder);
							array_push($this->rawPluginList, $notInitClass);
							array_push($this -> pluginlist, $class);
						} catch (Exception $e) {
							echo $e;
							continue;
						}
					}
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
								$folder = $plugin_dir . $PlugFolder;
								print_r($folder."<br />");
								$Code = file_get_contents($folder.$Plug);
								preg_match_all('/^class\s+(\w+)\s+extends\s+plugin/im', $Code, $matching);
								if (!empty($matching[1][0])) {
									try {
										require_once $folder . '/' . $Plug;
										$class = new $matching[1][0]($currentUser, $template,$folder, $connection);
										$class -> setId($this -> counter);
										//new kind of pluginise
										$notInitClass = new rawPlugin($matching[1][0], $folder . $Plug);
										array_push($this->rawPluginList, $notInitClass);
										
										$this -> counter += 1;
										array_push($this -> pluginlist, $class);
									} catch (Exception $e) {
										echo $e;
										continue;
									}
								}
							}
						}

					}
				}

			}
		}
	}

	
	


	public function getPlugins() {
		return $this -> pluginlist;
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
private instancedPluginList = array();
	public function __construct($connection,$template,$currentUser){
		foreach($connection->query('SELECT * FROM `` LIMIT 0 , 30') as $row){
			array_push($this->instancedPluginList, new instancedPlugin($row['$id'],$row['$name'], $row['$description'], $row['$path'], $row['$className'],$row['$active'],$connection, $template,$currentUser);
		}
	}
	public function createInstancedPlugin($name, $description, $path, $className,$active){
		
		$connection -> exec("INSERT INTO instancedPlugin (`pl_name`,`pl_hash`, `pl_version`,`pl_active`) VALUES ('" . $name . "', '" . $description . "', " . $path . ", " . $className . ", " . $active . ");");
		
	}
}

class instancedPlugin{
	private $id;
	private $name;
	private $description;
	private $path;
	private $className;
	private $active;
	private $connection;
	private $pluginObj;
	private $currentUser;
	private $template;
	
	
	public function __construct($id,$name, $description, $path, $className,$active,$connection,$template,$currentUser){
		$this->id=$id;
		$this->name=$name;
		$this->description=description;
		$this->path=$path;
		this->className=$className;
		$this->active=$active;
		$this->connection=$connection;
		$this->currentUser = $currentUser;
		$this->template=$template;
	}
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function getInstance(){
		require_once $this->path;
		$this->pluginObj = new $this->className;
	}
	
	public function edit(){
		$this->setName($_POST['pluginName']);
	}
	
	private function setName($name){
		if($name!=$this->name){
			$this->name=$name;
			//SQL-UPDATE
		}
	}
	
	public function delete(){
	
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
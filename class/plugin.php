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
							//staticmethod getIdentifier in pluginclass, vorcheck in db, wenn exist + aktiviert
							//initialisieren und hinzufügen. voll easy.
							$this -> counter += 1;
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
								$Code = file_get_contents($folder.$Plug);
								preg_match_all('/^class\s+(\w+)\s+extends\s+plugin/im', $Code, $matching);
								if (!empty($matching[1][0])) {
									try {
										require_once $folder . '/' . $Plug;
										$class = new $matching[1][0]($currentUser, $template,$folder, $connection);
										$class -> setId($this -> counter);
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

	public function createPlugin(){
		$connection -> exec("INSERT INTO plugin (`pl_name`,`pl_hash`, `pl_version`,`pl_active`) VALUES ('" . $set -> getSetName() . "', '" . $set -> getSetDescription() . "', " . $userid . ", 1, '2009-00-00 00:00:00', " . $userid . ");");
	}

	public function getPlugins() {
		return $this -> pluginlist;
	}

	public function getPluginbyid($id) {
		foreach ($this->pluginlist as $plugin) {
			if ($plugin -> getId() == $id) {
				return $plugin;
			}
		}
	}
	
	public function getPluginByIdentifier($identifier){
		foreach ($this->pluginlist as $plugin) {
			if ($plugin -> getIdentifier() == $identifier) {
				return $plugin;
			}
		}
	}

}
?>
<?php

/**
 * 
 * What's a plugin? This class should define these.. every plugin has to extend this class!
 * @author skamster
 *
 */
abstract class plugin{
	private $id;
	/**
	 * 
	 * Constructor
	 * @param array $post all the post-datas..
	 * @param array $get all the get-datas
	 * @param unknown_type $currentUser
	 * @param unknown_type $connection
	 */
	abstract function __construct($post, $get, $currentUser,$templateObject, $connection);
	abstract function getPluginName();
	abstract function getDependensies();
	abstract function start();
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}

}

class pluginmanager{
	private static $pluginManager;
	private $plugins;
	private $hooks;
	private $pluginlist = array();
	private $counter = 0;
	function __construct ($post, $get, $currentUser, $connection)
	{
		$this->plugins = array ();
		$this->hooks = array ();
		// Get a list of hte plugins from the plugin folder
		// include them, then initialise them
		// Once they have been init'd
		// the hooks dotted around the system can call on the plugins
		$plugin_dir = 'plugins/';

		$pluginsList = @opendir ($plugin_dir);

		while ($PlugFolder = readdir ($pluginsList))
		{

			if ($PlugFolder != '.' && $PlugFolder != '..')
			{ // Look for folders of plugins
				if (is_dir ($plugin_dir . $PlugFolder))
				{

					// Now we look at the files in the plugin folder
					$PlugList = opendir ($plugin_dir . $PlugFolder);
					while ($Plug = readdir ($PlugList))
					{

						if ($Plug != '.' && $Plug != '..' && strtolower (substr ($Plug, strlen ($Plug) - 4)) == '.php')
						{

							$Code = file_get_contents ($plugin_dir . $PlugFolder . '/' . $Plug);
							preg_match_all('/^class\s+(\w+)\s+extends\s+plugin/im', $Code, $matching);
							if(!empty($matching[1][0])){
								try {
									require_once $plugin_dir . $PlugFolder . '/' . $Plug;
									$class = new $matching[1][0]($post, $get, $currentUser,$template, $connection);
									$class->setId($this->counter);
									$this->counter += 1;
									array_push($this->pluginlist, $class);
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
	public function getPlugins(){
		return $this->pluginlist;
	}
	
	public function getPluginbyid($id){
		foreach($this->pluginlist as $plugin){
			if($plugin->getId() == $id){
				return $plugin;
			}
		}
	}
}




?>
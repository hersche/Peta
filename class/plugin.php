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
	private $template;
	private $connection;
	private $folder;
	/**
	 * Constructor
	 * @param array $post all the post-datas..
	 * @param array $get all the get-datas
	 * @param user $currentUser
	 * @param PDO $connection
	 */
	public function __construct($id,$currentUser,$template,$folder, $connection) {
		$this->id = $id;
		$this -> currentUser = $currentUser;
		$this -> template = $template;
		$this -> connection = $connection;
		$this->folder =$folder;
	}
	/**
	* Get the pluginname, set by each plugin.
	* Use convention like pluginname.username.v01 or so. Important is a unique pluginname to others exist in web.
	**/
	abstract function getPluginName();
	
	/**
	* Get a description of the plugin-file for admin or user which want to instance a plugin.
	**/
	abstract function getPluginDescription();
	
	/**
	* Get the className, which have to be unique too! Don't use points, better something like pluginnameUsername . This isn't so important for the user to show, the pluginName is used for this.
	**/
    public function getMessages(){
        return Null;
    }
    /* You don't have to use or implement this method basicly.
    @return str classname
    */
	public function getClassName(){
		return get_called_class();
	}

    /**
    * Includes stuff like dojo.require(yourname).
    * Eats a array.
    */
	public function getRequiredDojo(){
		return Null;
	}
    /* Includes a css-file. Result in header: <style href="foo.css" />
    * Use the $folder-variable to stay dynamic!
    * Eats a array
    */
	public function getRequiredCss(){
		return Null;
	}	
	/*
    * Put some js-code with is executed onLoad.
    * This one have to be direct! Look into sitePlugin for example.
    * Eats array
    */
	public function getOnLoadCode(){
		return Null;
	}
    /*
    * Load own js-files into header. Result: <script href="foo.js" />
    * Don't forget $folder for dynamic paths!
    * Eats array
    */
    public function getJs(){
		return Null;
	}
    /*
    * Put whole, individual tag-lines into header. Result: foo = foo. So take care. Do <foo>foo</foo> !!
    */
    public function getHeaderTags(){
		return Null;
	}
	/**
	* For internally use of the plugins, to do unique tables.
	*/
	public function getDbPrefix(){
		return $this->getClassName()."_".$this->getId()."_";
	}
	

	public abstract function deleteInstanceTables();
	/**
	* Execute-method of the plugin
	**/
	abstract function start();
	
    /**
    * Implement this for using getDbPrefix. Important!
    * Gets your instance plugin-id.
    @return int id
    */
	public function getId() {
		return $this -> id;
	}

}

class rawIOPluginManager {
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
				//continue;
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
	private $instancedPluginList;
	private $connection;
    private $user;
    private $template;
	public function __construct($user,$template, $connection){
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
			
        $connection->query('CREATE TABLE IF NOT EXISTS `pluginrole` (
		  `id` int(16) NOT NULL AUTO_INCREMENT,
		  `pluginId` int(11) NOT NULL,
		  `roleId` int(11) NOT NULL,
		  `access` int(3) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');	
        $connection->query('CREATE TABLE IF NOT EXISTS `pluginoption` (
		  `id` int(16) NOT NULL AUTO_INCREMENT,
		  `pluginId` int(11) NOT NULL,
		  `key` varchar(11) NOT NULL,
		  `value` varchar(3) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');	
        $connection->query('CREATE TABLE IF NOT EXISTS `pluginmenu` (
		  `id` int(16) NOT NULL AUTO_INCREMENT,
		  `pluginId` int(11) NOT NULL,
          `order` int(11) NOT NULL,
          `name` varchar(200) NOT NULL,
          `description` varchar(200) NOT NULL,
		  `action` varchar(200) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');	
        $this->connection = $connection;
        $this->user=$user;
        $this->template=$template;
        $this->updateInstancedPlugins();
	}
    
    public function updateInstancedPlugins(){
        $this->instancedPluginList = array();
        foreach($this->connection->query('SELECT * FROM `plugin` LIMIT 0 , 30') as $row){
            array_push($this->instancedPluginList, new instancedPlugin($row['pl_id'],$row['pl_name'], $row['pl_description'], $row['pl_path'],                                                       $row['pl_className'],$row['pl_active'],$this->connection, $this->template,$this->user));
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
    
    public function getOptions(){
        $sqlEx = $this->connection->query("SELECT * FROM pluginoptions WHERE pluginId='".$this->id."';");
		foreach($sqlEx as $row){
            
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
		$this->updateInstancedPlugins();
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
	private $roles;
	private $restRoles;
	private $allRoles;
    private $pluginOptions;
    private $pluginSites;
	
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
		$this->updateRoles();
	}
	
	private function updateRoles(){
		$this->allRoles=array();
		$this->roles=array();
		$this->restRoles=array();
		foreach($this->connection->query("SELECT * FROM role") as $roleRow){
			$role = new role();
			$role->setId($roleRow['rid']);
			$role->setRole($roleRow['role']);
			array_push($this->allRoles, $role);
		}
		$publicRole = new role();
		$publicRole->setId(-1);
		$publicRole->setRole("Public");
		array_push($this->allRoles, $publicRole);
		$sqlEx = $this->connection->query("SELECT * FROM pluginrole WHERE pluginId='".$this->id."';");
		foreach($sqlEx as $row){
			foreach($this->allRoles as $role){
				if($role->getId()==$row['roleId']){
					$role->setAccessRights($row['access']);
					array_push($this->roles, $role);
				}
			}
		}
		
		foreach($this->allRoles as $role){
			if(!in_array($role, $this->roles)){
				array_push($this->restRoles, $role);
			}
		}
	}
	
	// public function insertRole($roleId + ownid into pluginrole, $conn->lastinsertid mit rechte into roleaccess
	public function insertRole($roleId, $access){
		$this->connection->exec('INSERT INTO pluginrole (pluginId, roleId,access) VALUES (' . $this -> id . ', ' . $roleId . ', ' . $access . ');');
		$this->updateRoles();
	}
	
    
    	public function insertOption($key,$value){
		$this->connection->exec('INSERT INTO pluginoption (pluginId, key,value) VALUES (' . $this -> id . ', ' . $key . ', ' . $value . ');');
		$this->updateOptions();
	}
        	public function insertMenuEntry($key,$value){
		$this->connection->exec('INSERT INTO pluginoption (pluginId, key,value) VALUES (' . $this -> id . ', ' . $key . ', ' . $value . ');');
		// $this->updateRoles();
	}
	public function getUsedRoles(){
		//var_dump(sizeof($this->roles));
		return $this->roles;
	}
	
	public function getRestRoles(){
		
		if(sizeof($this->roles)!=0){
			return $this->restRoles;
		}
		else{
			//var_dump($this->allRoles);
			return $this->allRoles;
		}
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
        if (file_exists($this->path)){
		  require_once $this->path;
		  $this->pluginObj = new $this->className($this->id,$this->currentUser, $this->template,dirname($this->path)."/", $this->connection);
		  return $this->pluginObj;
        }
        else{
            $this->connection->exec('UPDATE plugin SET pl_active="' . 0 . '" WHERE pl_id="' . $this->id. '";');
            throw new Exception("Plugin is not there, deactivate it. When you move it, go to pluginconfig and re-activate it.");
}
	}
    
	public function removeRole($roleId){
		if(isset($roleId)){
			$this->connection -> exec('DELETE FROM `pluginrole` WHERE `roleId` = ' . $roleId . ' AND `pluginId` = ' . $this->id . ';');
			$this->updateRoles();
		}
	}
    
    
    public function updateOptions(){
        $this->pluginOptions = array();
        $q=$this->connection->query("SELECT * FROM pluginoption WHERE pluginId = ".$this->id.";");
        foreach($q as $PluginOptionRow){
            array_push($this->pluginOptions, new pluginOption($PluginOptionRow['id'],$PluginOptionRow['key'],$PluginOptionRow['value'],$PluginOptionRow['pluginId']));
        }
    }
    
    /**
        Edit the instanced plugin. Needs no arguments, cause it goes a alternative way - direct getting of post.
    **/
	public function edit() {
		$this->setName($_POST['instancePluginName']);
		$this->setDescription($_POST['instancePluginDescription']);
        $active = isset($_POST['editActive']) ? $_POST['editActive'] : 0 ;
            if($active!=$this->active){
                $this->connection->exec('UPDATE plugin SET pl_active="' . $active . '" WHERE pl_id="' . $this->id. '";');
            }
        
        if(isset($_POST['editPath'])){
            $this->connection->exec('UPDATE plugin SET pl_path="' . $_POST['editPath'] . '" WHERE pl_id="' . $this->id. '";');
        }
		$this->setRoles();
		
	}
	
	private function setRoles(){
		foreach($this->allRoles as $role){
			if($_POST["role_".$role->getId()]!=Null){
				if(!in_array($role, $this->roles)){
					//The role make a int out of the string - use getAccessRightsString to convert back
					$role->setAccessRights($_POST['access_'.$role->getId()]);
					$this->insertRole($role->getId(),$role->getAccessRights());
				}
				if((isset($_POST['access_'.$role->getId()]))&&($_POST['access_'.$role->getId()]!=$role->getAccesRightsString())){
					$this->connection->exec("UPDATE `".$this->dbPrefix."pluginrole` SET `access` =  '" . $role->getAccessRights() . "' WHERE `pluginId` =" . $this->id . " and `roleId` =" . $role->getId() . " LIMIT 1 ;");
				}
			}
			else{
				if(in_array($role, $this->roles)){
					$this->removeRole($role->getId());
				}
			}
			
		}
	}
	private function setName($name){
		if(($name!=$this->name)&($name!="")){
			$this->name=$name;
			$this->connection->exec('UPDATE plugin SET pl_name="' . $name . '" WHERE pl_id="' . $this->id. '";');
		}
	}
	
	private function setDescription($description){
		if(($description!=$this->description)&&($description!="")){
			$this->description=$description;
			$this->connection->exec('UPDATE plugin SET pl_description="' . $description . '" WHERE pl_id="' . $this->id. '";');
		}
	}
	
    /**
     Delete the instanced plugin
    **/
	public function delete(){
		$inst = $this->getInstance();
		$inst->deleteInstanceTables();
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

class pluginOption {
    private $key;
    private $value;
    private $pluginId;
    
    public function __construct($key, $value, $pluginId){
        $this->key = $key;
        $this->value=$value;
        $this->pluginId=$pluginId;
    }
    public function getKey(){
        return $this->key;
    }
    public function getValue(){
        return $this->value;   
    }
    
}

class pluginMenuEntry{
    private $name;
    private $description;
    private $order;
    private $action;
    public function __construct($name,$description, $order, $action){
        $this->name = $name;
        $this->order = $order;
        $this->action = $action;
    }
    public function getName(){    
        return $this->name;   
    }
     
     public function getOrder(){
         return $this->order;
     }
     public function getAction(){
        return $this->action;   
     }
}
?>
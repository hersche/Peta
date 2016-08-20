<?php
class wikittenPluginSkamster extends plugin{
	
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
		return "wikittenPlugin.skamster";
	}
    
    	public function getId(){
		return $this->id;
	}
    	public function getRequiredCss(){
		return array($this->folder."static/css/bootstrap.min.css",$this->folder."static/css/prettify.css",$this->folder."static/css/codemirror.css",$this->folder."static/css/main.css");
		}

    	public function getJs(){
			return array($this->folder."static/js/jquery.min.js", $this->folder."static/js/prettify.js",$this->folder."static/js/codemirror.min.js");
	}
	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "A plugindescription for wikitten .";
	}


	
	public function start(){
        define('APP_NAME', 'My Wiki');
        define('ENABLE_EDITING', true);
        $path = $this->folder."documents_".$this->getDbPrefix();
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        define('USE_PAGE_METADATA', false);
        define('LIBRARY', $path);
        define('PLUGPATH', "plugin.php?plugin=".$this->id."&amp;page=");
        var_dump($path);
        define('PLUGINS', $this->folder. 'plugins');
        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        $request_uri = explode("/", $request_uri['path']);
        $script_name = explode("/", dirname($_SERVER['SCRIPT_NAME']));

        $app_dir = array();
        foreach ($request_uri as $key => $value) {
            if (isset($script_name[$key]) && $script_name[$key] == $value) {
                $app_dir[] = $script_name[$key];
            }
        }

        define('APP_DIR', rtrim(implode('/', $app_dir), "/"));
        $https = false;
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
            $https = true;
        }

        define('BASE_URL', "http" . ($https ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . APP_DIR);

        unset($request_uri, $script_name, $app_dir, $https);
        
        

        require_once $this->folder."wiki.php";
        // return Wiki::instance()->dispatch();
        //return $this->templateObject->fetch($this->folder.'wikittenPlugin.tpl');
		//$this->templateObject->fetch($this->folder.'wikittenPlugin.tpl');
	}
}

?>
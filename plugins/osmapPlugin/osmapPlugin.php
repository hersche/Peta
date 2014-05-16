<?php
/**
* Ideas for this plugin:
* make pois shareable
* name start = startposition
* May html-content on single points? extended but easy to build in
* find out how to draw ares. need another model and table then, but would be practical
*/
class osmapPluginSkamster extends plugin{
	
	private $user;
	private $template;
	private $connection;
	private $id;
	private $folder;
	private $dbPrefix;
	private $poiList;
    
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
        $this -> user = $currentUser;
        // Workaround possible bug, may from php (5.5 never reached that!)
        // TODO further checking
        if($currentUser==""){
            $this->user = $_SESSION['user'];   
        }

		$this -> template = $templateObject;
		$this -> connection = $connection;
		$this->folder=$folder;
		$this->dbPrefix=$this->getDbPrefix();
		$this->updatePois();
	}
	public function deleteInstanceTables(){ 
		$this -> connection -> exec("DROP TABLE IF EXIST `".$this->getDbPrefix()."pois`");
	}

	public function getPluginName(){
		return "osmapPlugin.skamster";
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
    
    public function getHeaderTags(){
		return array('<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>');
	}
    	public function getRequiredCss(){
		return array("http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css");
	}	
	public function updatePois(){
		$this->poiList = array();
        $statement = $this->connection->query("SELECT * FROM `".$this->dbPrefix."pois` WHERE `ownerid`=".$this->user->getId()." OR `shared`=1;");
        if($statement===False){
            $statement = array();   
        }
		foreach($statement as $row){
			array_push($this->poiList,new poi($row['id'],$row['name'],$row['position'],$row['zoom'],$row['shared'],$row['ownerid']));
		}
	}
    
    	public function insertPoi($name, $position,$zoom,$shared){
		$this->connection->exec("INSERT INTO `".$this->dbPrefix."pois` (`name`, `position`,`zoom`,`shared`, `ownerid`) VALUES ('" . $name . "', '" .$position."','" .$zoom."','" .$shared."', '" .$this->user->getId()."');");
		$this->updatePois();
	}
	
	public function deletePoi($id){
		$this->connection->exec("DELETE FROM `".$this->dbPrefix."pois` WHERE `id` = " . $id . "; ");
		$this->updatePois();
	}
	
	public function editPoi($id, $name, $position, $zoom, $shared){
		$this->connection->exec("UPDATE `".$this->dbPrefix."pois` SET `name` =  '" . $name . "',`position`='" .$position ."',`zoom`='" .$zoom ."',`shared`='" .$shared ."',`ownerid`='" .$this->user->getId(). "' WHERE `id`=".$id . " LIMIT 1 ;");
		$this->updatePois();
	}
    
    public function getStartPoi(){
        foreach($this->poiList as $poi){
            if($poi->name=="start"){
                return $poi;
            }
        }
    }
	public function start(){
        $this -> connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."pois` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` text NOT NULL,
			`position` text NOT NULL,
			`zoom` int(3) NOT NULL,
            `shared` int(3) NOT NULL,
			`ownerid` int(11) NOT NULL,
			PRIMARY KEY (`id`)
		)");
        $this->template->assign("userid",$this->user->getId());
        $messages = array();
        if((isset($_POST['createPoiName']))&&($_POST['createPoiPosition'])){
            $createPoiShared = (isset($_POST['createPoiShared'])) ? 1 : 0;
            $this->insertPoi($_POST['createPoiName'], $_POST['createPoiPosition'],$_POST['zoom'],$createPoiShared);
            array_push($messages, "Poi ".$_POST['createPoiName']." is created");
        }
        elseif(isset($_GET['delPoi'])){
            // TODO such stuff is unprotected!
            $this->deletePoi($_GET['delPoi']); 
            array_push($messages, "Poi deleted");
        }
        elseif((isset($_POST['editPoiName']))&&(isset($_POST['editPoiPosition']))&&(isset($_POST['editPoiId']))){
            $editPoiShared = (isset($_POST['editPoiShared'])) ? 1 : 0;
            $this->editPoi($_POST['editPoiId'], $_POST['editPoiName'], $_POST['editPoiPosition'],$_POST['editZoom'],$editPoiShared);
            array_push($messages, "Poi is edited as ".$_POST['editPoiName']);
        }
        $this->template->assign("startPoi", $this->getStartPoi());

        $this->template->assign("poiList", $this->poiList);
        $this->template->assign("pluginId", $this->getId());
        $this->template->assign("messages", $messages);
        return $this->template->fetch($this->folder.'osmapPlugin.tpl');
	}
}
/**
* Dataobject represent DB
* Better do not use public variables like this, do getter and setter. This is just faster.
**/
class poi{
	public $id;
	public $name;
    public $position;
    public $zoom;
    public $shared;
    public $ownerId;
	public function __construct($id,$name,$position,$zoom,$shared,$ownerId){
		$this->id = $id;
		$this->name=$name;
		$this->position=$position; 
        $this->shared=$shared;
        $this->zoom=$zoom;
        $this->ownerId = $ownerId; }
}
?>
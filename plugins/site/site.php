<?php
class skamsterSite extends plugin{
	
	private $currentUser;
	private $template;
	private $connection;
	private $id;
	private $folder;
	private $dbPrefix;
	private $siteList;
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
		$this -> template = $templateObject;
		$this -> connection = $connection;
		$this->folder=$folder;
		$this->dbPrefix=$this->getDbPrefix();
		$this->updateSites();
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
	
	public function getRequiredDojo(){
			return array("dijit.Editor","dojox.editor.plugins.Preview","dojox.editor.plugins.LocalImage","dojox.editor.plugins.PrettyPrint","dojox.editor.plugins.FindReplace");
	}
	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "This should work as a usual web/info-site .";
	}
	
	public function insertSite($name, $content, $order){
		$this->connection->exec("INSERT INTO `".$this->dbPrefix."site` (`name`, `content`, `order`) VALUES ('" . $name . "', '" . urlencode($content) . "', " . intval($order) . ");");
	}
	
	public function deleteSite($id){
		$this->connection->exec("DELETE FROM `".$this->dbPrefix."site` WHERE `id` = " . $id . "; ");
	}
	
	public function editSite($id, $name, $content,$order){
		
		$this->connection->exec("UPDATE `".$this->dbPrefix."site` SET `name` =  '" . $name . "',`content` =  '" . urlencode($content) . "',`order` =  " . $order . " WHERE `id` =" . $id . " LIMIT 1 ;");
	}
	
	public function getSiteById($id){
		$sites = array();
		foreach($this->connection->query("SELECT * FROM `".$this->dbPrefix."site` WHERE id=".$id.";") as $row){
			return new site($row['id'],$row['name'],urldecode($row['content']),$row['order']);
		}
	}
	public function updateSites(){
		$this->siteList = array();
		foreach($this->connection->query("SELECT * FROM `".$this->dbPrefix."site`;") as $row){
			array_push($this->siteList,new site($row['id'],$row['name'],urldecode($row['content']),$row['order']));
		}
	}
	public function start(){
		$this -> connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."site` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` text NOT NULL,
			`content` text NOT NULL,
			`order` int(11) NOT NULL,
			PRIMARY KEY (`id`)
		)");
		if(isset($_GET['createSiteId'])){
			$this->insertSite($_POST['siteName'],$_POST['siteContent'],$_POST['siteOrder']);
		}	
		elseif(isset($_GET['editSiteId'])){
			$this->editSite($_GET['editSiteId'],$_POST['siteName'],$_POST['siteContent'],$_POST['siteOrder']);
		}
		elseif(isset($_GET['singleEditViewId'])){
			$this->template->assign("singleEditSite", $this->getSiteById($_GET['singleEditViewId']));
		}
		elseif(isset($_GET['singleViewId'])){
			$this->template->assign("siteListMenu", $this->siteList);
			$this->template->assign("singleViewSite", $this->getSiteById($_GET['singleViewId']));
		}
		elseif(isset($_GET['deleteSiteId'])){
			$this->deleteSite($_GET['deleteSiteId']);
		}
		else{
			$this->template->assign("siteList", $this->siteList);
		}
		$this->template->assign('pluginId',$_GET['plugin']);
		$this->template->display($this->folder.'site.tpl');
	}
}
/**
* Dataobject represent DB
* Better do not public variables, do getter and setter. This is just faster.
**/
class site{
	public $id;
	public $name;
	public $content;
	public $order;
	public function __construct($id,$name,$content,$order){
		$this->id = $id;
		$this->name=$name;
		$this->content=$content;
		$this->order=$order; }
}
?>
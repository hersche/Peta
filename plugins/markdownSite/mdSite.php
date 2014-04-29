<?php
class markdownSiteSkamster extends plugin{
	
	private $user;
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
		$this -> user = $currentUser;
		$this -> template = $templateObject;
		$this -> connection = $connection;
		$this->folder=$folder;
		$this->dbPrefix=$this->getDbPrefix();
		$this->updateMDSites();
	}
	public function deleteInstanceTables(){ 
		$this -> connection -> exec("DROP TABLE IF EXIST `".$this->getDbPrefix()."site`");
	}
	public function getRequiredCss(){
		return array($this->folder."markitup/skins/markitup/style.css");
		}
	public function getPluginName(){
		return "markdownSite.skamster";
	}	
	
	public function getId(){
		return $this->id;
	}
	
	public function getJs(){
			return array("http://code.jquery.com/jquery-1.11.0.min.js", "http://code.jquery.com/jquery-migrate-1.2.1.min.js",$this->folder."markitup/jquery.markitup.js",$this->folder."markitup/sets/markdown/set.js");
	}
	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "This should work as a usual web/info-site .";
	}
	public function insertMDSite($name, $content){
        $escCont = str_replace("\r\n", "", $content);
		$this->connection->exec("INSERT INTO `".$this->dbPrefix."mdsite` (`name`, `content`) VALUES ('" . $name . "', '" .$escCont . "');");
		$this->updateMDSites();
	}
	
	public function deleteMDSite($id){
		$this->connection->exec("DELETE FROM `".$this->dbPrefix."mdsite` WHERE `id` = " . $id . "; ");
		$this->updateMDSites();
	}
	
	public function editMDSite($id, $name, $content){
        $escCont = str_replace("\r\n", "", $content);
		$this->connection->exec("UPDATE `".$this->dbPrefix."mdsite` SET `name` =  '" . $name . "',`content`='" .$escCont . "' WHERE `id`=".$id . " LIMIT 1 ;");
		$this->updateMDSites();
	}
	
	public function getMDSiteById($id){
		$sites = array();
		foreach($this->siteList as $site){
			if($site->id==$id){
				return $site;
			}
		}
	}
    
    public function getRequiredDojo(){
        if(!isset($_GET['singleViewId'])){
			return array("dojo.dnd.Source");
        }
	}
    
    	public function getOnLoadCode(){
		if(!isset($_GET['singleViewId'])){
			return 'dojo.connect(dragAndDropList,"onDndDrop",function(e){updateList()});';
		}
	}
	public function updateMDSites(){
		$this->siteList = array();
        $statement = $this->connection->query("SELECT * FROM `".$this->dbPrefix."mdsite` ORDER BY `order`;");
        if($statement===False){
            $statement = array();   
        }
		foreach($statement as $row){
            $escCont = str_replace("\r\n", "", $row['content']);
			array_push($this->siteList,new site($row['id'],$row['name'],$row['content'],$row['order']));
		}
	}
	public function start(){
		$this -> connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."mdsite` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` text NOT NULL,
			`content` text NOT NULL,
			`order` int(11) NOT NULL,
			PRIMARY KEY (`id`)
		)");
        $adminAccess = (($this->user->getPluginAccess()=="Admin")||($this->user->getAdmin()));
        $this->template->assign("folder", $this->folder);
		if(isset($_GET['singleEditViewId'])){
            if((isset($_POST['editMDSiteName']))&&(isset($_POST['editMDSiteContent']))){
                $this->editMDSite($_GET['singleEditViewId'],$_POST['editMDSiteName'],$_POST['editMDSiteContent']);
            }
			$this->template->assign("singleEditSite", $this->getMDSiteById($_GET['singleEditViewId']));
    
		}
		elseif(isset($_GET['singleViewId'])){
			$this->template->assign("siteListMenu", $this->siteList);
			$this->template->assign("singleViewSite", $this->getMDSiteById($_GET['singleViewId']));
		}
        elseif(($adminAccess)&&(isset($_POST['createMDSiteName']))&&(isset($_POST['createMDSiteContent']))){
            $this->insertMDSite($_POST['createMDSiteName'],$_POST['createMDSiteContent']);
            $this->template->assign("siteList", $this->siteList);
            $this->template->assign('newEnabled',True);
         }
		elseif(($adminAccess)&&isset($_GET['deleteMDSiteId'])){
            $this->deleteMDSite($_GET['deleteMDSiteId']);
         }
		elseif(($adminAccess)&&isset($_GET['doOrder'])){
			$order = 1;
			foreach($_POST['siteOrder'] as $siteId){
				$id = intval($siteId);
				if ((!empty($id))||($id!=0)) {
					$this->connection->exec("UPDATE `".$this->dbPrefix."mdsite` SET `order`=".$order." WHERE `id`=".$id . " LIMIT 1 ;");
					$order++;
				}
			}
            die();
		}
		else{
            if(($adminAccess)&&(isset($_GET['doEdit']))){

                $this->template->assign("siteList", $this->siteList);
                $this->template->assign('newEnabled',True);
                }
            else{
               if(sizeof($this->siteList) > 0){
                   $this->template->assign("siteListMenu", $this->siteList);
			       $this->template->assign("singleViewSite", $this->siteList[0]);
               }
                if($adminAccess){
                    $this->template->assign("editButton", true);    
                }
            }
		}
		$this->template->assign('pluginId',$_GET['plugin']);
		$this->template->display($this->folder.'mdSite.tpl');
	}
}
/**
* Dataobject represent DB
* Better do not use public variables like this, do getter and setter. This is just faster.
**/
class site{
	public $id;
	public $name;
	public $content;
	public $order;
    public $parsedContent;
	public function __construct($id,$name,$content,$order){
		$this->id = $id;
		$this->name=$name;
		$this->content=$content;
        require_once($this->folder.'Parsedown.php');
        $markDown = new Parsedown();
        $this->parsedContent = $markDown->text($content);
		$this->order=$order; }
}
?>
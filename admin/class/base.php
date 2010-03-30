<?php


class allowedSites{
	private $allAllowedSites = array();
	public function __construct($connection){
		foreach($connection->query('SELECT * FROM `config_loginneedlesssites`') as $siterow){
			$allowedSite = new allowedSite();
			$allowedSite->setId($siterow['id']);
			$allowedSite->setName($siterow['site']);
			array_push($this->allAllowedSites, $allowedSite);
		}
	}

	public function getAllowedSiteList(){
		return $this->allAllowedSites;
	}

	public function deleteAllowedSite($id, $connection){
		$connection->exec("DELETE FROM `learncards`.`config_loginneedlesssites` WHERE `config_loginneedlesssites`.`id` = ".$id);
		$tmpArray = array();
		foreach($this->allAllowedSites as $site){
			if($site->getId()!=$id){
				array_push($tmpArray, $site);
			}
		}
		$this->allAllowedSites = $tmpArray;
	}
	public function editSite($allowedSiteObject, $connection){
		$connection->exec("UPDATE `learncards`.`config_loginneedlesssites` SET `site` = '".$allowedSiteObject->getName()."' WHERE `config_loginneedlesssites`.`id` = ".$allowedSiteObject->getId());
		foreach($this->allAllowedSites as $site){
			if($site->getId()==$allowedSiteObject->getId());
			$site->setName($allowedSiteObject->getName());
		}
	}
	public function addSite($name, $connection){
		$connection->exec("INSERT INTO `learncards`.`config_loginneedlesssites` (`site`) VALUES ('".$name."');");
		$site = new allowedSite();
		$site->setName($name);
		$site->setId($connection->lastInsertId());
		array_push($this->allAllowedSites, $site);
	}

}

/**
 * AllowedSites is a simple class to protect you from SQL :)
 * Just use a object!
 * @author skamster
 *
 */
class allowedSite{
	private $id;
	private $name;

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setName($name){
		$this->name = $name;
	}
}

?>

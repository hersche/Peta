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
		if($connection->exec("DELETE FROM `learncards`.`config_loginneedlesssites` WHERE `config_loginneedlesssites`.`id` = ".$id)>0){
			$tmpArray = array();
			foreach($this->allAllowedSites as $site){
				if($site->getId()!=$id){
					array_push($tmpArray, $site);
				}
			}
			$this->allAllowedSites = $tmpArray;
			return "Site successfull deleted";
		}
		else{
			return "There are SQL-Problems. Nothing would be deleted!";
		}
	}
	public function editSite($id, $sitename, $connection){
		if($connection->exec("UPDATE `learncards`.`config_loginneedlesssites` SET `site` = '".$sitename."' WHERE `config_loginneedlesssites`.`id` = ".$id)>0){

			foreach($this->allAllowedSites as $site){
				if($site->getId()==$id){
					$site->setName($sitename);
					return "Site successfully changed";
				}
			}
		}
		else{
			return "There are SQL-Problems. Nothing changed!";
		}
	}
	public function addSite($name, $connection){
		if($connection->exec("INSERT INTO `learncards`.`config_loginneedlesssites` (`site`) VALUES ('".$name."');")>0){
			$site = new allowedSite();
			$site->setName($name);
			$site->setId($connection->lastInsertId());
			array_push($this->allAllowedSites, $site);
			return "Site ".$name." is successfully added";
		}
		else{
			return "A error happend. Nothings changed!";
		}
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

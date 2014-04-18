<?php

/**
 * AllowedSites means the sites which are public and don't need a login.
 * @author skamster
 *
 */
class allowedSites{
	private $allAllowedSites = array();
	/**
	 * The construct get all allowedsites in the beginn..
	 * @param unknown_type $connection
	 */
	public function __construct($connection){
		foreach($connection->query('SELECT * FROM `config_loginneedlesssites`') as $siterow){
			$allowedSite = new allowedSite();
			$allowedSite->setId($siterow['id']);
			$allowedSite->setName($siterow['site']);
			array_push($this->allAllowedSites, $allowedSite);
		}
	}
	/**
	 * Get the list of allowed sites..
	 */
	public function getAllowedSiteList(){
		return $this->allAllowedSites;
	}
	
	/**
	 * Delete a site
	 * @param unknown_type $id
	 * @param unknown_type $connection
	 */
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
	/**
	 * Edit a such site..
	 * @param unknown_type $id
	 * @param unknown_type $sitename
	 * @param unknown_type $connection
	 */
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
	/**
	 * Add a site.. but take care! This works with regex!!!
	 * @param unknown_type $name
	 * @param unknown_type $connection
	 */
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
 * AllowedSites is a simple class to protect you from SQL (as a programmer) :)
 * This object represents a single allowed site, that means, one site, which doesn't need a login.
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

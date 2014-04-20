<?php
/**
 * Role-Object to make access more easy..
 * it's the same as it is in the db-table
 */
class role {
	private $id;
	private $role;
	private $admin;
	private $accessRights;
	
	/**
	 * Returns the id of the role
	 * @return int the role-id
	 */
	public function getId() {
		return $this -> id;
	}

	/**
	 * Get the rolename
	 * @return String the rolename
	 */
	public function getRole() {
		return $this -> role;
	}

	/**
	 * Return if it's a adminrole or not
	 * @return boolean if admin or not
	 */
	public function getAdmin() {
		return $this -> admin;
	}
	
	public function getAccessRights() {
		return $this -> accessRights;
	}
	
	public function getAccesRightsString(){
		return $this -> convertAccessToString($this->accessRights);
	}
	
	public function setAccessRights($ar) {
		$this -> accessRights = $this->convertAccessToInt($ar);
	}
	
	public function convertAccessToInt($access){
		$access=strtoupper($access);
		$sqlAccess=0;
		if($access=="READ"){
			return 1;
		}
		elseif($access=="READWRITE"){
			return 2;
		}
		elseif($access=="ADMIN"){
			return 3;
		}
		if(is_int(intval($access))){
			return intval($access);
		}
		return $sqlAccess;
	}
	
	public function convertAccessToString($intAccess){
		$sqlAccess="Null";
		$intAccess = intval($intAccess);
		
		if($intAccess==1){
			return "Read";
		}
		elseif($intAccess==2){
			return "ReadWrite";
		}
		elseif($intAccess==3){
			return "Admin";
		}
		return $sqlAccess;
	}
	
	/**
	 * Set the id (no db!)
	 */
	public function setId($id) {
		$this -> id = $id;
	}

	public function setRole($role) {
		$this -> role = $role;
	}

	public function setAdmin($admin) {
		if ($admin == 0) {
			$this -> admin = false;
		} else if ($admin == 1) {
			$this -> admin = true;
		} else {
			$this -> admin = $admin;
		}
	}
	
	public function getAccessStringList(){
		return array("Read", "ReadWrite", "Admin");
	}
}

?>
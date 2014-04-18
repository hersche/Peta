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
	public function setAccessRights($ar) {
		$this -> accessRights = $ar;
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

}

?>
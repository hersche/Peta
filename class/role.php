<?php
/**
 * Role-Object to make access more easy..
 * it's the same as it is in the db-table
 */
class role {
	private $id;
	private $role;
	//$admin seems @deprecated
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
	 * @return bool if admin or not
	 */
	public function getAdmin() {
		return $this -> admin;
	}
	/**
	 * Get the access-right on this plugin with this user in form of a int.
	 * It is always one int, but readwrite are 2 rights.
	 * 1 = READ
	 * 2 = READWRITE
	 * 3 = ADMIN
	 * 0 = Fail
	 * @return int accessRights
	 * 
	 */
	public function getAccessRights() {
		return $this -> accessRights;
	}

	/**
	 * Same method as getAccessRights, but with a string.
	 * @eturn str READ, READWRITE or ADMIN. Failurevalue is "Null" (as String)
	 */
	public function getAccesRightsString() {
		return $this -> convertAccessToString($this -> accessRights);
	}

	/**
	 * Set accessrights to role
	 */
	public function setAccessRights($ar) {
		$this -> accessRights = $this -> convertAccessToInt($ar);
	}

	public function convertAccessToInt($access) {
		$access = strtoupper($access);
		$sqlAccess = 0;
		if ($access == "READ") {
			return 1;
		} elseif ($access == "READWRITE") {
			return 2;
		} elseif ($access == "ADMIN") {
			return 3;
		}
		if (is_int(intval($access))) {
			return intval($access);
		}
		return $sqlAccess;
	}

	public function convertAccessToString($intAccess) {
		$sqlAccess = "Null";
		$intAccess = intval($intAccess);

		if ($intAccess == 1) {
			return "Read";
		} elseif ($intAccess == 2) {
			return "ReadWrite";
		} elseif ($intAccess == 3) {
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

	/**
	 * Propably deprecated, better not use
	 */
	public function setAdmin($admin) {
		if ($admin == 0) {
			$this -> admin = false;
		} else if ($admin == 1) {
			$this -> admin = true;
		} else {
			$this -> admin = $admin;
		}
	}

	public function getAccessStringList() {
		return array("Read", "ReadWrite", "Admin");
	}

}
?>
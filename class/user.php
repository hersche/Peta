<?php

abstract class abstractUser {
	abstract public function getId();
	abstract public function getUsername();
}

/**
 * This class is a logged in user..
 * It's necessary to be login here! For informations of other user use the alienobject
 * @author skamster
 *
 */
class user extends abstractUser {
	private $username;
	private $name;
	private $lastip;
	private $lastlogin;
	private $currentip;
	private $currentlogin;
	private $id;
	private $welcome = true;
	private $messages = array();
	private $roles = array();
	private $customfields = array();
    private $password;
	public $urow;
	private $connection;
    private $admin;
    private $pluginAccess;
	// private $connection;


	/**
	 * This do the login
	 * @param String $username is the username
	 * @param String $password is the password
	 * @param unknown_type $connection is a pdo-object with the right informations
	 */
	public function __construct($username, $password, $connection) {
		if ((!empty($username)) && (!empty($password))) {
			$connection -> exec("CREATE TABLE IF NOT EXISTS `user` (
				`uid` int(11) NOT NULL AUTO_INCREMENT,
				`username` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
				`password` varchar(1026) COLLATE utf8_unicode_ci NOT NULL,
				`lastlogin` date NOT NULL,
				`lastip` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
				PRIMARY KEY (`uid`)
			)");
			$connection -> exec("CREATE TABLE IF NOT EXISTS `user_customfields` (
				`cf_id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'id 4 customfields',
				`cf_uid` int(11) DEFAULT NULL,
				`cf_key` varchar(30) NOT NULL,
				`cf_value` text NOT NULL,
				`cf_order` int(11) NOT NULL,
			PRIMARY KEY (`cf_id`)
			)");
			$connection -> exec("CREATE TABLE IF NOT EXISTS `user_role` (
				`ur_uid` int(11) NOT NULL,
				`ur_rid` int(11) NOT NULL
			)");
			
			$password = hash($GLOBALS["password_hash"], $password);
			$userstatement = $connection -> query('SELECT * FROM user WHERE username="' . $username . '" AND password="' . $password . '"  LIMIT 1;');
			$userrow = $userstatement -> fetch(PDO::FETCH_ASSOC);
			if (sizeof($userrow) == 5) {
				$this -> id = $userrow['uid'];
				$this -> username = $userrow['username'];
				$this -> currentip = getenv('REMOTE_ADDR');
				$this -> lastip = $userrow['lastip'];
				$this -> lastlogin = $userrow['lastlogin'];
				$this -> password = $userrow['password'];
				$datetime = new DateTime($GLOBALS["timezone"]);
				$this -> currentlogin = $datetime -> format("Y-m-d h:s");
				$connection -> exec('UPDATE users SET lastlogin="' . $this -> currentlogin . '", lastip="' . $this -> currentip . '" WHERE username="' . $this -> username . ' AND password="' . $this -> password . '";');
				$_SESSION["user"] = $this;
				$this -> roles = usertools::mkRoleObjects(user::initialiseRoles($this -> id, $connection));

			} else {
				throw new Exception("No user found");
			}
		//	$this->connection = $connection;
		}
	}

	/**
	 * Temporary method to use it also in alienuser..
	 **/
	public static function initialiseRoles($userId, $connection) {
		//Hole alle Rollen-ID's des Users
		$tmpRids = array();
		foreach ($connection->query('SELECT * FROM user_role WHERE ur_uid="'.$userId.'";') as $tmpRid) {
			$tmpRids[] = $tmpRid['ur_rid'];
		}
		// Create the SQL-Command
		$roleSQL = "SELECT * FROM role WHERE ";
		for ($i = 0; $i < sizeof($tmpRids); $i++) {
			$roleSQL .= "rid=" . $tmpRids[$i];
			if ($i != sizeof($tmpRids) - 1) {
				$roleSQL .= " OR ";
			}
		}
		$roleSQL .= ";";
		$returnArray = array();
		foreach ($connection->query($roleSQL) AS $roleRow) {
			$returnArray[] = $roleRow;
		}
		return $returnArray;
	}
	public function editCustomfield($id,$key,$value,$connection){
		//var_dump('UPDATE user_customfields SET cf_key="' . $key . '",cf_value="' . $value . '" WHERE cf_id=' . $id . ';');
		$connection->exec('UPDATE user_customfields SET cf_key="' . $key . '",cf_value="' . $value . '" WHERE cf_id=' . $id . ';');
		
		//if ($this -> customfields == Null) {
			$this -> customfields = Null;
			$this -> initialiseCustomfields($connection);
		//}
	}
    
    
    
    public function getUrow() {
		return $this -> urow;
	}

    public function setAdmin($admin){
        $this->admin = $admin;      
    }
    
    public function setPluginAccess($pluginAccess){
        $this->pluginAccess = $pluginAccess;   
    }
    
    
    public function getPluginAccess(){
     return $this->pluginAccess;   
    }
    public function getAdmin(){
     return $this->admin;   
    }
    
    
	private function initialiseCustomfields($connection) {
		foreach ($connection->query('SELECT * FROM user_customfields WHERE cf_uid="'.$this->id.'" ORDER BY `cf_order`;') as $customfieldrow) {
			$customfield = new customfield();
			$customfield -> setId($customfieldrow[cf_id]);
			$customfield -> setKey($customfieldrow[cf_key]);
			$customfield -> setValue($customfieldrow[cf_value]);
			$this -> customfields[] = $customfield;
		}
	}
	public function orderCustomfields($cmOrderList, $connection){
		$order = 1;
		try{
		  foreach($cmOrderList as $cmId){
			$id = intval($cmId);
			if (!empty($id)) {
				$connection->exec("UPDATE `user_customfields` SET `user_customfields`.`cf_order`='".$order."' WHERE `user_customfields`.`cf_id`=".$id . " LIMIT 1 ;");
				$order++;
			     }	
			}
		}
        catch (Exception $e){
            throw new Exception($e->getMessage( ));
        }
		$this->customfields = Null;
		$this->initialiseCustomfields($connection);
	
	}
	public function getCustomfields($connection) {
		if ($this -> customfields == Null) {
			$this -> initialiseCustomfields($connection);
		}
		return $this -> customfields;
	}

	public function addCustomfield($key, $value,$connection) {
		$connection -> exec('INSERT INTO user_customfields (cf_uid, cf_key, cf_value) VALUES (' . $this -> id . ', "' . $key . '", "' . $value . '");');
		$this -> customfields = Null;
		$this -> initialiseCustomfields($connection);
	}

	public function getCustomfieldByKey($key) {
		if ($this -> customfields == Null) {
			$this -> initialiseCustomfields();
		}
		foreach ($this->customfields AS $cf) {
			if ($cf -> getKey() == $key) {
				return $cf;
			}
		}
	}
	public function getCustomfieldById($id) {
		if ($this -> customfields == Null) {
			$this -> initialiseCustomfields();
		}
		foreach ($this->customfields AS $cf) {
			if ($cf -> getId() == $id) {
				return $cf;
			}
		}
	}
	public function addRole($roleid,$connection) {
		$yesorno = true;
		foreach ($this->getRolesIds() as $key => $value) {
			if ($value == $roleid) {
				$yesorno = false;
			}
		}
		if ($yesorno) {
			$connection -> exec('INSERT INTO user_role (ur_uid, ur_rid) VALUES (' . $this -> id . ', "' . $roleid . '";');
			$this -> roles = usertools::mkRoleObjects(user::initialiseRoles($this -> id, $this->connection));
		}
	}

	public function delRole($roleid, $connection) {
		$connection->exec('DELETE FROM `user_role` WHERE `ur_uid` = ' . $this -> id . ' and ur_rid=' . $roleid . ';');
	}

	public function removeCustomfield($id, $connection) {
		$connection->exec('DELETE FROM `user_customfields` WHERE `user_customfields`.`cf_id` = ' . $id . ';');
		$this -> customfields = Null;
		$this -> initialiseCustomfields($connection);
	}

	/**
	 * Change the password of a user
	 * @param $newPassword
	 * @param $oldPassword
	 * @param $connection
	 */
	public function setPassword($newPassword, $oldPassword, $connection) {
		if (hash($GLOBALS["password_hash"], $oldPassword) == $this -> password) {
			usertools::setPassword($this -> username, $newPassword, $connection);
		}
	}

	public function getRolesIds() {
		$roleIds = array();
		foreach ($this->roles AS $role) {
			$roleIds[] = $role -> getId();
		}
		return $roleIds;
	}

	/**
	 * Get the hashed password of a user
	 */
	public function getPassword() {
		return $this -> password;
	}

	/**
	 * Disable the welcome-message
	 */
	public function disableWelcome() {
		$this -> welcome = false;
	}

	/**
	 * Was the user logged in for one time?
	 */
	public function getWelcome() {
		return $this -> welcome;
	}

	/**
	 * Get the id
	 */
	public function getId() {
		return $this -> id;
	}

	/**
	 * Get some messages for the channel (not im-messages, error-messages!)
	 */
	public function getMessages() {
		return $this -> messages;
	}

	/**
	 * Let's get all the roles a user have
	 */
	public function getRoles() {
		return $this -> roles;
	}

	/**
	 * get the username
	 */
	public function getUsername() {
		return $this -> username;
	}

	/**
	 * get the lastLogin as a date
	 */
	public function getLastLogin() {
		return $this -> lastlogin;
	}

	/**
	 * get the last used ip
	 */
	public function getLastIp() {
		return $this -> lastip;
	}

	/**
	 * Check, if the user is realy a user-object
	 * @return string|string
	 */
	public function isValid() {
		if ($_SESSION["user"] == $this) {
			return true;
		}
		return false;
	}

	/**
	 * Do logout the user
	 */
	public function logout() {
		unset($_SESSION["user"]);
	}

}

/**
 * Customfield represent a customfield (short: cf) which use a key/value-princip to make every profile individual
 */
class customfield {
	private $id;
	private $key;
	private $value;

	public function setId($id) {
		$this -> id = $id;
	}

	/**
	 * Get the ID of a cf
	 * @return int id
	 */
	public function getId() {
		return $this -> id;
	}

	public function setKey($key) {
		$this -> key = $key;
	}

	/**
	 * Get the key of a cf
	 * @return String key
	 */
	public function getKey() {
		return $this -> key;
	}

	public function setValue($value) {
		$this -> value = $value;
	}

	/**
	 * Return the value of a cf
	 * @return String value
	 */
	public function getValue() {
		return $this -> value;
	}

}

/**
 * A alienuser is a just-information-user, so just for profiles and so on..
 * @author skamster
 *
 */
class alienuser extends abstractUser {
	private $username;
	private $id;
	private $password;
	private $lastlogin;
	private $roles = array();
	private $customfields = array();
    private $pluginAccess;

	public function getUsername() {
		return $this -> username;
	}

	public function setUsername($username) {
		$this -> username = $username;
	}

	public function getPassword() {
		return $this -> password;
	}
    public function setAdmin($admin){
        $this->admin = $admin;      
    }
    
    public function setPluginAccess($pluginAccess){
        $this->pluginAccess = $pluginAccess;   
    }
    
    
    public function getPluginAccess(){
     return $this->pluginAccess;   
    }
    public function getAdmin(){
     return false;   
    }
	public function getRoles() {
		return $this -> roles;
	}

	public function setRoles($roles) {
		$this -> roles = $roles;
	}

	public function delRole($roleid, $connection) {
		$connection -> exec('DELETE FROM `user_role` WHERE `ur_uid` = ' . $this -> id . ' and ur_rid=' . $roleid . ';');
	}

	public function addRole($roleid, $connection) {
		$yesorno = true;
		foreach ($this->getRolesIds() as $key => $value) {
			if ($value == $roleid) {
				$yesorno = false;
			}
		}
		if ($yesorno) {
			$connection -> exec('INSERT INTO user_role (ur_uid, ur_rid) VALUES (' . $this -> id . ', ' . $roleid . ');');
			$this -> roles = usertools::mkRoleObjects(user::initialiseRoles($this -> id, $connection));
		}
	}
	public function addRoleToRam($roleObject){
		array_push($this->roles, $roleObject);
	}
	public function setPassword($password) {
		$this -> password = $password;
	}

	public function getId() {
		return $this -> id;
	}
	public function getWelcome(){
		return False;
	}
	public function setId($id) {
		$this -> id = $id;
	}

	public function getLastlogin() {
		return $this -> lastlogin;
	}

	public function setLastlogin($lastlogin) {
		$this -> lastlogin = $lastlogin;
	}

	public function getRolesIds() {
		$roleIds = array();
		foreach ($this->roles AS $role) {
			$roleIds[] = $role -> getId();
		}
		return $roleIds;
	}
	
	public function isValid(){
		return False;
	}
	private function initialiseCustomfields($connection) {
		foreach ($connection->query('SELECT * FROM user_customfields WHERE cf_uid="'.$this->id.'";') as $customfieldrow) {
			$customfield = new customfield();
			$customfield -> setId($customfieldrow[cf_id]);
			$customfield -> setKey($customfieldrow[cf_key]);
			$customfield -> setValue($customfieldrow[cf_value]);
			$this -> customfields[] = $customfield;
		}
	}

	public function getCustomfields($connection) {
		if ($this -> customfields == Null) {
			$this -> initialiseCustomfields($connection);
		}
		return $this -> customfields;
	}
}

/**
 * usertools is a little collection of static tools to make a faster developement possible..
 * @author skamster
 *
 */
class usertools {
	/**
	 * create a user
	 * @param array $post your post-variable <br />
	 * it must contain<br />
	 * password<br />
	 * password2<br />
	 * username<br />
	 * role<br />
	 * name<br />
	 * @param unknown_type $connection
	 */
	public static function registerUser($post, $connection) {
		if ((!empty($post))&&($GLOBALS['registration'])) {
			if (($post['registerPassword'] == $post['registerPassword2']) && (!empty($post['registerEmail'])) && (usertools::passwordRequirements($post['registerPassword'], $GLOBALS["min_password_length"], $GLOBALS["password_need_specialchars"]))) {
				if (!usertools::userExists($post['registerUsername'], $connection)) {
					try {

						$password = hash($GLOBALS["password_hash"], $post['registerPassword']);
						// TODO check for specialchars!
						$datetime = new DateTime($GLOBALS["timezone"]);
						$connection -> exec("INSERT INTO user (`username`, `password`, `lastlogin`, `lastip`) VALUES ('" . $post['registerUsername'] . "', '" . $password . "', '" . $datetime -> format('Y-m-d ') . "', '" . getenv('REMOTE_ADDR') . "');");
						$userid = $connection -> lastInsertId();
						$connection -> exec("INSERT INTO user_customfields (`cf_uid`, `cf_key`, `cf_value`) VALUES ('" . $userid . "', 'E-Mail', '" . $post[registerEmail] . "');");
						if (!empty($GLOBALS["defaultRole"])) {
							$roleid = usertools::getIdFromRole($GLOBALS["defaultRole"], $connection);
							$connection -> exec("INSERT INTO user_role (`ur_uid`, `ur_rid`) VALUES ('" . $userid . "', '" . $roleid . "');");
						}
						return "0";
					} catch (Exception $e) {
						return "Error is happend: " . $e;
					}
				} else {
					return "User does already exist";
				}
			} else {
				return "Something is strange with your password. Remember: <br /> It needs at least " . $GLOBALS["min_password_length"] . " signs<br />You should type two passwords which are the same (to confirm)";
			}
		}
		else{
			return "Corrupt post-data or registration is disabled. Do you try to hack? Fool!";
		}
	}

	/**
	 * get a alienuser
	 * @param $id
	 * @param $connection
	 */
	static public function getAlienUserbyId($id, $connection) {
		try {
			$alien = new alienuser();
			foreach ($connection->query('SELECT * FROM user WHERE uid='.$id.' LIMIT 1;') as $userrow) {
				$alien -> setId($userrow['uid']);
				$alien -> setLastlogin($userrow['lastlogin']);
				$alien -> setUsername($userrow['username']);
				$alien -> setPassword($userrow['password']);
				$alien -> setRoles(usertools::mkRoleObjects(user::initialiseRoles($userrow['uid'], $connection)));

			}
			return $alien;
		} catch (Exception $e) {
			return 'Exception abgefangen: ' . $e -> getMessage();
		}

	}

	static public function getAlienUserbyUsername($username, $connection) {
		$alien = new alienuser();
		foreach ($connection->query('SELECT * FROM user WHERE username="'.$username.'" LIMIT 1;') as $userrow) {
			$alien -> setId($userrow['uid']);
			$alien -> setLastlogin($userrow['lastlogin']);
			$alien -> setUsername($userrow['username']);
			$alien -> setPassword($userrow['password']);
			$alien -> setRoles(usertools::mkRoleObjects(user::initialiseRoles($userrow['uid'], $connection)));
		}

		return $alien;
	}

	/**
	 * Check, if a user exists (with name)
	 * @param unknown_type $username
	 * @param unknown_type $connection
	 */
	static public function userExists($username, $connection) {
		foreach ($connection->query('SELECT * FROM user WHERE username="'.$username.'";') as $userrow) {
			return true;
		}
		return false;
	}

	static public function userIdExists($id, $connection) {
		foreach ($connection->query('SELECT * FROM user WHERE uid="'.$id.'";') as $userrow) {
			return true;
		}
		return false;
	}
	/**
	 * What's required for a password? is the password strong enough?
	 * @param unknown_type $password
	 * @param unknown_type $lenght
	 * @param unknown_type $specialchars
	 */
	static public function passwordRequirements($password, $lenght, $specialchars) {
		if (strlen($password) >= $lenght) {
			return true;
		}
		return false;
	}

	/**
	 * contain the user one of the necessary roles? use getRoles of the user-object!
	 * @param $roles
	 * @param $userRoles
	 * @TODO use $roles the same way as userRoles (change in default.php)
	 */
	static public function containRoles($roles, $userRoles) {
		foreach ($roles as $role) {
			foreach ($userRoles as $userRole) {
				if ($role == $userRole -> getRole()) {
					return true;
				}
			}
		}
		return false;
	}

	/**
	 *
	 * @param int $oldUserId
	 * @param array $editUser a post-variable which contains a user..
	 * working var-names:
	 * password = cleartext-password<br />
	 * name = the name of the user..<br />
	 * username = the username<br />
	 * role = the new role
	 * @param PDO $connection
	 */
	static public function editUser($oldUserId, $editUser, $connection) {
		if (!empty($editUser)) {
			$fakeOldUser = usertools::getAlienUserbyId($oldUserId, $connection);
			$changes = false;
			$changeSQL = array();
			$remeberExisting = array();
			$userRoleIds = array();
			$getUsedRoles = array();
			foreach (array_keys($_POST) as $key) {
				if (substr($key, 0, 5) == "role_") {
					$getUsedRoles[] = $_POST[$key];
				}
			}

			foreach ($fakeOldUser->getRoles() AS $uRole) {
				$userRoleIds[] = $uRole -> getId();
			}
			if ((!empty($editUser['role'])) && ($fakeOldUser -> getUsername() != $editUser['username'])) {
				array_push($changeSQL, ' name="' . $editUser['name'] . '"');
				if ($_SESSION['user'] -> getId() == $oldUserId) {
					$_SESSION['user'] -> setName($editUser['name']);
				}
				$changes = true;
			}
			if (!empty($editUser['password'])) {
				$password = hash($GLOBALS["password_hash"], $editUser['password']);
				if ($fakeOldUser -> getPassword() != $password) {
					usertools::setPassword($fakeOldUser -> getUsername(), $editUser['password'], $connection);
					$changes = true;
				}
			}

			usertools::setRole($fakeOldUser, $getUsedRoles, $connection);
			$changes = true;
		}

		if ($changes) {
			$SQLUpdate = "UPDATE users_profile SET";
			foreach ($changeSQL as $singlechange) {
				$SQLUpdate .= $singlechange;
			}
			$SQLUpdate .= ' WHERE user_profile_id="' . $fakeOldUser -> getId() . '";';
			$connection -> exec($SQLUpdate);
		}
	}

	/**
	 * Set new roles
	 * @param int $userid
	 * @param String $oldRole
	 * @param String $newRole
	 * @param PDO $connection
	 * DEPRECATED
	 **/

	//new roles = getusedroles
	static public function setRole($user, $newRoles, $connection) {
		if (sizeof($newRoles) != 0) {
			$removeRoles = array_diff($user -> getRolesIds(), $newRoles);
			foreach ($removeRoles as $rRole) {
				$user -> delRole($rRole, $connection);
			}
		}
		foreach ($newRoles as $addRole) {
			$user -> addRole($addRole, $connection);
		}

	}

	public static function mkRoleObjects($dbRoles) {
		$roleObjects = array();
		foreach ($dbRoles AS $dbRole) {
			$roleObject = new role();
			$roleObject -> setId($dbRole['rid']);
			$roleObject -> setRole($dbRole['role']);
			$roleObjects[] = $roleObject;
		}
		return $roleObjects;
	}

	public static function getIdFromRole($role, $connection) {
		foreach ($connection->query('SELECT * FROM role WHERE role="'.$role.'" LIMIT 1;') as $rolerow) {
			return $rolerow['rid'];
		}
	}

	/**
	 * Set a password
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @param unknown_type $connection
	 */
	static public function setPassword($username, $password, $connection) {
		if (usertools::passwordRequirements($password, $GLOBALS["min_password_length"], $GLOBALS["password_need_specialchars"])) {
			$password = hash($GLOBALS["password_hash"], $password);
			$connection -> exec('UPDATE users SET password="' . $password . '" WHERE username="' . $username . '";');
		}
	}

	/**
	 * Resolve a username with a id..
	 * @param unknown_type $userid
	 * @param unknown_type $connection
	 */
	static public function getUsernameById($userid, $connection) {
		foreach ($connection->query('SELECT * FROM user WHERE uid="'.$userid.'";') as $userrow) {
			return $userrow['username'];
		}
	}

    
    static public function deleteUser($id, $connection){
        $connection -> exec('DELETE FROM `user_role` WHERE `ur_uid` = ' . $id .';');
        $connection -> exec('DELETE FROM `user_customfields` WHERE `cf_uid` = ' . $id .';');
        $connection -> exec('DELETE FROM `user` WHERE `uid` = ' . $id .';');
    }
	/**
	 * Resolve a username with a id..
	 * @param unknown_type $userid
	 * @param unknown_type $connection
	 */
	static public function getUserById($userid, $connection) {
		foreach ($connection->query('SELECT * FROM user WHERE uid="'.$userid.'";') as $userrow) {
			return $userrow['username'];
		}
	}

}
?>
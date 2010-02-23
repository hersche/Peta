<?php
class user{
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
	private $password;
	// private $connection;

	public function __construct($username, $password, $connection){
		if((!empty($username))&&(!empty($password))){
			$firstRound = true;
			// $this->connection = $connection;
			$password = hash($GLOBALS["password_hash"], $password);

			foreach($connection->query('SELECT * FROM fullUser WHERE username="'.$username.'" AND password="'.$password.'";') as $userrow){
				if($firstRound){
					$this->id = $userrow['id'];
					$this->name = $userrow['name'];
					$this->username = $userrow['username'];
					$this->currentip = getenv('REMOTE_ADDR');
					$this->lastip = $userrow['lastip'];
					$this->lastlogin = $userrow['lastlogin'];
					$this->password = $userrow['password'];
					array_push($this->roles, $userrow["role"]);
					$datetime = new DateTime($GLOBALS["timezone"]);
					$this->currentlogin = $datetime->format("Y-m-d");
					$connection->exec('UPDATE users SET lastlogin="'.$this->currentlogin.'", lastip="'.$this->currentip.'" WHERE username="'.$this->username.' AND password="'.$this->password.'";');
					$_SESSION["user"] = $this;
					$firstRound = false;
				}
				else{
					array_push($this->roles, $userrow["role"]);
				}
			}

		}
	}

	public function setPassword($newPassword,$oldPassword, $connection){
		if(hash($GLOBALS["password_hash"], $oldPassword)==$this->password){
			usertools::setPassword($this->username, $newPassword, $connection);
		}
	}

	public function disableWelcome(){
		$this->welcome = false;
	}
	public function getWelcome(){
		return $this->welcome;
	}

	public function getId() {
		return $this->id;
	}
	public function getMessages(){
		return $this->messages;
	}

	public function getRoles(){
		return $this->roles;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getName(){
		return $this->name;
	}

	public function getLastLogin(){
		return $this->lastlogin;
	}
	public function getLastIp(){
		return $this->lastip;
	}

	public function isValid(){
		if($_SESSION["user"]==$this){
			return true;
		}
		return false;
	}

	public function logout(){
		unset($_SESSION["user"]);
	}



}
class usertools{
	static public function registerUser($name, $username, $password, $role, $connection){
		if(usertools::passwordRequirements($password, $GLOBALS["min_password_length"], $GLOBALS["password_need_specialchars"])){
			if(!usertools::userExists($username, $connection)){
				try{
					$password = hash($GLOBALS["password_hash"], $password);
					// TODO check for specialchars!
					$datetime = new DateTime($GLOBALS["timezone"]);
					$connection->exec("INSERT INTO users (`username`, `password`, `lastlogin`, `lastip`) VALUES ('".$username."', '".$password."', '".$datetime->format('Y-m-d')."', '".getenv('REMOTE_ADDR')."');");
					$userid = $connection->lastInsertId();
					$connection->exec("INSERT INTO users_profile (`user_profile_id`, `name`, `schule`, `klasse`, `mail`, `hobbys`) VALUES ('".$userid."', '".$name."', '', '', '', '');");
					$connection->exec("INSERT INTO userrole (`buserid`, `broleid`) VALUES ('".$userid."', '".$role."');");
					return "User ".$username." was created successfull!";
				}
				catch (Exception $e){
					return "Error is happend: ".$e;
				}
			}
			else{
				return "User does already exist";
			}
		}
		else{
			return "Your password is to short. It needs at least ".$GLOBALS["min_password_length"]." signs";
		}
	}
	static public function userExists($username, $connection){
		foreach($connection->query('SELECT * FROM fullUser WHERE username="'.$username.'";') as $userrow){
			return true;
		}
		return false;
	}
	static public function passwordRequirements($password, $lenght, $specialchars){
		if(strlen($password)>=$lenght){
			return true;
		}
		return false;
	}

	static public function containRoles($roles, $userRoles){
		foreach($roles as $role){
			foreach($userRoles as $userRole){
				if($role==$userRole){
					return true;
				}
			}
		}
		return false;
	}

	static public function editUser($oldUser,$editUser, $connection){
		$changes = false;
		$password = hash($GLOBALS["password_hash"], $editUser['password']);
		$changeSQL = array();
		if($oldUser['name']!=$editUser['name']){
			array_push($changeSQL, ' name="'.$editUser['name'].'"');
			$changes = true;
		}
		if($oldUser['password']!=$password){
			usertools::setPassword($oldUser['username'], $editUser['password'], $connection);
		}
		if($oldUser['broleid']!=$editUser['broleid']){
			usertools::setRole($oldUser['id'], $oldUser['broleid'], $editUser['broleid'], $connection);
		}
		if($changes){
			$SQLUpdate = "UPDATE users_profile SET";
			foreach($changeSQL as $singlechange){
				$SQLUpdate .= $singlechange;
			}
			$SQLUpdate .= ' WHERE user_profile_id="'.$oldUser["id"].'";';
			$connection->exec($SQLUpdate);
		}
	}

	static public function setRole($userid, $oldRole, $newRole, $connection){
		echo 'UPDATE userrole SET broleid="'.$newRole.'" WHERE buserid="'.$userid.' AND broleid="'.$oldRole.'";';
		$connection->exec('UPDATE userrole SET broleid="'.$newRole.'" WHERE buserid="'.$userid.'" AND broleid="'.$oldRole.'";');
	}

	static public function setPassword($username, $password, $connection){
		if(usertools::passwordRequirements($password, $GLOBALS["min_password_length"], $GLOBALS["password_need_specialchars"])){
			$password = hash($GLOBALS["password_hash"], $password);
			$connection->exec('UPDATE users SET password="'.$password.'" WHERE username="'.$username.'";');
		}
	}
	static public function getUsernameById($userid, $connection){
		foreach($connection->query('SELECT * FROM fullUser WHERE id="'.$userid.'";') as $userrow){
			return $userrow['username'];
		}
	}
}
?>
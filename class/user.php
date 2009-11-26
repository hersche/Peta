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
	// private $connection;

	public function __construct($username, $password, $connection){
		if((!empty($username))&&(!empty($password))){
			$firstRound = true;
			// $this->connection = $connection;
			$password = hash($GLOBALS["password_hash"], $password);
			try{
				foreach($connection->query('SELECT * FROM fullUser WHERE username="'.$username.'" AND password="'.$password.'";') as $userrow){
						if($firstRound){
							$this->id = $userrow['id'];
							$this->name = $userrow['name'];
							$this->username = $userrow['username'];
							$this->currentip = getenv('REMOTE_ADDR');
							$this->lastip = $userrow['lastip'];
							$this->lastlogin = $userrow['lastlogin'];
							array_push($this->roles, $userrow["role"]);
							$datetime = new DateTime();
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
			catch (Exception $e){
				echo "Error: ".$e->getMessage();
			}

			//			return "Password wrong or user not found!";
		}
		else{
			// unset($_SESSION["user"]);
			echo "Fill the fields!";
		}
	}

	public function setPassword($password){

		if(usertools::passwordRequirements($password, $GLOBALS["min_password_length"], $GLOBALS["password_need_specialchars"])){
					$password = hash($GLOBALS["password_hash"], $password);
		$this->connection->exec('UPDATE users SET password="'.$this->currentlogin.'" WHERE username="'.$this->username.' AND password="'.$this->password.'";');
		}
	}

	public function disableWelcome(){
		$this->welcome = false;
	}
	public function getWelcome(){
		return $this->welcome;
	}
	public function getMessages(){
		return $this->messages;
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
					$datetime = new DateTime();
					$connection->exec("INSERT INTO users (`username`, `password`, `lastlogin`, `lastip`) VALUES ('".$username."', '".$password."', '".$datetime->format('Y-m-d')."', '".getenv('REMOTE_ADDR')."');");
					$userid = $connection->lastInsertId();
					$connection->exec("INSERT INTO users_profile (`user_profile_id`, `name`, `schule`, `klasse`, `mail`, `hobbys`) VALUES ('".$userid."', '".$name."', '', '', '', '');");
					$connection->exec("INSERT INTO userrole (`buserid`, `broleid`) VALUES ('".$userid."', '1');");
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
}
?>
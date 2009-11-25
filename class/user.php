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

	public function __construct($username, $password, $connection){
		if((!empty($username))&&(!empty($password))){
			$firstRound = true;
			$password = hash($GLOBALS["password_hash"], $password);
			foreach($connection->query('SELECT * FROM fullUser WHERE username="'.$username.'" AND password="'.$password.'";') as $userrow){
				if($password == $userrow['password']){
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
						$connection->exec('UPDATE users SET lastlogin="'.$this->currentlogin.'", lastip="'.$this->currentip.'" WHERE username="'.$this->username.'";');
						$_SESSION["user"] = $this;
						$firstRound = false;
					}
					else{

					}
				}
			}
			array_push($this->messages, "Password wrong or user not found!");
		}
		else{
			unset($_SESSION["user"]);
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
class register{
	static public function registerUser($name, $username, $password, $role, $connection){
		if(strlen($password)>=$GLOBALS["min_password_length"]){
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
			return "Your password is to short. It needs at least ".$GLOBALS["min_password_length"]." signs";
		}
	}
}
?>
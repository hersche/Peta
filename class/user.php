<?php
class user{
	private $username;
	private $name;
	private $lastip;
	private $lastlogin;
	private $currentip;
	private $currentlogin;
	private $id;
	private $role;
	private $messages = array();

	public function __construct($username, $password, $connection){
		if((!empty($username))&&(!empty($password))){
			$password = hash($GLOBALS["password_hash"], $password);
			foreach($connection->query('SELECT * FROM fullUser WHERE username="'.$username.'";') as $userrow){
				if($password == $userrow['password']){
					$this->id = $userrow['id'];
					$this->name = $userrow['name'];
					$this->username = $userrow['username'];
					$this->currentip = getenv('REMOTE_ADDR');
					$this->lastip = $userrow['lastip'];
					$this->lastlogin = $userrow['lastlogin'];
					$datetime = new DateTime();
					$this->currentlogin = $datetime->format("Y-m-d");
					$connection->exec('UPDATE users SET lastlogin="'.$this->currentlogin.'", lastip="'.$this->currentip.'" WHERE username="'.$this->username.'";');
					$_SESSION["user"] = $this;
				}
			}
		array_push($this->messages, "Password wrong or user not found!");	
		}
		else{
			unset($_SESSION["user"]);
		}
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
			$password = hash($GLOBALS["password_hash"], $password);
			// TODO check for specialchars!
			$datetime = new DateTime();
			echo "gugus! ich sollte registriert sein!";
			$connection->exec("INSERT INTO users (`username`, `password`, `lastlogin`, `lastip`) VALUES ('".$username."', '".$password."', '".$datetime->format('Y-m-d')."', '".getenv('REMOTE_ADDR')."');");
			$userid = $connection->lastInsertId();
			$connection->exec("INSERT INTO users_profile (`user_profile_id`, `name`, `schule`, `klasse`, `mail`, `hobbys`) VALUES ('".$userid."', '".$name."', '', '', '', '');");
			$connection->exec("INSERT INTO userrole (`buserid`, `broleid`) VALUES ('".$userid."', '1');");
		}
	}
}
?>
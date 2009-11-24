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
 private $session;
 private $messages = array();
 
 public function __construct($username, $password, $connection){
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
 			//$_SESSION["loginSession"] = hash($GLOBALS["password_hash"], $this->currentip.$this->currentlogin.$this->lastip.$this->lastlogin);
 			$connection->exec('UPDATE users SET lastlogin="'.$this->currentlogin.'", lastip="'.$this->currentip.'" WHERE username="'.$this->username.'";');
 			$_SESSION["user"] = $this;
 			return true;
 		}
 	}
 	array_push($this->messages, "Password wrong or user not found!");
 }

 public function getMessages(){
 	array_push($this->messages, "teeeest!");
 	return $this->messages;
 }
 
 public function getUsername(){
 	return $this->username;
 }
 
 public function getName(){
 	return $this->name;
 }
 
 

}
?>
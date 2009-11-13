<?
include("core.php");
/**
* Users + admin
* @author Vinzenz Hersche <skamster17@gmail.com>
* @date 12-3-2007
* @license GNU General Public License (GPL)
**/
class user {
	/**
	* Check if the User exist's more than one time
	* @author Zuber Emanuel
	* @date 17.04.2008
	**/
	function check_double($username, $mysql) {
	
		$dbResult = $mysql->query("SELECT * FROM ".$GLOBALS['my_prefix']."users WHERE username = '".$username."' ORDER BY id DESC");
		$count = 0;
		foreach($dbResult as $row) {
			$count++;
		}
		if($count > 0) {
			return false;

		}
		else {
			return true;
		}
	}
	

/**
* This one create a user.
* @param Mixed $name The real Name of the user
* @param Mixed $username The username of the user
* @param Mixed $password The password of the user (in sha1)
* @param Mixed $confirm The Password same password a second time, because you could tip it wrong :)
* @date 10.12.2007
**/
function create_user($name, $username, $password, $confirm, $mysql){
	if((!empty($name))&&(!empty($password))&&(!empty($confirm))){
	//test succefully! GO FOR IT :D
		if($password == $confirm) {
			if($this->check_double($username, $mysql)){
				//Password-Cryp - It's STRONG :D
				$crypt = new secure_core();
				$password = $crypt->secureHash($password);
				//Name-Crypt - Against Sniffer-Chiefs :)
				//$n_crypt = base64_encode($username);
					if($mysql->exec("INSERT INTO ".$GLOBALS['my_prefix']."users (name,username,password) VALUES('$name','$username','$password');")){
						return true;
					}
					else{
						return false;
					}
			}
			else{
				//my friend, this name exists.. shit happens :)
				return false;
			}
		}	
		else{
		//look it better!
		return false;
		}
	}	
	else{
	//sucker, fuck empty fields!
	return false;
	}
}

/**
* This one create a user for peobles without JS
* @author Vinzenz Hersche
* @date 10.12.2007
**/
function create_user_njs($name, $username, $password, $confirm, $mysql){
	if((!empty($name))&&(!empty($password))&&(!empty($confirm))){
	//test succefully! GO FOR IT :D
		if($password == $confirm) {
		//one step closer..
			//if($this->check_double($username, $mysql)){
			//here's a problem. now, we didn't need check_dobule, because, we go araund. but, with this, we could make more users with the same name.
				$n_crypt = base64_encode($username);
			if($this->check_double($n_crypt, $mysql)){
				//Password-Cryp - It's STRONG :D
				$password = sha1($password);
				$crypt = new secure_core();
				$password = $crypt->secureHash($password);
				//Name-Crypt - Against Sniffer-Chiefs :)

					if($mysql->exec("INSERT INTO ".$GLOBALS['my_prefix']."users (name,username,password) VALUES('$name','$n_crypt','$password');")){
						return true;
					}
					else{
						return false;
					}
			}
			else{
				//my friend, this name exists.. shit happens :)
				return false;
			}
		}	
		else{
		//look it better!
		return false;
		}
	}	
	else{
	//sucker, fuck empty fields!
	return false;
	}
}

/**
* Change the Password of a user!
* @author Vinzenz Hersche
* @date 17. Dezember 2007
**/
function edit_password($username, $password, $password_confirm, $mysql) {
	if($password == $password_confirm){
		$b64_name = base64_encode($username);
		//$table = $myprefix."users";
		$password = sha1($password);
		$crypt = new secure_core();
		$password = $crypt->secureHash($password);
		if($mysql->exec("UPDATE ".$GLOBALS['my_prefix']."users SET password='".$password."' WHERE username='".$b64_name."' ")){
			return true;
		}
		else {
			return false;
		}
	}
	else{
	return false;
	}
}
/**
* The Check for logins..this one is for the JS-Method! it's more secure (hashing on localhost)
* @author Vinzenz Hersche <skamster17@gmail.com>
* @param Mixed $username - a base64-coding of the username
* @param Mixed $password - a sha1-hash of the password
* @date: 12-30-2007
**/
function login($username, $password, $mysql){
	$table = $myprefix."users";

	$crypt = new secure_core();
	$password = $crypt->secureHash($password);
$user = $mysql->query("SELECT * FROM $table WHERE username='".$username."' ");
foreach($user as $row)
{
  if($row[3]==$password){
		$sid = rand(40, 800);
		$sid .= $_SERVER['REMOTE_ADDR'];
		$sid .= $_SERVER["HTTP_USER_AGENT"];
		$sid .= rand(101, 4000);	
		$sid = md5($sid);
		$sid2 = $sid.$_SERVER['REMOTE_ADDR'];
		$sid2 = md5($sid2);
		if($mysql->exec("UPDATE $table SET sid='".$sid2."' WHERE username='".$username."' ")){
		$this->logout();
		$_SESSION['sid'] = $sid;
		$_SESSION['id'] = $row[0];
		return true;
		}
		else {
		//mysql-failed on sid-creating
		$this->logout();
		return false;
		}
	}
	else{
	//false password
	$this->logout();
	return false;
	}
}
}

/**
* The Check for logins.
* @author Vinzenz Hersche
* @date 12-30-2007
* @param Mixed $username - username for the login
* @param Mixed $password - is the cleartext-password of the user
**/
function login_njs($username, $password, $mysql){
	$b64_name = base64_encode($username);
	$table = $myprefix."users";
	$password = sha1($password);
	$crypt = new secure_core();
	$password = $crypt->secureHash($password);
$user = $mysql->query("SELECT * FROM $table WHERE username='".$b64_name."' ");
foreach($user as $row)
{
  if($row[3]==$password){
		$sid = rand(40, 800);
		$sid .= $_SERVER['REMOTE_ADDR'];
		$sid .= $_SERVER["HTTP_USER_AGENT"];
		$sid .= rand(101, 4000);	
		$sid = md5($sid);
		$sid2 = $sid.$_SERVER['REMOTE_ADDR'];
		$sid2 = md5($sid2);
		if($mysql->exec("UPDATE $table SET sid='".$sid2."' WHERE username='".$b64_name."' ")){
		$this->logout();
		$_SESSION['sid'] = $sid;
		$_SESSION['id'] = $row['id'];
		return true;
		}
		else {
		$this->logout();
		return false;
		}
	}
	else{
	$this->logout();
	return false;
	}
}
}

/**
* check on every protectet site if you're login. if you're not, it's unset you're sessions
@param int $id - The ID of the user
@param Mixed $sid - look in $_SESSION['sid']
**/
function check($id, $sid, $mysql){
	$table = $my_prefix."users";
	$user = $mysql->query("SELECT * FROM $table WHERE id='".$id."' ");
	foreach($user as $row){
		$sid .= $_SERVER['REMOTE_ADDR'];
		$sid = md5($sid);
		if(($sid==$row[4])&&($id==$row[0])){
		return true;
		}
		else {
		$this->logout();
		return false;
		}
	}
	
}


	/**
	* A little function to show all users. Make it, how you use it. Now, the design must been created here.
	@todo say, what you use!
	@author Vinzenz Hersche
	@date 12-10-2007
	**/
	function show_users($mysql) {
	$dbResult = $mysql->query("SELECT * FROM users ORDER BY id DESC");
		foreach($dbResult as $row) {
		echo (base64_decode($row['username']))."<br />";
		}
	}
	/**
	* This delete a user
	@param Mixed $username - the username should be encoded with base64
	**/
	function del_user($username, $mysql){
		$username_64 = base64_encode($username);
		if($mysql->query("DELETE FROM users WHERE username = '".$username_64."'")){
			//echo "gudde";
		}
		else {
		//echo "ned gudde";
		}
	}

	function logout(){
	unset($_SESSION['id']);
	unset($_SESSION['sid']);
	}

}

/**
A class who have just getter-method's for informations
**/
class user_informations {

	function get_name($username){

	}

	function get_username($username){

	}

}

?>
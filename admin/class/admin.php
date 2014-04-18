<?php


class admin{

	/**
	 * Get all users
	 * @param PDO $connection
	 */
	public static function getUsers($connection){
		$tmp = $connection->query("SELECT * FROM user;");
		return $tmp->fetchAll();
	}
	
	/**
	 * Get a specific user
	 * @param unknown_type $username
	 * @param unknown_type $users
	 */
	public static function getUser($username, $users){
		foreach($users as $single){
			if($single["username"]==$username){
				return $single;
			}
		}
	}
	
	/**
	 * Get all the roles
	 * @param unknown_type $connection
	 */
	public static function getRoles($connection){
		$tmp = $connection->query("SELECT * FROM role;");
		return $tmp->fetchAll();
	}
	


	/**
	* Extract a specific column from a 3d-array
	**/
	public static function extractFromArray($array, $item){
		$tmp = array();
		foreach($array as $single){
			array_push($tmp, $single[$item]);
		}
		return $tmp;
	}


}
?>
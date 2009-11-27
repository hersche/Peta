<?php
class admin{
	public static function getUsers($connection){
		$tmp = $connection->query("SELECT * FROM fullUser;");
		return $tmp->fetchAll();
	}
	public static function getUser($username, $users){
		foreach($users as $single){
			if($single["username"]==$username){
				return $single;
			}
		}
	}
	public static function getRoles($connection){
		$tmp = $connection->query("SELECT * FROM role;");
		return $tmp->fetchAll();
	}
	public static function extractFromArray($array, $item){
		$tmp = array();
		foreach($array as $single){
			array_push($tmp, $single[$item]);
		}
		return $tmp;
	}


}
?>
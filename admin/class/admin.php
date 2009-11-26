<?php
class admin{
	public static function showUsers($connection){		
		$tmp = $connection->query("SELECT * FROM fullUser;");
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
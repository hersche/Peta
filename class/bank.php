<?
include("class/items.php");
/**
* Something for banks.
**/
class bank{
	/**
	* This function creates a bank
	@author Vinzenz Hersche
	@var $bank_name String is the Name of the bank
	@var $start_value int is the initial-value of the bank
	@var $bank_currency int is the currency of the money on this bank (dollars, euros or yen as example)
	@return boolean , true, if the bank is created, false if somethin goe's wrong (if something is wrong, it's a db-problem, i think!)
	**/
	function create_bank($bank_name, $start_value, $bank_currency, $owner, $mysql){
		if($mysql->exec("INSERT INTO ".$GLOBALS['my_prefix']."bank (bank_name,bank_value,bank_currency,bank_owner) VALUES('$bank_name','$start_value','$bank_currency','$owner');")){
			return true;
		}
		else{
			return false;
		}
	}
	
	function change_bank($id, $bank_name, $bank_value, $bank_currency, $owner, $mysql){
		$bank = $mysql->query("SELECT * FROM ".$GLOBALS['my_prefix']."bank WHERE bank_name='".$old_bank_name."' ");
		foreach($bank as $row){
			if($owner==$row[4]){
				if($mysql->exec("UPDATE ".$GLOBALS['my_prefix']."users SET bank_name='".$bank_name."', bank_value='".$bank_value."', bank_currency='".$bank_currency."' WHERE id='".$id."' ")){
				return true;
				}
				else{
				return false;
				}
			}
			else{
				return false;
			}
		}
	}
	/**
	* Function to delete the bank
	@author Vinzenz Hersche
	@param int $id is the id of the bank
	@param mixed $owner must be the user-id of the owner (as example, use the session-variable)
	@return boolean true if delete, false if it couldn't delete
	**/
	function delete_bank($id, $owner, $mysql){
		$bank = $mysql->query("SELECT * FROM ".$GLOBALS['my_prefix']."bank WHERE id = '".$id."'");
		foreach($bank as $row){
			if($owner==$row['bank_owner']) {
				if($mysql->exec("DELETE FROM bank WHERE id = '".$id."'")){
				return true;
				}
				else {
				return false;
				}
			}
			else{
				//echo ("Eingabe: ".$owner."<br />");
				//echo ("Mysql:".$row['bank_owner']);
				return false;
			}
		}
	}

	
	function make_banklist($owner, $listname, $mysql) {
	$dbResult = $mysql->query("SELECT * FROM bank ORDER BY bank_name DESC");
		echo '<select name="'.$listname.'">';
		foreach($dbResult as $row) {
		if($owner==$row[3]){
		$bank_name = $row['bank_name'];
		echo ('<option value="'.$bank_name.'">'.$bank_name.'</option>');
		}
		}
		echo '<select>';
	}

	function make_list($owner, $mysql) {
	$dbResult = $mysql->query("SELECT * FROM bank ORDER BY bank_name DESC");
		echo '<table>';
		echo "<tr><td>".$GLOBALS['lang']['name_of_bank']."</td><td>Momentanes Guthaben</td></tr>";
		foreach($dbResult as $row) {
		if($owner==$row[4]){
		echo "\n<tr><td>".$row['bank_name']."</td><td>".$row['bank_value']." ".$row['bank_currency']."</td><td>";
		echo '<a href="index.php?place=bank&action=value&id='.$row[0].'">Wert anpassen</a></td><td>';
		echo '<a href="index.php?place=bank&action=del&id='.$row[0].'"><img src="img/del.gif" alt="Delete Bank" /></a>';
		echo "</td></tr>\n";
		}
		}
		echo '</table>';
	}

	function change_value($id, $value, $item, $owner, $mysql){
			$bank = $mysql->query("SELECT * FROM ".$GLOBALS['my_prefix']."bank WHERE id='".$id."' ");
			foreach($bank as $row){
				if($owner==$row[4]){
					if($this->math($row[2],$value)==false){
					return false;
					}
					else{
					$new_value = $this->math($row[2],$value);
					$items = new items();
					if(($mysql->exec("UPDATE ".$GLOBALS['my_prefix']."bank SET bank_value='".$new_value."' WHERE id='".$id."' "))&&($items->add_item($item, $value, $row['bank_name'], $owner, $mysql))) {
					return true;
					}
					}
				}
			}
	}

	private function math($value1, $value2){


	//Delete all spaces..
	$value2 = str_replace(" ", "", $value2);
	$nr1 = str_replace(" ", "", $value1);
	//Took the plus, minus or what else..
	$since = substr($value2, 0, 1);
	$nr2 = substr($value2, 1, (strlen($value2)));
	if((!is_numeric($nr1))||(!is_numeric($nr2)))
	{
	return false;
	}
	if($since == "+"){
	$result = (float)$nr1 + (float)$nr2;
	}
	if($since == "-"){
	$result = (float)$nr1 - (float)$nr2;
	}
	if($since == "/"){
	$result = (float)$nr1 / (float)$nr2;
	}
	if($since == "*"){
	$result = (float)$nr1 * (float)$nr2;
	}
	if($since == "%"){
	$result = (float)$nr1 % (float)$nr2;
	}
	if(is_numeric($result))
	{
	return $result;
	}
	else{
	return false;
	}
	}
	
	function getBank_name($id, $owner, $mysql){
			$bank = $mysql->query("SELECT * FROM ".$GLOBALS['my_prefix']."bank WHERE id='".$id."' ");
			foreach($bank as $row){
				if($owner==$row[4]){
				return $row[1];
				}
			}
	}

	function getBank_value($id, $owner, $mysql){
			$bank = $mysql->query("SELECT * FROM ".$GLOBALS['my_prefix']."bank WHERE id='".$id."' ");
			foreach($bank as $row){
				if($owner==$row[4]){
				return $row[2];
				}
			}
	}

	function getBank_currency($id, $owner, $mysql){
			$bank = $mysql->query("SELECT * FROM ".$GLOBALS['my_prefix']."bank WHERE id='".$id."' ");
			foreach($bank as $row){
				if($owner==$row[4]){
				return $row[3];
				}
			}
	}

}
?>
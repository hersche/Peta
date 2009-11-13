<?

class items{

	function add_item($item_name, $item_value, $item_bank, $owner, $mysql){
		if($mysql->exec("INSERT INTO ".$GLOBALS['my_prefix']."items (item_name,item_value,item_bank,owner) VALUES('$item_name','$item_value','$item_bank','$owner');")){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	IN WORK!
	
	function make_list($owner, $mysql) {
	$dbResult = $mysql->query("SELECT * FROM items ORDER BY bank_name DESC");
		echo '<table>';
		echo "<tr><td>".$GLOBALS['lang']['name_of_bank']."</td><td>Momentanes Guthaben</td></tr>";
		foreach($dbResult as $row) {
		if($owner==$row[4]){
		echo "\n<tr><td>".$row['item_name']."</td><td>".$row['item_value']."</td><td>";
		echo '<a href="index.php?place=bank&action=value&id='.$row[0].'">Wert anpassen</a></td><td>';
		echo '<a href="index.php?place=bank&action=del&id='.$row[0].'">Bank löschen</a>';
		echo "</td></tr>\n";
		}
		}
		echo '</table>';
	}
	**/


}
?>
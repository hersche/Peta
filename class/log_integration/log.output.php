<?
	$datei = "logs/".date("Ymd")."_system.txt";
	if ( file_exists($datei)){
		$fget = file_get_contents($datei); 
		$fparserow = explode("\n", $fget);
		foreach ($fparserow as $row) {
			if($row !="\n") {
				$fparsecol = explode("|", $row);
				if(count($fparsecol) != 1) {
					echo "<tr>\n";
					foreach ($fparsecol as $value) {
						echo "\t<td>" . $value . " </td>\n";
					}
					echo "</tr>\n";
				}
			}
		}
	} else {
		$m['neg'] = "Kann Datei nicht laden!";
		//log_write("");
	}
?>
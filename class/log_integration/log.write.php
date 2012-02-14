<?

function log_write($target, $msg, $output = true) {
	global $m;
	$today = date("Ymd");
	switch($target) {
		case "system":
			$filename = "core/log/logs/".$today."_system.txt";
		break;
		case "user":
			$filename = "core/log/logs/".$today."_user_".$_SESSION['uid'].".txt";
		break;
		default:
			$filename = "core/log/logs/".$today."_default.txt";
		break;
	}
	$fd = fopen($filename, "a");
	if (!file_exists($filename)) {
		chmod($filename, 0777);
	}
	
	$str = date("d.m.Y", time()) . "|" . date("H:i:s",time()). "|";
	if(isset($_SESSION['uid'])) { $str .= $_SESSION['uid']; } else { $str .= "not-set"; }
	$str .= "|";
	if(isset($_SESSION['atm'])) { $str .= $_SESSION['atm']; } else { $str .= "not-set"; }
	$str .= "|" . $msg;
	fwrite($fd, $str . PHP_EOL);
	fclose($fd);
	chmod($filename, 0644);
	if($output == true) { $m['log'] .= $str . "<br />"; }
}
?>
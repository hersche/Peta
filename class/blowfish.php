<?
	include("class/blowfish/blowfish.class.php");
	
	class blowcrypt{
	function gen_key(){
		$key = $_SERVER['REMOTE_ADDR'];
		$key .= md5(rand(rand(-3,-11), rand(-11, rand(-12, -443255))));
		$key .= $_SERVER["HTTP_USER_AGENT"];
		$key .= crc32(rand(3, rand(11, rand(12, 443255))));
		$key = sha1($key);
		$key = substr($key, 0, rand(4, 40));
		return $key;
	}

	} 
?>
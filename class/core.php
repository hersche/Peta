<?
/**
 * Some template-functions which should allow to use pure php in the higher files.
 * @author skamster
 *
 */
class htmlFunctions{
	private $title = "sddg";
	private $meta = array();
	private $js = array();
	private $css = array();
	private $includeHTML = true;
	private $bodyOnLoad = "";
	private $dojoRequire = array();
	private $dojoCode = array();
	private $content = "";
	function setTitle($title){
		$this->title = $title;
	}

	/**
	 * set the metadata in your html-file
	 * @param array $meta
	 */
	function setMeta($meta){
		if(gettype($js)=="array"){
			$this->meta = $meta;
		}
	}
	/**
	 * set the javascriptfiles which should be loaded
	 * @param array $js
	 */
	function setJs($js){
		if(gettype($js)=="array"){
			$this->js = $js;
		}
	}

	function setCss($css){
		if(gettype($js)=="array"){
			$this->css = $css;
		}
	}

	function setIncludeHTML($inludeHTML){
		$this->includeHTML=$inludeHTML;
	}

	function setbodyOnLoad($bodyOnLoad){
		$this->bodyOnLoad=$bodyOnLoad;
	}

	function addJs($js){
		if(gettype($js)=="array"){
			$this->js = array_merge($this->js, $js);
		}
	}

	function addCss($css){
		if(gettype($css)=="array"){
			$this->css = array_merge($this->css, $css);
		}
	}

	/**
	 * Shows a message for the user
	 * @param unknown_type $text your messagetext
	 * @param unknown_type $time the time in seconds
	 * @param unknown_type $type
	 * @return unknown_type
	 */
	function showMessage($text, $time, $type){
		$usetime = 3000;
		if(!in_array("dojo.fx", $this->dojoRequire)){
			array_push($this->dojoRequire, "dojo.fx");
		}
		if(is_numeric($time)){
			$usetime = $time * 1000;
		}
		$temp = 'var wipeOut = dojo.fx.wipeOut({node: "dojomessage",duration: 1000});';
		$temp .= 'var wipeIn = dojo.fx.wipeIn({node: "dojomessage",duration: 1000});';
		$temp .= 'wipeIn(); sleep('.$usetime.'); wipeOut();';
		array_push($this->dojoCode, $temp);
		$this->content .= '<div id="dojomessage">'.$text.'</div>';
	}

	function getHeader(){
		if($this->includeHTML){
			echo "<html>";
		}
		echo "<head><title>".$this->title."</title>";
		foreach ($this->js as $singlejs){
			echo '<script type="text/javascript" src="'.$singlejs.'" />';
		}
		foreach ($this->css as $singlecss){
			echo '<link title="Death-head" rel="stylesheet" type="text/css" href="'.$singlecss.'" />';
		}
		for($i=0; $i < count($this->dojoRequire); $i++)
		{
			if($i==0){
				echo '<script type="text/javascript">';
			}
			echo 'dojo.require("'.$this->dojoRequire[$i].'");';
			if($i==count($this->dojoRequire)-1){
				echo "</script>";
			}

		}
			for($i=0; $i < count($this->dojoCode); $i++)
		{
			if($i==0){
				echo '<script type="text/javascript">';
			}
			echo $this->dojoCode[$i];
			if($i==count($this->dojoCode)-1){
				echo "</script>";
			}

		}
			
		echo "</head><body>";
		echo $this->content;
	}

	function getFooter(){
		echo "</body></html>";
	}




}

/**
 The fucking core-functions!
 @author Thibault Schmidt
 @date 3.12.07
 **/
class mysql_class{

	//Dieser Block stellt alle Abfragen zur DB bereit.
	function my_connect($dbusername, $dbpassword, $db, $dbserver, $dbtype){
		$strDbLocation = $dbtype.':dbname='.$db.';host='.$dbserver.'';
		try
		{
			$objDb = new PDO($strDbLocation, $dbusername, base64_decode($dbpassword));
			return $objDb;
		}
		catch (PDOException $e)
		{
			$objDb->rollBack();
			echo 'Fehler beim öffnen der Datenbank: ' . $e->getMessage();
		}
	}


}
/**
 All the core-checks to make a secure system
 @author Vinzenz Hersche
 @date 17.4.2008
 **/
class secure_core{

	/**
	 Here we create a secure host as possible. Remember: At login and registration, JS hashed with sha1.
	 It's very recommendet to install & use hash, because md5 is cracked! (Sha512 and Whirlpool are called as very secure).
	 @author Vinzenz Hersche
	 @date 17.4.2008
	 **/
	function secureHash($value){
		if(function_exists(hash)){
			$password_512 = hash(SHA512, $value);
			$password = hash(WHIRLPOOL, $password_512);
			return $password;
		}

		else{
			$password = md5($value);
			return $password;
		}
	}
}
?>
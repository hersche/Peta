<?php
class skamsterNoSmartyExample extends plugin{
	
	public function getPluginName(){
		return "noSmartyExample.skamster";
	}
	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "A plugindescription for noSmartyExample.skamster .";
	}
	public function deleteInstanceTables(){ 
		//I've no db's
	}
	
	public function start(){
		if($_GET["action"]=="test"){
			return "<h3>Get a LINKY</h3>";
		}
		
		$htmlCollect = "<h1 style='color: green;'>noSmartyExample says Hello World</h1>";
		$htmlCollect = $htmlCollect.'<p>and still enjoy html5 :)</p><br /> <form oninput="x.value=parseInt(a.value)+parseInt(b.value)">0<input type="range" id="a" value="50">100 +<input type="number" id="b" value="50">=<output name="x" for="a b"></output></form>';

		$htmlCollect = $htmlCollect."<ul><li>A</li><li>List</li><li>looks like this</li></ul>";
		$htmlCollect = $htmlCollect."My dbPrefix is: ".$this->getDbPrefix();
		$htmlCollect = $htmlCollect."<br />Fool, once again tests!";
		$htmlCollect = $htmlCollect."<br /><a href='plugin.php?plugin=".$_GET['plugin']."&amp;action=test'>Linky</a>";
		return $htmlCollect;
	}
}

?>
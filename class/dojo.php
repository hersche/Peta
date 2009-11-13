<?php
class dojo{

	private $javascript = array();
	function setMessage($time, $type){
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
		array_push($this->javascript, $temp);
	}
	// TODO create output for js-file with all contents
	function getJavascript(){
		
	}
	function getMessage($text){
		return '<div id="dojomessage">'.$text.'</div>';
	}

}

?>
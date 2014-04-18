<?PHP
include_once("HTMLOutput.php");

function dump($mixed)	{
	echo _dump($mixed);
}
function _dump($mixed)	{
	
	//Array
	if(is_array($mixed))	{
		$arrKeys=array_keys($mixed);
		
		$rtn="";
		$rtn.= HTMLOutput::getStyle("array","#669900","#99cc00","#263300");
		$rtn.= HTMLOutput::getHead("array", "Array");
		
		for($i=0; $i < count($arrKeys); $i++)	{
			$rtn.= HTMLOutput::getItem("array",$arrKeys[$i], _dump($mixed[$arrKeys[$i]]));	
		}
		$rtn.= HTMLOutput::getBottom();
		return $rtn;
	}
	// Object with dump
	else if(is_object($mixed) && method_exists($mixed,"dump"))	{
		return $mixed->dump();
	
	}
	// Object without dump
	else if(is_object($mixed))	{
		$className=get_class($mixed);
		$vars=get_class_vars ($className);
		$methods=get_class_methods($mixed);
		
		$rtn="";
		$rtn.= HTMLOutput::getStyle("object","#b09300","#f0cc02","#3f3100");
		$rtn.= HTMLOutput::getHead("object", $className);
		// vars
		/*$rtn.= HTMLOutput::getBigRow("object","Vars(s)");
		if($vars)
		for($i=0;$i<count($vars);$i++)	{
			$rtn.= HTMLOutput::getItem("object","String", $vars[$i]);
		}*/
		// methods
		//$rtn.= HTMLOutput::getBigRow("object","Method(s)");
		for($i=0;$i<count($methods);$i++)	{
			$rtn.= HTMLOutput::getRow("object", $methods[$i]."()");
		}
		$rtn.= HTMLOutput::getBottom();
		return $rtn;
	
	}
	// boolean
	else if(is_bool($mixed))	{
		$rtn="";
		$rtn.= HTMLOutput::getStyle("simple","#ff4400","#ff954f","#4f1500");
		$rtn.= HTMLOutput::smallHead("simple");
		$rtn.= HTMLOutput::getItem("simple","boolean", ( ($mixed)?"yes":"no" ));
		$rtn.= HTMLOutput::getBottom();
		return $rtn;
	}
	// int
	else if(is_numeric($mixed))	{
		$rtn="";
		$rtn.= HTMLOutput::getStyle("simple","#ff4400","#ff954f","#4f1500");
		$rtn.= HTMLOutput::smallHead("simple");
		$rtn.= HTMLOutput::getItem("simple","numeric", $mixed);
		$rtn.= HTMLOutput::getBottom();
		return $rtn;
	}
	// String
	else	{
		$rtn="";
		$rtn.= HTMLOutput::getStyle("simple","#ff4400","#ff954f","#4f1500");
		$rtn.= HTMLOutput::smallHead("simple");
		$rtn.= HTMLOutput::getItem("simple","String", $mixed);
		$rtn.= HTMLOutput::getBottom();
		return $rtn;
	}

}
?>

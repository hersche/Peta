<?php
class logger{
	private $DEBUG = 5;
	private $INFO = 4;
	private $WARN = 3;
	private $ERROR = 2;
	private $FATAL = 1;
	private $currentLevel;
	private $messages = array();
	public function __construct($loglevel){
		switch($loglevel){
			case "DEBUG":
				$this->currentLevel = $this->DEBUG;
				break;
			case "INFO":
				$this->currentLevel = $this->INFO;
				break;
			case "WARN":
				$this->currentLevel = $this->WARN;
				break;
			case "ERROR":
				$this->currentLevel = $this->ERROR;
				break;
			case "FATAL":
				$this->currentLevel = $this->FATAL;
				break;
		}
	}
	
	public function debug($message){
		if($this->currentLevel>=5){
		array_push($this->messages, $message);
		}
	}
	public function info($message){
		if($this->currentLevel>=4){
			array_push($this->messages, $message);
		}
	}
	public function warn($message){
		if($this->currentLevel>=3){
			array_push($this->messages, $message);
		}
	}
	
	public function error($message){
		if($this->currentLevel>=2){
			array_push($this->messages, $message);
		}
	}
	
	public function fatal($message){
		if($this->currentLevel>=1){
			array_push($this->messages, $message);
		}
	}
	
	public function getMessages(){
		return $this->messages;
	}
	
}


?>
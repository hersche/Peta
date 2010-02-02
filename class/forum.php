<?php

class allThreads{
	private $nrOfThreads = 0;
	private $threads = array();

	public function __construct($connect, $user){
		foreach ($connection->query('SELECT * FROM forum_threads') as $row){
			$this->nrOfThreads += 1;
			$thread = new thread();
			$thread->setId($row['forumid']);
			$thread->setText('text');
			$thread->setTimestamp('timestamp');
			$thread->setTitle('title');
			$thread->setUserId('userid');
			$thread->setTopTopic('toptopic');
			array_push($threads, $thread);
		}
	}
	public function getAllTopThreads(){
		$filteredList = array();
		foreach($this->threads as $thread){
			if($thread->getTopTopic()==-1){
				array_push($filteredList, $thread);
			}
		}
		return $filteredList;
	}

}

class thread{
	private $id;
	private $userid;
	private $title;
	private $text;
	private $timestamp;
	private $topTopic;
	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}
	public function setUserId($userid){
		$this->userid = $userid;
	}
	public function getUserId(){
		return $this->userid;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function getTitle(){
		return $this->title;
	}
	public function setText($text){
		$this->text = $text;
	}
	public function getText(){
		return $this->text;
	}
	public function setTimestamp($timestamp){
		$this->timestamp = $timestamp;
	}
	public function getTimestamp(){
		return $this->timestamp;
	}
	public function setTopTopic($topTopic){
		$this->topTopic = $topTopic;
	}
	public function getTopTopic(){
		return $this->topTopic;
	}

}

?>
<?php

class allThreads{
	private $nrOfThreads = 0;
	private $threads = array();
	private $connect;
	private $user;
	public function __construct($connection, $user){
		$this->connect = $connection;
		$this->user = $user;
		foreach ($connection->query('SELECT * FROM forum_threads') as $row){
			$this->nrOfThreads += 1;
			$thread = new thread();
			$thread->setId($row['forumid']);
			$thread->setText($row['text']);
			$thread->setTimestamp($row['timestamp']);
			$thread->setTitle($row['title']);
			$thread->setUserId($row['userid']);
			$thread->setTopTopic($row['toptopic']);
			array_push($this->threads, $thread);
		}
	}
	/**
	 * This method return a list of toptopics.. could be used to make a overview
	 * @return array with toptopics
	 */
	public function getAllTopThreads(){
		$filteredList = array();
		foreach($this->threads as $thread){
			if($thread->getTopTopic()==-1){

				array_push($filteredList, $thread);
			}
		}
		return $filteredList;
	}

	public function getSubThreads($topicid){
		$filteredList = array();
		foreach($this->threads as $thread){
			if($thread->getTopTopic()==$topicid){
				array_push($filteredList, $thread);
			}
		}
		return $filteredList;
	}
	public function createNewThread($title, $text, $toptopic = -1){
//		echo $toptopic;
//		echo $title;
//		echo $text;
//		echo $this->user->getId();
		$this->connect->exec("INSERT INTO `learncards`.`forum_threads` (`forumid`, `userid`, `title`, `text`, `timestamp`, `toptopic`) VALUES (NULL, '".$this->user->getId()."', '".$title."', '".$text."', CURRENT_TIMESTAMP, '".$toptopic."');");
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
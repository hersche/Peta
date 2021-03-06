<?php
/**
 * A collection of all the threads..
 * @author skamster
 *
 */
class allThreads {
	private $nrOfThreads = 0;
	private $threads = array();
	private $connect;
	private $user;
	private $dbPrefix;
	public function __construct($connection, $user, $dbPrefix) {
		$this -> connect = $connection;
		$this -> user = $user;
		$this->dbPrefix=$dbPrefix;
		foreach ($connection->query("SELECT * FROM ".$this->dbPrefix."forum_threads;") as $row) {
			$this -> nrOfThreads += 1;
			$thread = new thread();
			$thread -> setId($row['forumid']);
			$thread -> setText($row['text']);
			$thread -> setTimestamp($row['timestamp']);
			$thread -> setTitle($row['title']);
			$thread -> setUserId($row['userid']);
			$thread -> setTopTopic($row['toptopic']);
			$thread -> setThreadState($row['threadstate']);
			$thread -> setEditCounter($row['editcounter']);
			if($row['userid']!=-1){
				$thread -> setUsername(usertools::getUsernameById($row['userid'], $connection));
			}
			else{
				$thread -> setUsername("Public", $connection);
			}
			array_push($this -> threads, $thread);
		}
		foreach ($this->threads as $thread) {
			$thread -> setSubThreadCounter($this -> countSubThreads($thread -> getId()));
		}
	}

	/**
	 * This method return a list of toptopics.. could be used to make a overview
	 * @return array with toptopics
	 */
	public function getAllTopThreads() {
		$filteredList = array();
		foreach ($this->threads as $thread) {
			if ($thread -> getTopTopic() == -1) {
				array_push($filteredList, $thread);
			}
		}
		return $filteredList;
	}

	public function getSubThreads($topicid, $position = 10, $recursive = true) {
		$filteredList = array();
		// go through every thread
		foreach ($this->threads as $thread) {
			if ($thread -> getTopTopic() == $topicid) {
				$thread -> setPosition($position);
				if (($thread -> getThreadState() != forumtools::$THREADHIDDEN) || (usertools::containRoles($GLOBALS["adminRoles"], $_SESSION["user"] -> getRoles()))) {
					array_push($filteredList, $thread);
				}
				if ($recursive) {
					$filteredList = array_merge($filteredList, $this -> getSubThreads($thread -> getId(), $position + 20));
				}
			}
		}
		return $filteredList;
	}

	public function countSubThreads($topicid) {
		$counter = 0;
		// go through every thread
		foreach ($this->threads as $thread) {
			if ($thread -> getTopTopic() == $topicid) {
				if (($thread -> getThreadState() != forumtools::$THREADHIDDEN) || (usertools::containRoles($GLOBALS["adminRoles"], $_SESSION["user"] -> getRoles()))) {
					$counter += 1;
				}
				$counter += $this -> countSubThreads($thread -> getId());

			}
		}
		return $counter;
	}

	public function deleteThread($threadid, $includeSubThreads = true) {
		$thread = $this -> getThreadById($threadid);
		if (!is_null($thread)) {
			$subthreads = $this -> getSubThreads($threadid);
			//$this -> connect -> exec("DELETE FROM `".$this->dbPrefix."forum_threads` WHERE `forumid` = " . $threadid . "; ");
			$thread->delete($this->connect);
			if($includeSubThreads){
				foreach ($subthreads as $subThread) {
					$subThread->delete($this->connect);
				}
				$this -> threads = array();
				$this -> __construct($this ->connect, $this->user,$this->dbPrefix);
			}
		}
	}

	public function getTopThreadId($subthreadid) {
		// get the thread
		$subThread = $this -> getThreadById($subthreadid);
		$currentId;
		foreach ($this->threads as $thread) {
			// check, if a thread got a id which is the toptopic from the subthread..
			if ($thread -> getId() == $subThread -> getTopTopic()) {
				if ($thread -> getTopTopic() != -1) {
					$currentId = $this -> getTopThreadId($thread -> getId());
				} else {
					return $thread -> getId();
				}
			} else if ($subThread -> getTopTopic() == -1) {
				return $subThread -> getId();
			}
		}
		return $currentId;
	}

	public function getThreadById($id) {
		foreach ($this->threads as $thread) {
			if ($thread -> getId() == $id) {
				return $thread;
			}
		}
		return $filteredList;
	}

	public function createNewThread($title, $text, $toptopic = -1) {
		$this -> connect -> exec("INSERT INTO `".$this->dbPrefix."forum_threads` (`forumid`, `userid`, `title`, `text`, `timestamp`, `toptopic`) VALUES (NULL, '" . $this -> user -> getId() . "', '" . $title . "', '" . $text . "', CURRENT_TIMESTAMP, '" . $toptopic . "');");
		$this -> nrOfThreads += 1;
		$thread = new thread();
		$thread -> setId($this -> connect -> lastInsertId());
		$thread -> setText($text);
		$thread -> setTimestamp("");
		$thread -> setTitle($title);
		$thread -> setUserId($this -> user -> getId());
		$thread -> setTopTopic($toptopic);
		$thread -> setUsername($this->user-> getUsername(), $this -> connect);
		array_push($this -> threads, $thread);
		return $this -> connect -> lastInsertId();
	}

	public function editThread($title, $text, $editcounter, $threadid) {
		$this -> connect -> exec("UPDATE `".$this->dbPrefix."forum_threads` SET `title` =  '" . $title . "', `text` =  '" . $text . "', `editcounter` =  " . $editcounter . "   WHERE `forumid` =" . $threadid . " LIMIT 1 ;");
	}

	public function changeThreadState($threadid, $newState, $recursive = false) {

		if ($recursive) {
			$subThreads = $this -> getSubThreads($threadid, 0, true);
			foreach ($subThreads as $subThread) {
				$this -> changeThreadState($subThread -> getId(), $newState);
			}
		}

		$this -> connect -> exec("UPDATE `".$this->dbPrefix."forum_threads` SET `threadstate` =  '" . $newState . "' WHERE `forumid` =" . $threadid . " LIMIT 1 ;");
	}

}

class thread {
	private $id;
	private $userid;
	private $title;
	private $text;
	private $timestamp;
	private $topTopic;
	private $username;
	private $position;
	private $threadState;
	private $editcounter;
	private $subThreadCounter;

	public function __toString() {
		return $this -> title . " " . $this -> text;
	}

	public function setId($id) {
		$this -> id = $id;
	}

	public function getId() {
		return $this -> id;
	}

	public function getSubThreadCounter() {
		return $this -> subThreadCounter;
	}

	public function setSubThreadCounter($nrOfSubThreads) {
		$this -> subThreadCounter = $nrOfSubThreads;
	}

	public function getPosition() {
		return $this -> position;
	}
	public function delete($connect){
		$connect -> exec("DELETE FROM `".$this->dbPrefix."forum_threads` WHERE `forumid` = " . $this->id . "; ");
	}
	public function getEditCounter() {
		return $this -> editcounter;
	}

	public function setEditCounter($editcounter) {
		$this -> editcounter = $editcounter;
	}

	public function setPosition($position) {
		$this -> position = $position;
	}

	public function setUserId($userid) {
		$this -> userid = $userid;
	}

	public function setThreadState($threadState) {
		$this -> threadState = $threadState;
	}

	public function getThreadState() {
		return $this -> threadState;
	}

	public function getUserId() {
		return $this -> userid;
	}

	public function getUsername() {
		return $this -> username;
	}

	public function setUsername($username) {
		$this -> username = $username;
	}

	public function setTitle($title) {
		$this -> title = $title;
	}

	public function getTitle() {
		return $this -> title;
	}

	public function setText($text) {
		$this -> text = $text;
	}

	public function getText() {
		return $this -> text;
	}

	public function setTimestamp($timestamp) {
		$this -> timestamp = $timestamp;
	}

	public function getTimestamp() {
		return $this -> timestamp;
	}

	public function setTopTopic($topTopic) {
		$this -> topTopic = $topTopic;
	}

	public function getTopTopic() {
		return $this -> topTopic;
	}

}

class forumtools {

	public static $THREADACTIVE = 0;
	public static $THREADHIDDEN = 1;
	public static $THREADREDONLY = 2;

	public static function threadStateToString($threadStateId) {
		if ($threadStateId == $THREADACTIVE) {
			return "Active";
		} else if ($threadStateId == $THREADHIDDEN) {
			return "Hidden";
		} else if ($threadStateId == $THREADREADONLY) {
			return "Read only";
		}
		// else with exception!
	}

}
?>
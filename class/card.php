<?php

class allCardSets{
	private $sets = array();
	public function __construct($userid, $connection){
		$currentSetName;
		$set = null;
		$questionid = null;
		foreach ($connection->exec('SELECT * FROM fullQuestionSet WHERE ownerid="'.$userid.'"') as $row){
			if($row['setname']!=$currentSetName){
				if($set != null){
					array_push($this->sets, $set);
				}
				$set = new cardSet();
				$currentSetName=$row['setname'];
				$set->setSetId($row['setid']);
				$set->setSetName($row['setname']);
			}
			if($questionid!=$row['questionid']){
				$questionid = $row['questionid'];
				
			}
			$answerobj = new answer();
			$answerobj->setAnswerId($row['answerid']);
			$answerobj->setAnswer($row['answertext']);
			$set->addQuestion($row['questionid'], $row['question'], $answerobj);
			$set->addTag($row['tagid'], $row['tagname']);
		}
	}
	public function getSets(){
		return $this->sets;
	}

	public function newSet($set, $connection){
		//		TODO add db-insert-method, use lastinsert-id to set this at the end
		//		$connection->exec("insert")
		//$set->setSetId($connection->lastidding)
		array_push($this->sets, $set);
	}
}
/**
 * Needs a valid user-object!
 * @author skamster
 *
 */
class cardSet{
	private $setid;
	private $setname;
	private $questions = array();
	private $tags = array();
	//	public function __construct($setname, $cards, $tags){
	//		$this->setname=$setname;
	//		$this->cards=$cards;
	//		$this->tags=$tags;
	//	}

	public function setSetId($setid){
		$this->setid = $setid;
	}

	public function setSetName($setName){
		$this->setname=$setname;
	}
	public function addQuestion($questionid, $question, $answer){
		$questionObj = new question($questionid, $question);
		$questionObj->addAnswer($answer);
		array_push($this->questions, new question($question));
	}
	public function addTag($tagid, $tag){
		array_push($this->tags, new tag($tagid, $tag));
	}
	public function getSetId(){
		return $this->setid;
	}
	public function getSetName(){
		return $this->setname;
	}
	public function getQuestions(){
		return $this->questions;
	}
	public function getTags(){
		return $this->tags;
	}
	public function newQuestion($question, $connection){
		//		TODO add db-insert-method, use lastinsert-id to set this at the end
		//		$connection->exec("insert")
		//$card->setSetId($connection->lastidding)
		array_push($this->questions, $question);
	}
}

class question{
	private $question;
	private $answers = array();
	private $mode;
	private static $TEXTMODE = 1;
	private static $SELECTMODE = 2;
	public function __construct($questionid, $question,$answerid, $answers, $mode){
		$this->question = $question;
		$this->answers = $answers;
		$this->mode = $mode;
	}

	public function addAnswer($answer){
		array_push($this->answers, $answer);
	}
	public function setMode($mode){
		$this->mode = $mode;
	}
	public function getMode(){
		return $this->mode;
	}
}

class answer{
	private $answerid;
	private $answer;

	public function __construct($answerid, $answer, $mode){
		$this->answer = $answer;
		$this->mode = $mode;
	}

	public function getAnswerId(){
		return $this->answerid;
	}
	public function getAnswer(){
		return $this->answer;
	}

	public function setAnswerId($answerid){
		$this->answerid = $answerid;
	}
	public function setAnswer($answer){
		$this->answer = $answer;
	}

}

class tag{
	private $tagid;
	private $tagtext;
	public function __construct($tagid, $tagtext){
		$this->tagid = $tagid;
		$this->tagtext = $tagtext;
	}

	public function getTagId(){
		return $this->tagid;
	}

	public function getTagText(){
		return $this->tagtext;
	}


}


?>
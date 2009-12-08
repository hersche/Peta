<?php
/**
 * The complete set of cardsets for a specified user!
 * @author skamster
 *
 */
class allCardSets{
	private $sets = array();
	public function __construct($userid, $connection){
		$currentSetName;
		$set = null;
		$questionid = null;
		$answerid = null;
		foreach ($connection->query('SELECT * FROM fullQuestionSet WHERE ownerid="'.$userid.'"') as $row){
			if($row['setname']!=$currentSetName){
				if($set != null){
					array_push($this->sets, $set);
				}
				$currentSetName=$row['setname'];
				$set = new cardSet();
				$set->setSetId($row['setid']);
				$set->setSetName($row['setname']);
			}
			if($questionid!=$row['questionid']){
				if($questionid!=null){
					$set->addQuestion($question);
				}
				$question = new question($row['questionid'], $row['question'],$row['mode']);
				$questionid = $row['questionid'];
				$set->addQuestion($question);
			}
			if($answerid!=$row['answerid']){
				$answerobj = new answer($row['answerid'], $row['answertext']);
				$answerid = $row['answerid'];
				$question->addAnswer($answerobj);
			}

		}
		if($set!=null){
			if($questionid!=null){
				if($answerid!=null){
					$question->addAnswer($answerobj);	
				}
				$set->addQuestion($question);
			}
			array_push($this->sets, $set);
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

	public function setSetId($setid){
		$this->setid = $setid;
	}

	public function setSetName($setname){
		$this->setname=$setname;
	}
	public function addQuestion($question){
		array_push($this->questions, $question);
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
	private $questionid;
	private $question;
	private $answers = array();
	private $mode;
	private static $TEXTMODE = 1;
	private static $SELECTMODE = 2;
	public function __construct($questionid, $question, $mode){
		$this->questionid = $questionid;
		$this->question = $question;
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
	
	public function getAnswers(){
		return $this->answers;
	}
	
	public function getQuestion(){
		return $this->question;
	}
	public function getQuestionId(){
		return $this->questionid;
	}
}

class answer{
	private $answerid;
	private $answer;

	public function __construct($answerid, $answer){
		$this->answer = $answer;
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
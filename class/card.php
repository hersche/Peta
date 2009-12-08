<?php
/**
 * The complete set of cardsets for a specified user!
 * @author skamster
 *
 */
class allCardSets{
	private $sets = array();
	public function __construct($userid, $connection){
		$currentSetName = null;
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
				$set->setSetDescription($row['setdescription']);
			}
			if($questionid!=$row['questionid']){
				if($questionid!=null){
					$set->addQuestion($question);
				}
				$question = new question();
				$question->setId($row['questionid']);
				$question->setQuestion($row['question']);
				$question->setMode($row['mode']);
				$questionid = $row['questionid'];
				$set->addQuestion($question);
			}
			if($answerid!=$row['answerid']){
				$answerobj = new answer();
				$answerobj->setAnswer($row['answertext']);
				$answerobj->setAnswerId($row['answerid']);
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

	public function newSet($set, $userid, $connection){
		$connection->exec("INSERT INTO question_set (`setname`,`setdescription`, `ownerid`,  `editcount`, `createtimestamp`, `firstowner`) VALUES ('".$set->getSetName()."', '".$set->getSetDescription()."', ".$userid.", 1, '2009-00-00 00:00:00', ".$userid.");");
		echo $connection->lastInsertId();
		$set->setSetId($connection->lastInsertId());
		array_push($this->sets, $set);
	}
	public function getSetBySetId($setId){
		foreach ($this->sets as $set){
			if($set->getSetId()==$setId){
				return $set;
			}
		}
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
	private $setdescription;
	private $questions = array();
	private $tags = array();

	public function setSetId($setid){
		$this->setid = $setid;
	}

	public function setSetName($setname){
		$this->setname=$setname;
	}
	public function setSetDescription($description){
		$this->setdescription = $description;
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
	public function getSetDescription(){
		return $this->setdescription;
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
		echo "INSERT INTO `question_question` (`set`, `question`, `mode`) VALUES (".$this->setid.", '".$question->getQuestion()."', '".$question->getMode()."')";
		$connection->exec("INSERT INTO `question_question` (`set`, `question`, `mode`) VALUES (".$this->setid.", '".$question->getQuestion()."', '".$question->getMode()."')");
		$question->setId($connection->lastInsertId());
		array_push($this->questions, $question);
	}
	
}

class question{
	private $questionId;
	private $question;
	private $answers = array();
	private $mode;
	private static $TEXTMODE = 1;
	private static $SELECTMODE = 2;

	public function addAnswer($answer){
		array_push($this->answers, $answer);
	}
	public function setMode($mode){
		$this->mode = $mode;
	}
	public function setId($questionId){
		$this->questionId = $questionId;
	}
	public function setQuestion($question){
		$this->question = $question;
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

	public function newAnswer($answer, $connection){
		$connection->exec("INSERT INTO `question_answer` (`ownerquestion`, `answertext`) VALUES (".$this->questionId.", '".$answer->getAnswer()."')");
		$answer->setAnswerId($connection->lastInsertId());
		array_push($this->answers, $answer);
	}
}

class answer{
	private $answerid;
	private $answer;

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
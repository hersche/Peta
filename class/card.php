<?php
/**
 * The complete set of cardsets for a specified user!
 * @author skamster
 *
 */
class allCardSets{
	private $sets = array();
	public function __construct($userid, $connection){
		$set = null;
		$setid = -1;
		$questionid = -1;
		$answerid = -1;
		foreach ($connection->query('SELECT * FROM fullQuestionSet WHERE ownerid="'.$userid.'"') as $row){
			if($row['setid']!=$setid){
				$set = new cardSet();
				$set->setSetId($row['setid']);
				$set->setSetName($row['setname']);
				$set->setSetDescription($row['setdescription']);
			}
			if(($questionid!=$row['questionid'])&&($row['questionid']!=null)){
				$question = new question();
				$question->setId($row['questionid']);
				$question->setQuestion($row['question']);
				$question->setMode($row['mode']);
				$question->setRightAnswered($row['rightAnswered']);
				$question->setWrongAnswered($row['wrongAnswered']);
			}
			if(($answerid!=$row['answerid'])&&($row['answerid']!=null)){
				$answerobj = new answer();
				$answerobj->setAnswer($row['answertext']);
				$answerobj->setAnswerId($row['answerid']);
			}
			if(($answerid!=$row['answerid'])&&($row['answerid']!=null)){
				$question->addAnswer($answerobj);
				$answerid = $row['answerid'];
			}
			if(($questionid!=$row['questionid'])&&($row['questionid']!=null)){
				$set->addQuestion($question);
				$questionid = $row['questionid'];
			}
			if(($set != null)&&($row['setid']!=$setid)){
				$setid=$row['setid'];
				array_push($this->sets, $set);
			}
		}
	}
	public function getSets(){
		return $this->sets;
	}
	public function deleteSet($set, $connection){
		//TODO remove from list!
		$set->deleteSet($connection);
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
		return false;
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


	public function newQuestion($question, $connection){
		$connection->exec("INSERT INTO `question_question` (`set`, `question`, `mode`) VALUES (".$this->setid.", '".$question->getQuestion()."', '".$question->getMode()."')");
		$question->setId($connection->lastInsertId());
		array_push($this->questions, $question);
	}
	public function getQuestionById($questionid){
		foreach ($this->questions as $question){
			if($question->getQuestionId()==$questionid){
				return $question;
			}
		}
		return false;
	}
	public function deleteSet($connection){
		foreach($this->questions as $question){
			$question->deleteQuestion($connection);
		}
		$connection->exec("DELETE FROM `learncards`.`question_set` WHERE `question_set`.`setid` = ".$this->setid);
	}
	public function updateSetDescription($description, $connection){
		$this->setdescription = $description;
		$connection->exec("UPDATE `learncards`.`question_set` SET `setdescription` = '".$description."' WHERE `question_set`.`setid` =".$this->setid.";");
	}
	public function updateSetName($name, $connection){
		$this->setname = $name;
		$connection->exec("UPDATE `learncards`.`question_set` SET `setname` = '".$name."' WHERE `question_set`.`setid` =".$this->setid.";");
	}

}

class question{
	private $questionId;
	private $question;
	private $answers = array();
	private $mode;
	private $rightAnswered;
	private $wrongAnswered;
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
	public function setRightAnswered($nr){
		$this->rightAnswered = $nr;
	}
	public function setWrongAnswered($nr){
		$this->wrongAnswered = $nr;
	}
	public function getRightAnswered(){
		return $this->rightAnswered;
	}
	public function getWrongAnswered(){
		return $this->wrongAnswered;
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
		return $this->questionId;
	}

	public function updateQuestion($question, $connection){
		$this->question = $question;
		$connection->exec("UPDATE `learncards`.`question_question` SET `question` = '".$question."' WHERE `question_question`.`questionid` =".$this->questionId.";");
	}

	public function checkRightAnswer($answertext, $connection){
		foreach($this->answers as $answer){
			// TODO build in option for diffrent answers!
			if($answer->getAnswer()==$answertext){
				$this->rightAnswered +=1;
				$connection->exec("UPDATE `learncards`.`question_question` SET `rightAnswered` = '".$this->rightAnswered."' WHERE `question_question`.`questionid` =".$this->questionId." LIMIT 1 ;");
				return true;
			}
		}
		$this->wrongAnswered +=1;
		$connection->exec("UPDATE `learncards`.`question_question` SET `wrongAnswered` = '".$this->wrongAnswered."' WHERE `question_question`.`questionid` =".$this->questionId." LIMIT 1 ;");
		return false;
	}

	public function newAnswer($answer, $connection){
		$connection->exec("INSERT INTO `learncards`.`question_answer` (`ownerquestion`, `answertext`) VALUES ('".$this->questionId."', '".$answer->getAnswer()."');");
		$answer->setAnswerId($connection->lastInsertId());
		array_push($this->answers, $answer);
	}
	public function deleteQuestion($connection){
		foreach($this->answers as $answer){
			$answer->deleteAnswer($connection);
		}
		$connection->exec("DELETE FROM `learncards`.`question_question` WHERE `question_question`.`questionid` = ".$this->questionId);
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

	public function deleteAnswer($connection){
		$connection->exec("DELETE FROM `learncards`.`question_answer` WHERE `question_answer`.`answerid` = ".$this->answerid);
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

class cardtools{
	public static function oneBeforeInArray($array, $position){
		if(count($array)>1){
			$beforePosition = ($position -1);
			if($beforePosition<0){
				return (count($array)-1);
			}
			else{
				return $beforePosition;
			}
		}
		else{
			return 0;
		}
	}
	public static function randomArrayPosition($array){
		if(count($array)>1){
			return rand(0, count($array)-1);
		}
		else{
			return 0;
		}
	}
}


?>
<?php

class skamsterCards extends plugin {

	private $currentUser;
	private $templateObject;
	private $connection;
	private $folder;
	private $id;
	/**
	 *
	 * Constructor
	 * @param array $post all the post-datas..
	 * @param array $get all the get-datas
	 * @param unknown_type $currentUser
	 * @param unknown_type $connection
	 */
	public function __construct($id, $currentUser, $templateObject, $folder, $connection) {
		$this->id = $id;
		$this -> currentUser = $currentUser;
		$this -> templateObject = $templateObject;
		$this -> connection = $connection;
		$this -> folder = $folder;
	}

	public function getPluginName() {
		return "cards.skamster";
	}

	/**
		This method will just be executed on instance plugins.
	**/
	public function getPluginDescription() {
		return "A plugindescription for cards.skamster .";
	}
	
	public function deleteInstanceTables(){
		$this -> connection -> exec("DROP TABLE IF EXIST `".$this->getDbPrefix()."question_set`,".$this->getDbPrefix()."question_question`,".$this->getDbPrefix()."question_answer`");
	}
	
	public function getId(){
		return $this->id;
	}
	public function getRequiredDojo(){
		if(($_GET['action']=="singlecardset") or ($_GET['action']=="createcardset")){
			return array("dojox.charting.widget.Chart2D", "dojox.charting.themes.PurpleRain");
		}
		return Null;
	}
	public function start() {
	$connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."question_set` (
		`setid` int(11) NOT NULL AUTO_INCREMENT,
		`setname` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
		`setdescription` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
		`ownerid` int(11) NOT NULL,
		`editcount` int(11) NOT NULL,
		`lasttimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		`createtimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
		`firstowner` int(11) NOT NULL,
		`tagsid` int(11) NOT NULL,
		PRIMARY KEY (`setid`)
	)");
	$connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."question_question` (
		`questionid` int(11) NOT NULL AUTO_INCREMENT,
		`set` int(11) NOT NULL,
		`question` varchar(100) NOT NULL,
		`mode` text NOT NULL,
		`rightAnswered` int(11) NOT NULL DEFAULT '0',
		`wrongAnswered` int(11) NOT NULL DEFAULT '0',
		PRIMARY KEY (`questionid`)
	)");
	$connection -> exec("CREATE TABLE IF NOT EXISTS `".$this->getDbPrefix()."question_answer` (
		`answerid` int(11) NOT NULL AUTO_INCREMENT,
		`ownerquestion` int(11) NOT NULL,
		`answertext` varchar(100) NOT NULL,
		`rightAnswer` tinyint(1) NOT NULL COMMENT 'true if it is the right answer, false if not (for multiple answers)',
		PRIMARY KEY (`answerid`)
	)");
	
		$connection = $this->connection;
		$template = $this -> templateObject;
		$messages = array();
		$template -> assign("pluginId", $_GET['plugin']);
		$template -> assign("folder", $this -> folder);
		require_once $this -> folder . 'card.class.php';
		$allSets = new allCardSets($_SESSION["user"] -> getId(), $connection,$this->getDbPrefix());
		switch($_GET["action"]) {
			case "create" :
				if (!isset($_GET['nrofquestions'])) {
					$template -> assign("nrofquestions", 3);
				} else {
					$template -> assign("nrofquestions", $_GET['nrofquestions']);
				}
				$template -> display($this -> folder . 'templates/cardPlugin_create.tpl');
				break;
			case "mkcreatecardset" :
				if (!empty($_POST["cardsetname"])) {
					$newCardSet = new cardSet();
					$newCardSet -> setSetName($_POST["cardsetname"]);
					$newCardSet -> setSetDescription($_POST["cardsetdescription"]);
					$template -> assign("nrofquestions", 3);
					$allSets -> newSet($newCardSet, $_SESSION["user"] -> getId(), $connection);
					$index = 0;
					while ($_GET['nrofquestions'] != $index) {
						if ($_POST['question' . $index] != "" && $_POST['answer' . $index] != "") {
							$question = new question();
							$question -> setQuestion($_POST['question' . $index]);
							$question -> setMode(1);
							$answer = new answer();
							$answer -> setAnswer($_POST['answer' . $index]);
							$newCardSet -> newQuestion($question, $connection);
							$question -> newAnswer($answer, $connection);
						}
						$index = $index + 1;

					}

					//$newCardSet->newQuestion($question, $connection);
					// $question->newAnswer($answer, $connection);
					array_push($messages, "Create cardset successfull!");
					$template -> assign("messages", $messages);
					$template -> assign("cardsets", $allSets -> getSets());
					$template -> display($this -> folder . 'templates/cardPlugin.tpl');
				}
				break;
			case "singlecardset" :
				if (!empty($_GET["setid"])) {
					$set = $allSets -> getSetBySetId($_GET["setid"]);
					$template -> assign("setid", $_GET['setid']);
					$template -> assign("cardsettitle", $set -> getSetName());
					$template -> assign("cardsetdescription", $set -> getSetDescription());
					$dojorequire = array("dojox.charting.widget.Chart2D", "dojox.charting.themes.PurpleRain");
					$template -> assign("dojorequire", $dojorequire);
					$questions = $set -> getQuestions();
					// TODO may better use a empty()-method
					if (count($questions) > 0) {
						$template -> assign("random", $_GET['random']);
						if ($_GET['random'] == "yes") {
							if (isset($_SESSION['lastid'])) {
								$lastQuestionId = $_SESSION['lastid'];
							}
							$questionid = cardtools::randomArrayPosition($questions);
							$question = $questions[$questionid];
							$_SESSION['lastid'] = $questionid;
							$template -> assign("nextquestion", 1);
						} else if (!empty($_GET['nextquestion'])) {
							$questionid = cardtools::oneBeforeInArray($questions, $_GET['nextquestion']);
							$lastQuestionId = cardtools::oneBeforeInArray($questions, $questionid);
							$question = $questions[$questionid];
							$template -> assign("questionid", $question -> getQuestionId());
							if (count($questions) > $_GET['nextquestion']) {
								$template -> assign("nextquestion", $_GET['nextquestion'] + 1);
							} else if (count($questions) == $_GET['nextquestion']) {
								$template -> assign("question", $question -> getQuestion());
								$template -> assign("nextquestion", 1);
							}

						} else {
							$question = $questions[0];
							$questionid = $question -> getQuestionId();
							$template -> assign("questionid", $question -> getQuestionId());
							if (count($questions) > 1) {
								$template -> assign("nextquestion", 2);
							} else {
								$template -> assign("nextquestion", 1);
							}
						}
						$template -> assign("question", $question -> getQuestion());
						if (!empty($_POST['answer'])) {
							$answer = $question -> getAnswers();
							if ($questions[$lastQuestionId] -> checkRightAnswer($_POST['answer'], $connection)) {
								array_push($messages, "Answer " . $_POST['answer'] . " was right! :) (Question was: " . $questions[$lastQuestionId] -> getQuestion() . ")");
							} else {
								$answer = $questions[$lastQuestionId] -> getAnswers();
								array_push($messages, "Answer was wrong! :( <br /> Question:" . $questions[$lastQuestionId] -> getQuestion() . " and answer: " . $answer[0] -> getAnswer());
							}
						}

						if (($question -> getRightAnswered() == 0) && ($question -> getWrongAnswered() == 0)) {
							$template -> assign("rightAnswered", "0.1");
							$template -> assign("wrongAnswered", "0.1");
						} else {
							$template -> assign("rightAnswered", $question -> getRightAnswered());
							$template -> assign("wrongAnswered", $question -> getWrongAnswered());
						}
					} else {
						//FIXME why i don't come here in? why the array is 1 without having questions?
						$template -> assign("question", "There are no questions!");
					}
					$template -> assign("messages", $messages);
					$template -> display($this -> folder . 'templates/cardPlugin_singlecardset.tpl');
					break;
				}
			case "deletecardset" :
				$template -> assign("setid", $_GET['setid']);
				$set = $allSets -> getSetBySetId($_GET["setid"]);
				if ($set == false) {
					// TODO build a error-page
					$template -> assign("cardsetname", "There is no set with id " . $_GET["setid"]);
				} else {
					$template -> assign("what", "cardset");
					$template -> assign("cardsetname", $set -> getSetName());

					if (isset($_POST['sure'])) {
						if ($_POST['sure'] == "yes") {
							$set -> deleteSet($connection);

						}
						header("Location: plugin.php?plugin=" . $_GET['plugin']);
					}
				}
				$template -> display($this -> folder . 'templates/cardPlugin_delete.tpl');
				break;
			case "editcardset" :
				$noCardset = true;
				if ((isset($_POST["setid"])) || (isset($_GET["setid"]))) {
					// TODO build a error-page
					$set = $allSets -> getSetBySetId($_POST["setid"]);
					if ($set != false) {
						$noCardset = false;
					} else {
						$set = $allSets -> getSetBySetId($_GET["setid"]);
						if ($set != false) {
							$noCardset = false;
						}
					}
				}

				if (!$noCardset) {
					$template -> assign("questions", $set -> getQuestions());
					$template -> assign("setid", $set -> getSetId());
					$template -> assign("cardsetname", $set -> getSetName());
					$template -> assign("cardsetdescription", $set -> getSetDescription());
					if (isset($_POST['sure'])) {
						if ($_POST['sure'] == "on") {
							$set -> updateSetDescription($_POST['cardsetdescripton'], $connection);
							$set -> updateSetName($_POST['cardsetname'], $connection);
						}
						header("Location: plugin.php?plugin=" . $_GET['plugin'] . "&action=singlecardset&setid=" . $set -> getSetId());
					}

				}
				if ($noCardset) {
					$template -> assign("cardsetname", gettext("There is no set with id ") . $_POST["setid"] . $_GET["setid"]);
				}
				$template -> display($this -> folder . 'templates/cardPlugin_editcardset.tpl');
				break;
			case "editquestion" :
				$noCardset = true;
				if ((isset($_POST["setid"])) || (isset($_GET["setid"]))) {
					// TODO build a error-page
					$set = $allSets -> getSetBySetId($_POST["setid"]);
					if ($set != false) {
						$template -> assign("setid", $set -> getSetId());
						$noCardset = false;
					} else {
						$set = $allSets -> getSetBySetId($_GET["setid"]);
						if ($set != false) {
							$template -> assign("setid", $set -> getSetId());
							$noCardset = false;
						}
					}
					$question = $set -> getQuestionById($_GET['questionid']);
					$template -> assign("questionid", $question -> getQuestionId());
				}

				if (!$noCardset) {

					$template -> assign("question", $question -> getQuestion());
					if (isset($_POST['sure'])) {
						if ($_POST['sure'] == "on") {
							$question -> updateQuestion($_POST['question'], $connection);
						}
						header("Location: plugin.php?plugin=" . $_GET['plugin'] . "&action=singlecardset&setid=" . $_GET['setid']);
					}

				}
				if ($noCardset) {
					$template -> assign("cardsetname", "There is no set with id " . $_POST["setid"] . $_GET["setid"]);
				}
				$template -> display($this -> folder . 'templates/cardPlugin_editquestion.tpl');
				break;
			case "deletequestion" :
				$template -> assign("setid", $_GET['setid']);
				$set = $allSets -> getSetBySetId($_GET["setid"]);
				if ($set == false) {
					// TODO build a error-page
					$template -> assign("cardsetname", "There is no set with id " . $_GET["setid"]);
				} else {

					$question = $set -> getQuestionById($_GET["questionid"]);
					if ($question == false) {
						$template -> assign("cardsetname", "There is no question with id " . $_GET["questionid"]);
					} else {
						$template -> assign("questionid", $question -> getQuestionId());
						$template -> assign("what", "question");
						$template -> assign("cardsetname", $question -> getQuestion());
						if (isset($_POST['sure'])) {
							if ($_POST['sure'] == "yes") {
								$question -> deleteQuestion($connection);
							}
							header("Location: plugin.php?plugin=" . $_GET['plugin']);
						}
					}
				}
				$template -> display($this -> folder . 'templates/cardPlugin_delete.tpl');
				break;
			case "addquestion" :
				$template -> assign("cardsets", $allSets -> getSets());
				if ((!empty($_POST["cardset"])) && (!empty($_POST['question1'])) && (!empty($_POST['answer1']))) {
					$set = $allSets -> getSetBySetId($_POST["cardset"]);
					$question = new question();
					$question -> setMode(1);
					$question -> setQuestion($_POST['question1']);
					$answer = new answer();
					$answer -> setAnswer($_POST['answer1']);
					$set -> newQuestion($question, $connection);
					$question -> newAnswer($answer, $connection);
					array_push($messages, "Add question successfull");
				}
				$template -> assign("messages", $messages);
				$template -> display($this -> folder . 'templates/cardPlugin_modify.tpl');
				break;
			default :
				$carding = new allCardSets($_SESSION["user"] -> getId(), $connection,$this->getDbPrefix());
				$template -> assign("cardsets", $carding -> getSets());
				$template -> display($this -> folder . 'templates/cardPlugin.tpl');
				break;
		}
	}

}
?>
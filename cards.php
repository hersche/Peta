<?php
require_once 'class/default.php';
require_once 'class/card.php';


switch($_GET["action"]){
	case "create":
		$template->display('cards_create.tpl');
		break;
	case "mkcreate":
		if((!empty($_POST["cardsetname"]))&&(!empty($_POST['answer1']))&&(!empty($_POST['question1']))){
			$allSets = new allCardSets($_SESSION["user"]->getId(), $connection);
			$newCardSet = new cardSet();
			$newCardSet->setSetName($_POST["cardsetname"]);
			echo $_POST["cardsetdescription"];
			$newCardSet->setSetDescription($_POST["cardsetdescription"]);
			$question = new question();
			$question->setQuestion($_POST['question1']);
			$question->setMode(1);
			$answer = new answer();
			$answer->setAnswer($_POST['answer1']);
			$allSets->newSet($newCardSet, $_SESSION["user"]->getId(), $connection);
			$newCardSet->newQuestion($question, $connection);
			$question->newAnswer($answer, $connection);
			array_push($messages, "Create cardset successfull!");
			$template->assign("messages", $messages);
			$template->assign("cardsets", $allSets->getSets());
			$template->display('cards.tpl');
			break;
		}
		break;
	case "singlecardset":
		// TODO check for right user!
		if(!empty($_GET["setid"])){
			$allSets = new allCardSets($_SESSION["user"]->getId(), $connection);
			$set = $allSets->getSetBySetId($_GET["setid"]);
			$template->assign("setid", $_GET['setid']);
			$template->assign("cardsettitle", $set->getSetName());
			$template->assign("cardsetdescription", $set->getSetDescription());
			$questions = $set->getQuestions();
			// TODO move check if array is empty from bottom to here, but without _GET-nextquestion-test!
			$questionid = cardtools::oneBeforeInArray($questions, $_GET['nextquestion']);
			$question = $questions[$questionid];

			$template->assign("right", $question->getRightAnswered());
			$template->assign("wrong", $question->getWrongAnswered());
			if((!empty($_GET['nextquestion']))&&(count($questions)>1)){

				if(count($questions)>$_GET['nextquestion']){
					$template->assign("question",$question->getQuestion());
					$template->assign("nextquestion",$_GET['nextquestion']+1);
				}
				else if(count($questions)==$_GET['nextquestion']){
					$template->assign("question",$question->getQuestion());
					$template->assign("nextquestion",1);
				}
				if(!empty($_POST['answer'])){
					$answer = $question->getAnswers();
					$lastQuestionId = cardtools::oneBeforeInArray($questions, $questionid);
					if($questions[$lastQuestionId]->checkRightAnswer($_POST['answer'], $connection)){
						array_push($messages, "Answer was right! :)");
					}
					else{
						array_push($messages, "Answer was wrong! :(");
					}
				}
			}
			else{
				$template->assign("question",$questions[0]->getQuestion());
				$template->assign("nextquestion",2);
			}
			$template->assign("messages", $messages);
			$template->display('cards_singlecardset.tpl');
			break;
		}
	case "addquestion":
		$allSets = new allCardSets($_SESSION["user"]->getId(), $connection);
		$template->assign("cardsets", $allSets->getSets());
		if((!empty($_POST["cardset"]))&&(!empty($_POST['question1']))&&(!empty($_POST['answer1']))){
			$set = $allSets->getSetBySetId($_POST["cardset"]);
			$question = new question();
			$question->setMode(1);
			$question->setQuestion($_POST['question1']);
			$answer = new answer();
			$answer->setAnswer($_POST['answer1']);
			$set->newQuestion($question, $connection);
			$question->newAnswer($answer, $connection);
			array_push($messages, "Add question successfull");
		}
		$template->assign("messages", $messages);
		$template->display('cards_addquestion.tpl');
		break;
	default:
		$carding = new allCardSets($_SESSION["user"]->getId(), $connection);
		$template->assign("cardsets", $carding->getSets());
		$template->display('cards.tpl');
		break;

}

?>
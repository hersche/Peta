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
		if(!empty($_GET["setid"])){
			$allSets = new allCardSets($_SESSION["user"]->getId(), $connection);
			$set = $allSets->getSetBySetId($_GET["setid"]);
			$template->assign("setid", $_GET['setid']);
			$template->assign("cardsettitle", $set->getSetName());
			$template->assign("cardsetdescription", $set->getSetDescription());
			$questions = $set->getQuestions();
			// TODO may better use a empty()-method
			if(count($questions)>0){
				if(!empty($_GET['nextquestion'])){
					$questionid = cardtools::oneBeforeInArray($questions, $_GET['nextquestion']);
					$question = $questions[$questionid];
					$template->assign("right", $question->getRightAnswered());
					$template->assign("wrong", $question->getWrongAnswered());
					$template->assign("questionid",$question->getQuestionId());
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
					$template->assign("right", $questions[0]->getRightAnswered());
					$template->assign("wrong", $questions[0]->getWrongAnswered());
					$template->assign("questionid",$questions[0]->getQuestionId());
					$template->assign("question",$questions[0]->getQuestion());
					if(count($questions)>1){
						$template->assign("nextquestion",2);
					}
					else{
						$template->assign("nextquestion",1);
					}
				}
			}
			else{
				$template->assign("question","There are no questions!");
			}
			$template->assign("messages", $messages);
			$template->display('cards_singlecardset.tpl');
			break;
		}
	case "deletecardset":
		$allSets = new allCardSets($_SESSION["user"]->getId(), $connection);
		$template->assign("setid", $_GET['setid']);
		$set = $allSets->getSetBySetId($_GET["setid"]);
		if($set==false){
			// TODO build a error-page
			$template->assign("cardsetname", "There is no set with id ".$_GET["setid"]);
		}
		else{
			$template->assign("what", "cardset");
			$template->assign("cardsetname", $set->getSetName());

			if(isset($_POST['sure'])){
				if($_POST['sure']=="yes"){
					$set->deleteSet($connection);

				}
				header("Location: cards.php");
			}
		}
		$template->display('cards_delete.tpl');
		break;
	case "editcardset":
		$noCardset = true;
		$allSets = new allCardSets($_SESSION["user"]->getId(), $connection);
		if((isset($_POST["setid"]))||(isset($_GET["setid"]))){
			// TODO build a error-page
			$set = $allSets->getSetBySetId($_POST["setid"]);
			if($set!=false){
				$template->assign("setid", $set->getSetId());
				$noCardset = false;
			}
			else{
				$set = $allSets->getSetBySetId($_GET["setid"]);
				if($set!=false){
					$template->assign("setid", $set->getSetId());
					$noCardset = false;
				}
			}
		}
		if(!$noCardset){

			$template->assign("cardsetname", $set->getSetName());
			$template->assign("cardsetdescription", $set->getSetDescription());
			if(isset($_POST['sure'])){
				if($_POST['sure']=="on"){
					$set->updateSetDescription($_POST['cardsetdescripton'], $connection);
					$set->updateSetName($_POST['cardsetname'], $connection);
				}
				header("Location: cards.php");
			}

		}
		if($noCardset){
			$template->assign("cardsetname", "There is no set with id ".$_POST["setid"].$_GET["setid"]);
		}
		$template->display('cards_editcardset.tpl');
		break;

	case "deletequestion":
		$allSets = new allCardSets($_SESSION["user"]->getId(), $connection);
		$template->assign("setid", $_GET['setid']);
		$set = $allSets->getSetBySetId($_GET["setid"]);
		if($set==false){
			// TODO build a error-page
			$template->assign("cardsetname", "There is no set with id ".$_GET["setid"]);
		}
		else{

			$question = $set->getQuestionById($_GET["questionid"]);
			if($question == false){
				$template->assign("cardsetname", "There is no question with id ".$_GET["questionid"]);
			}
			else{
				$template->assign("questionid",$question->getQuestionId());
				$template->assign("what", "question");
				$template->assign("cardsetname", $question->getQuestion());
				if(isset($_POST['sure'])){
					if($_POST['sure']=="yes"){
						$question->deleteQuestion($connection);
					}
					header("Location: cards.php");
				}
			}
		}
		$template->display('cards_delete.tpl');
		break;
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
		$template->display('cards_modify.tpl');
		break;
	default:
		$carding = new allCardSets($_SESSION["user"]->getId(), $connection);
		$template->assign("cardsets", $carding->getSets());
		$template->display('cards.tpl');
		break;

}

?>
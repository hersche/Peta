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
			$question = new question();
			$question->setQuestion($_POST['question1']);
			$question->setMode(1);
			$answer = new answer();
			$answer->setAnswer($_POST['answer1']);
			$allSets->newSet($newCardSet, $_SESSION["user"]->getId(), $connection);
			$newCardSet->newQuestion($question, $connection);			
			$question->newAnswer($answer, $connection);
			$template->assign("messages", "Create cardset successfull!");
			$template->display('cards.tpl');
			break;
		}
		break;
	default:
		$carding = new allCardSets($_SESSION["user"]->getId(), $connection);
		$template->assign("cardsets", $carding->getSets());
		$template->display('cards.tpl');
		break;
		
}

?>
<?php 
class cardController{
	public static function mkcreate(){
			$newCardSet = new cardSet();
			$newCardSet->setSetName($_POST["cardsetname"]);
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
	}
}

?>
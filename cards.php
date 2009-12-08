<?php
require_once 'class/default.php';
require_once 'class/card.php';

$carding = new allCardSets($_SESSION["user"]->getId(), $connection);
$set = $carding->getSets();
array_push($messages, $set[0]->getSetId());
$question = $set[0]->getQuestions();
array_push($messages, $question[0]->getQuestion());
$answer = $question[0]->getAnswers();
array_push($messages, $answer[0]->getAnswer());
$template->assign("messages", $messages);

$template->display('cards.tpl');
?>
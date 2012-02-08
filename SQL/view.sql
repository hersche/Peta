 
-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. November 2009 um 15:40
-- Server Version: 5.1.41
-- PHP-Version: 5.2.11-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `learncards`
--

-- --------------------------------------------------------

--
-- Struktur des Views `fullQuestionSet`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fullQuestionSet` AS select `qs`.`setid` AS `setid`,`qs`.`setname` AS `setname`,`qs`.`ownerid` AS `ownerid`,`qs`.`editcount` AS `editcount`,`qs`.`lasttimestamp` AS `lasttimestamp`,`qs`.`createtimestamp` AS `createtimestamp`,`qs`.`firstowner` AS `firstowner`,`qs`.`tagsid` AS `tagsid`,`qa`.`answerid` AS `answerid`,`qa`.`ownerquestion` AS `ownerquestion`,`qa`.`answertext` AS `answertext`,`qq`.`questionid` AS `questionid`,`qq`.`set` AS `set`,`qq`.`question` AS `question`,`qq`.`mode` AS `mode`,`tags`.`tagid` AS `tagid`,`tags`.`tagname` AS `tagname` from (`question_set` `qs` left join ((`question_answer` `qa` join `question_question` `qq`) join `tags`) on(((`qs`.`tagsid` = `tags`.`tagid`) and (`qs`.`setid` = `qq`.`set`) and (`qq`.`questionid` = `qa`.`ownerquestion`))));

--
-- VIEW  `fullQuestionSet`
-- Daten: keine
--


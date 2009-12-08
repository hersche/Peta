-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Dezember 2009 um 12:13
-- Server Version: 5.1.41
-- PHP-Version: 5.2.11-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `learncards`
--

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `fullQuestionSet`
--
CREATE TABLE IF NOT EXISTS `fullQuestionSet` (
`setid` int(11)
,`setname` varchar(11)
,`ownerid` int(11)
,`editcount` int(11)
,`lasttimestamp` timestamp
,`createtimestamp` timestamp
,`firstowner` int(11)
,`tagsid` int(11)
,`id` int(11)
,`username` varchar(22)
,`password` varchar(1026)
,`lastlogin` date
,`lastip` varchar(11)
,`questionid` int(11)
,`set` int(11)
,`question` varchar(100)
,`mode` text
,`answerid` int(11)
,`ownerquestion` int(11)
,`answertext` varchar(100)
);
-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `fullUser`
--
CREATE TABLE IF NOT EXISTS `fullUser` (
`id` int(11)
,`username` varchar(22)
,`password` varchar(1026)
,`lastlogin` date
,`lastip` varchar(11)
,`buserid` int(11)
,`broleid` int(11)
,`roleid` int(11)
,`role` varchar(22)
,`user_profile_id` int(11)
,`name` varchar(20)
,`schule` int(20)
,`klasse` int(10)
,`mail` int(26)
,`hobbys` int(100)
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_answer`
--

CREATE TABLE IF NOT EXISTS `question_answer` (
  `answerid` int(11) NOT NULL AUTO_INCREMENT,
  `ownerquestion` int(11) NOT NULL,
  `answertext` varchar(100) NOT NULL,
  PRIMARY KEY (`answerid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `question_answer`
--

INSERT INTO `question_answer` (`answerid`, `ownerquestion`, `answertext`) VALUES
(1, 1, 'genau so!');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_question`
--

CREATE TABLE IF NOT EXISTS `question_question` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `set` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `mode` text NOT NULL,
  PRIMARY KEY (`questionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `question_question`
--

INSERT INTO `question_question` (`questionid`, `set`, `question`, `mode`) VALUES
(1, 1, 'wer was wie?', 'radio');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_set`
--

CREATE TABLE IF NOT EXISTS `question_set` (
  `setid` int(11) NOT NULL AUTO_INCREMENT,
  `setname` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ownerid` int(11) NOT NULL,
  `editcount` int(11) NOT NULL,
  `lasttimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createtimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `firstowner` int(11) NOT NULL,
  `tagsid` int(11) NOT NULL,
  PRIMARY KEY (`setid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `question_set`
--

INSERT INTO `question_set` (`setid`, `setname`, `ownerid`, `editcount`, `lasttimestamp`, `createtimestamp`, `firstowner`, `tagsid`) VALUES
(1, 'test', 16, 1, '2009-12-01 13:41:03', '0000-00-00 00:00:00', 16, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(22) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`roleid`, `role`) VALUES
(1, 'admin'),
(2, 'normal');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(50) NOT NULL,
  PRIMARY KEY (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `tags`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `buserid` int(11) NOT NULL,
  `broleid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `userrole`
--

INSERT INTO `userrole` (`buserid`, `broleid`) VALUES
(16, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1026) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` date NOT NULL,
  `lastip` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `lastlogin`, `lastip`) VALUES
(16, 'test', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2009-11-27', '127.0.0.1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_profile`
--

CREATE TABLE IF NOT EXISTS `users_profile` (
  `user_profile_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `schule` int(20) NOT NULL,
  `klasse` int(10) NOT NULL,
  `mail` int(26) NOT NULL,
  `hobbys` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users_profile`
--

INSERT INTO `users_profile` (`user_profile_id`, `name`, `schule`, `klasse`, `mail`, `hobbys`) VALUES
(16, 'testgugus', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur des Views `fullQuestionSet`
--
DROP TABLE IF EXISTS `fullQuestionSet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fullQuestionSet` AS select `qs`.`setid` AS `setid`,`qs`.`setname` AS `setname`,`qs`.`ownerid` AS `ownerid`,`qs`.`editcount` AS `editcount`,`qs`.`lasttimestamp` AS `lasttimestamp`,`qs`.`createtimestamp` AS `createtimestamp`,`qs`.`firstowner` AS `firstowner`,`qs`.`tagsid` AS `tagsid`,`user`.`id` AS `id`,`user`.`username` AS `username`,`user`.`password` AS `password`,`user`.`lastlogin` AS `lastlogin`,`user`.`lastip` AS `lastip`,`qq`.`questionid` AS `questionid`,`qq`.`set` AS `set`,`qq`.`question` AS `question`,`qq`.`mode` AS `mode`,`qa`.`answerid` AS `answerid`,`qa`.`ownerquestion` AS `ownerquestion`,`qa`.`answertext` AS `answertext` from (`question_set` `qs` left join ((`users` `user` join `question_question` `qq`) join `question_answer` `qa`) on(((`user`.`id` = `qs`.`ownerid`) and (`qq`.`set` = `qs`.`setid`) and (`qq`.`questionid` = `qa`.`ownerquestion`))));

-- --------------------------------------------------------

--
-- Struktur des Views `fullUser`
--
DROP TABLE IF EXISTS `fullUser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fullUser` AS select `users`.`id` AS `id`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`lastlogin` AS `lastlogin`,`users`.`lastip` AS `lastip`,`userrole`.`buserid` AS `buserid`,`userrole`.`broleid` AS `broleid`,`role`.`roleid` AS `roleid`,`role`.`role` AS `role`,`users_profile`.`user_profile_id` AS `user_profile_id`,`users_profile`.`name` AS `name`,`users_profile`.`schule` AS `schule`,`users_profile`.`klasse` AS `klasse`,`users_profile`.`mail` AS `mail`,`users_profile`.`hobbys` AS `hobbys` from (`users` join ((`userrole` join `role`) join `users_profile`) on(((`users`.`id` = `userrole`.`buserid`) and (`userrole`.`broleid` = `role`.`roleid`) and (`users`.`id` = `users_profile`.`user_profile_id`))));

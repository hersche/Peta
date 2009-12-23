-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2009 at 06:47 PM
-- Server version: 5.1.41
-- PHP Version: 5.2.11-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `learncards`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `fullQuestionSet`
--
CREATE TABLE IF NOT EXISTS `fullQuestionSet` (
`setid` int(11)
,`setname` varchar(11)
,`setdescription` varchar(1000)
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
,`rightAnswered` int(11)
,`wrongAnswered` int(11)
,`answerid` int(11)
,`ownerquestion` int(11)
,`answertext` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `fullUser`
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
-- Table structure for table `question_answer`
--

CREATE TABLE IF NOT EXISTS `question_answer` (
  `answerid` int(11) NOT NULL AUTO_INCREMENT,
  `ownerquestion` int(11) NOT NULL,
  `answertext` varchar(100) NOT NULL,
  PRIMARY KEY (`answerid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_question`
--

CREATE TABLE IF NOT EXISTS `question_question` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `set` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `mode` text NOT NULL,
  `rightAnswered` int(11) NOT NULL DEFAULT '0',
  `wrongAnswered` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`questionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `question_set`
--

CREATE TABLE IF NOT EXISTS `question_set` (
  `setid` int(11) NOT NULL AUTO_INCREMENT,
  `setname` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `setdescription` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `ownerid` int(11) NOT NULL,
  `editcount` int(11) NOT NULL,
  `lasttimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createtimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `firstowner` int(11) NOT NULL,
  `tagsid` int(11) NOT NULL,
  PRIMARY KEY (`setid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(22) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(50) NOT NULL,
  PRIMARY KEY (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `buserid` int(11) NOT NULL,
  `broleid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1026) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` date NOT NULL,
  `lastip` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE IF NOT EXISTS `users_profile` (
  `user_profile_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `schule` int(20) NOT NULL,
  `klasse` int(10) NOT NULL,
  `mail` int(26) NOT NULL,
  `hobbys` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `fullQuestionSet`
--
DROP TABLE IF EXISTS `fullQuestionSet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fullQuestionSet` AS select `qs`.`setid` AS `setid`,`qs`.`setname` AS `setname`,`qs`.`setdescription` AS `setdescription`,`qs`.`ownerid` AS `ownerid`,`qs`.`editcount` AS `editcount`,`qs`.`lasttimestamp` AS `lasttimestamp`,`qs`.`createtimestamp` AS `createtimestamp`,`qs`.`firstowner` AS `firstowner`,`qs`.`tagsid` AS `tagsid`,`user`.`id` AS `id`,`user`.`username` AS `username`,`user`.`password` AS `password`,`user`.`lastlogin` AS `lastlogin`,`user`.`lastip` AS `lastip`,`qq`.`questionid` AS `questionid`,`qq`.`set` AS `set`,`qq`.`question` AS `question`,`qq`.`mode` AS `mode`,`qq`.`rightAnswered` AS `rightAnswered`,`qq`.`wrongAnswered` AS `wrongAnswered`,`qa`.`answerid` AS `answerid`,`qa`.`ownerquestion` AS `ownerquestion`,`qa`.`answertext` AS `answertext` from (`question_set` `qs` left join ((`users` `user` join `question_question` `qq`) join `question_answer` `qa`) on(((`user`.`id` = `qs`.`ownerid`) and (`qq`.`set` = `qs`.`setid`) and (`qq`.`questionid` = `qa`.`ownerquestion`))));

-- --------------------------------------------------------

--
-- Structure for view `fullUser`
--
DROP TABLE IF EXISTS `fullUser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fullUser` AS select `users`.`id` AS `id`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`lastlogin` AS `lastlogin`,`users`.`lastip` AS `lastip`,`userrole`.`buserid` AS `buserid`,`userrole`.`broleid` AS `broleid`,`role`.`roleid` AS `roleid`,`role`.`role` AS `role`,`users_profile`.`user_profile_id` AS `user_profile_id`,`users_profile`.`name` AS `name`,`users_profile`.`schule` AS `schule`,`users_profile`.`klasse` AS `klasse`,`users_profile`.`mail` AS `mail`,`users_profile`.`hobbys` AS `hobbys` from (`users` join ((`userrole` join `role`) join `users_profile`) on(((`users`.`id` = `userrole`.`buserid`) and (`userrole`.`broleid` = `role`.`roleid`) and (`users`.`id` = `users_profile`.`user_profile_id`))));

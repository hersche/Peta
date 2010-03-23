-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2010 at 02:25 PM
-- Server version: 5.1.45
-- PHP Version: 5.3.2-1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `learncards`
--

-- --------------------------------------------------------

--
-- Table structure for table `config_loginneedlesssites`
--

CREATE TABLE IF NOT EXISTS `config_loginneedlesssites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `config_loginneedlesssites`
--

INSERT INTO `config_loginneedlesssites` (`id`, `site`) VALUES
(1, '/^forum.php$/'),
(3, '''action=showthread&threadid=''');

-- --------------------------------------------------------

--
-- Table structure for table `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
  `forumid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `toptopic` int(11) NOT NULL,
  `threadstate` int(5) NOT NULL DEFAULT '0',
  `editcounter` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`forumid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `forum_threads`
--

INSERT INTO `forum_threads` (`forumid`, `userid`, `title`, `text`, `timestamp`, `toptopic`, `threadstate`, `editcounter`) VALUES
(1, 2, 'teste', 'hallo welt!e', '2010-03-09 11:08:26', -1, 0, 0),
(6, 16, 'blubb', 'gaga und sooooood!  ', '2010-03-09 10:46:10', -1, 0, 0),
(7, 16, 'Harry stinkt', 'Und sooooo<br /><u>adsagfsd</u><br />  ', '2010-02-09 11:07:39', -1, 0, 0),
(8, 16, 'Mein erster richtiger Topic :)', 'Also, dass dies ein <b>Test </b>ist, ist ja <u>klar!</u> Denoch sollte <strike>alles</strike> nichts schief gehen..<br /><ul><li>Sicherheit gut!</li><li>Ausfall-zeug tiptop<br /></li></ul>  ', '2010-02-09 11:18:42', -1, 0, 0),
(9, 16, '', 'sooooo..<br />jetzt endlich???<br />asd<br />  \r\n  \r\n  \r\n  \r\n  ', '2010-03-09 11:23:05', 8, 0, 4),
(10, 16, '', 'yeah yeah, es funzt alles :)<br /><b>huuuui :D</b><br />lalalawqererw<br />  \r\n  \r\n  ', '2010-03-09 11:20:46', 8, 0, 2),
(11, 16, 'aja', 'zwar.. eigentlich nich.. :p  ', '2010-02-12 14:42:29', 7, 0, 0),
(12, 16, 'aja', 'zwar.. eigentlich nich.. :p  ', '2010-02-12 14:43:28', 7, 0, 0),
(13, 16, 'dggh', 'fgdhhdg  ', '2010-02-12 14:45:18', 7, 0, 0),
(14, 16, 'dggh', 'fgdhhdg  ', '2010-02-12 14:46:00', 7, 0, 0),
(15, 16, 'dggh', 'fgdhhdg  ', '2010-02-12 14:46:14', 7, 0, 0),
(51, 20, 'wÃ¶u!', 'dsgfdgdg  ', '2010-03-02 09:56:39', 32, 0, 0),
(17, 16, 'dggh', 'fgdhhdg  ', '2010-02-12 14:47:43', 7, 0, 0),
(18, 16, 'dggh', 'fgdhhdg  ', '2010-02-12 14:50:28', 7, 0, 0),
(19, 16, 'dggh', 'fgdhhdg  ', '2010-02-12 14:51:21', 7, 0, 0),
(20, 16, 'haha', 'jo, ich glaub, es klappt :)  ', '2010-02-12 14:51:45', 6, 0, 0),
(21, 16, 'more testing!', 'asdgsdf  ', '2010-02-12 14:53:08', -1, 0, 0),
(22, 16, 'dffgh', 'fghh  ', '2010-02-12 14:54:30', -1, 0, 0),
(23, 16, 'sdfgdfhdg', 'ghgh  ', '2010-02-12 14:57:19', -1, 0, 0),
(24, 16, '', 'sdffasd  ', '2010-02-12 14:57:28', 22, 0, 0),
(25, 16, 'gdhgh', 'fgdhdf  ', '2010-02-12 15:44:26', 23, 0, 0),
(26, 16, 'fdd', 'fgghh  ', '2010-02-12 15:44:33', 25, 0, 0),
(27, 16, 'a subthread!', 'substhread-testing!  ', '2010-02-12 15:50:58', 10, 0, 0),
(28, 16, 'this should be under the smile', 'and so on!  ', '2010-02-12 15:51:44', 10, 0, 0),
(29, 16, 'subsub', 'dfgdfsd  ', '2010-02-12 15:53:37', 27, 0, 0),
(30, 16, '', 'and on and on and on...................<br /><ol><li>it works</li><li>both things are possible..</li><li>it just do, what i want :)<br /></li></ol>  ', '2010-02-12 16:01:46', 28, 0, 0),
(31, 16, '', 'verzÃ¶gerung?fdsdafsdfs', '2010-03-09 11:09:09', 9, 0, 0),
(32, 16, 'huhu', 'sdffasd  ', '2010-02-12 17:35:19', 21, 0, 0),
(33, 16, '', 'sdfggsdfgfsdh  ', '2010-02-12 17:36:49', 32, 0, 0),
(34, 16, 'mmh', 'ooooder?  ', '2010-02-12 17:38:38', 12, 0, 0),
(35, 16, '', 'dhdghd  ', '2010-02-12 17:41:25', 13, 0, 0),
(36, 16, '', 'dhdghd  ', '2010-02-12 17:42:58', 13, 0, 0),
(37, 16, 'thema', '<u>hallo</u><b> LenaÂ </b>  ', '2010-02-12 19:10:17', -1, 0, 0),
(38, 16, '', 'tshgfdfhghdf  ', '2010-02-12 19:10:51', 37, 0, 0),
(39, 16, '', 'dsgsdagsad  ', '2010-02-12 19:11:05', 38, 0, 0),
(40, 16, '', 'adsafddasadfs  ', '2010-02-12 19:11:11', 37, 0, 0),
(41, 16, 'fdhdsh', 'fdfsgfdsgdf  ', '2010-02-12 19:11:31', 39, 0, 0),
(42, 16, 'sadfdsda', 'sdfgsdfhgfhgfd  ', '2010-02-16 08:29:28', 40, 0, 0),
(43, 16, 'ich funktioniere', 'haaaallo  ', '2010-02-16 08:29:41', 42, 0, 0),
(44, 16, 'adsffds', 'asdfds  ', '2010-02-16 08:30:04', 42, 0, 0),
(45, 16, 'fafd', 'asdffdasdas  ', '2010-02-16 08:33:40', 20, 0, 0),
(46, 16, 'sdaffds', 'fdgdfhfgd  ', '2010-02-16 08:33:48', 45, 0, 0),
(47, 16, 'hallo... :p', 'fdgdf  ', '2010-02-16 08:36:35', 20, 0, 0),
(48, 16, 'gugus', 'asdasdg  ', '2010-02-16 08:36:43', 46, 0, 0),
(49, 16, 'ich funze!', 'dsafasdg  ', '2010-02-16 08:41:24', 6, 0, 0),
(50, 16, 'neu', 'neu  ', '2010-02-16 08:59:55', -1, 0, 0),
(52, 20, 'fdsghfd', 'sfdgsfdgfsdg  ', '2010-03-02 11:17:02', 1, 0, 0),
(53, 20, '', 'fdgsdfggf  ', '2010-03-02 11:17:12', 11, 0, 0),
(54, 20, '', 'gfsdgfdsfgsdg  ', '2010-03-02 11:17:18', 7, 0, 0),
(55, 20, 'sfdggfg', 'sfdgdsfgf  ', '2010-03-02 11:17:29', 12, 0, 0),
(56, 16, '', 'antwort...und editieren..<br />', '2010-03-09 11:10:12', 9, 0, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `fullQuestionSet`
--
CREATE TABLE IF NOT EXISTS `fullQuestionSet` (
`setid` int(11)
,`setname` varchar(25)
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
  `rightAnswer` tinyint(1) NOT NULL COMMENT 'true if it is the right answer, false if not (for multiple answers)',
  PRIMARY KEY (`answerid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `question_answer`
--

INSERT INTO `question_answer` (`answerid`, `ownerquestion`, `answertext`, `rightAnswer`) VALUES
(1, 1, 'genau so!', 0),
(34, 41, 'Hurensohn', 0),
(3, 3, 'fuck windoof!', 0),
(4, 4, 'hello world', 0),
(5, 5, 'ich!', 0),
(6, 6, 'sd gk', 0),
(7, 7, 'darum!', 0),
(8, 8, 'huhu', 0),
(32, 39, 'Schwanzkopf', 0),
(33, 40, 'Arschbumser', 0),
(12, 14, 'eins', 0),
(13, 15, 'zwei', 0),
(30, 37, 'hgjmnhgjmnvh', 0),
(23, 30, 'gugs!', 0),
(31, 38, 'nicht thibo', 0),
(20, 24, 'hallo', 0),
(21, 28, 'hier', 0),
(38, 45, 'ja', 0),
(37, 44, 'ja', 0),
(39, 46, 'ja', 0),
(40, 47, 'ja', 0),
(41, 48, 'frage', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `question_question`
--

INSERT INTO `question_question` (`questionid`, `set`, `question`, `mode`, `rightAnswered`, `wrongAnswered`) VALUES
(48, 31, 'erste', '1', 0, 0),
(3, 12, 'testiui', '1', 1, 16),
(4, 0, 'hello', '1', 0, 0),
(5, 0, 'wer bin ich?', '1', 0, 0),
(6, 0, 'sbdkkgfbd', '1', 0, 0),
(7, 0, 'warum?', '1', 0, 0),
(8, 0, 'hihi', '1', 0, 0),
(44, 30, 'habe ich viel zeit in den code investiert?', '1', 4, 3),
(45, 30, 'funzt es?', '1', 3, 1),
(46, 30, 'wird''s noch besser?', '1', 3, 3),
(41, 27, 'Son of a bitch', '1', 0, 0),
(47, 30, 'ist es ne demo?', '1', 2, 1),
(30, 7, 'gugs!!', '1', 5, 3),
(40, 27, 'Assrammer', '1', 0, 0),
(39, 27, 'Dickhead', '1', 0, 0),
(37, 12, 'hallo..', '1', 1, 2),
(38, 12, 'wer bin ich', '1', 6, 1),
(28, 26, 'wo ist walter?', '1', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_set`
--

CREATE TABLE IF NOT EXISTS `question_set` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `question_set`
--

INSERT INTO `question_set` (`setid`, `setname`, `setdescription`, `ownerid`, `editcount`, `lasttimestamp`, `createtimestamp`, `firstowner`, `tagsid`) VALUES
(7, 'bi widr zruegg!', 'fuck you! und so.. haha und hier geht''s auch :p\r\njuhui!', 16, 1, '2010-01-12 08:00:06', '0000-00-00 00:00:00', 16, 0),
(12, 'test', 'teeeest', 16, 1, '2010-01-11 20:44:39', '0000-00-00 00:00:00', 16, 0),
(26, 'test', 'hallo welt', 17, 1, '2009-12-25 15:07:21', '0000-00-00 00:00:00', 17, 0),
(27, 'English', 'Swearwords', 18, 1, '2010-01-12 08:51:17', '0000-00-00 00:00:00', 18, 0),
(30, 'lehrer', 'prÃ¤sentation und so..', 16, 1, '2010-01-12 13:18:50', '0000-00-00 00:00:00', 16, 0),
(31, 'testset', 'ein beispiel', 16, 1, '2010-01-12 13:35:24', '0000-00-00 00:00:00', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(22) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleid`, `role`) VALUES
(1, 'admin'),
(2, 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(50) NOT NULL,
  PRIMARY KEY (`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tags`
--


-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `buserid` int(11) NOT NULL,
  `broleid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`buserid`, `broleid`) VALUES
(16, 2),
(17, 1),
(18, 1),
(19, 2),
(20, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `lastlogin`, `lastip`) VALUES
(16, 'test', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2009-11-27', '127.0.0.1'),
(17, 'kobi', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2009-12-25', '169.254.12.'),
(18, 'JT', 'a09f253d075dcc2b76d7bbcd21998fb6db6e1eeb9b7c87d58adb8fcae619e4751457f87f6a07a9e48de4882e35f51c5212bf15f78bc1984623d70b864e717dc8', '2010-01-12', '172.20.25.1'),
(19, 'gdfsg', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2010-02-23', '127.0.0.1'),
(20, 'test2', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2010-03-02', '127.0.0.1');

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

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`user_profile_id`, `name`, `schule`, `klasse`, `mail`, `hobbys`) VALUES
(16, 'testgugus', 0, 0, 0, 0),
(17, 'christian', 0, 0, 0, 0),
(18, 'JT', 0, 0, 0, 0),
(19, 'fdsgfg', 0, 0, 0, 0),
(20, 'test2', 0, 0, 0, 0);

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

-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 13. Februar 2012 um 19:03
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `learncards`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `element`
--

CREATE TABLE IF NOT EXISTS `element` (
  `eid` int(16) NOT NULL AUTO_INCREMENT,
  `e_pid` int(16) NOT NULL COMMENT 'element 2 page',
  `e_plid` int(16) NOT NULL COMMENT 'element 2 plugin',
  `prio` int(16) NOT NULL COMMENT 'reihenfolge',
  `name` varchar(40) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `element`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forum_threads`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Daten für Tabelle `forum_threads`
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
(56, 16, '', 'antwort...und editieren..<br />', '2010-03-09 11:10:12', 9, 0, 0),
(57, 21, 'SDASD', 'sdafsdg  ', '2012-02-13 12:34:11', 22, 0, 0),
(58, 21, 'dasfdsdaf', 'sadfasdfsdffsda  ', '2012-02-13 12:34:19', 24, 0, 0),
(59, 21, '', 'wewertewrttre  ', '2012-02-13 12:34:31', 58, 0, 0),
(60, 21, '', 'aetrtgsaegsf  ', '2012-02-13 12:34:37', 59, 0, 0),
(61, 21, '', 'sfgdsfdgfsd  ', '2012-02-13 12:34:41', 60, 0, 0),
(62, 21, '', 'dafsaf  ', '2012-02-13 12:34:48', 59, 0, 0);

-- --------------------------------------------------------


--
-- Daten für Tabelle `fullquestionset`
--
-- in Benutzung (#1356 - View 'learncards.fullquestionset' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `fulluser`
--
CREATE TABLE IF NOT EXISTS `fulluser` (
`uid` int(11)
,`username` varchar(22)
,`password` varchar(1026)
,`lastlogin` date
,`lastip` varchar(11)
,`ur_uid` int(11)
,`ur_rid` int(11)
,`rid` int(11)
,`role` varchar(22)
,`r_admin` tinyint(1)
,`cf_id` int(16)
,`cf_uid` int(11)
,`cf_key` varchar(30)
,`cf_value` text
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `pid` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID des elementes',
  `parent` int(8) NOT NULL DEFAULT '0' COMMENT 'Elternseite',
  `target` varchar(8) NOT NULL COMMENT '_top etc',
  `navigation` text NOT NULL COMMENT 'welche navigation es betrifft',
  `page_title` text NOT NULL,
  `navigation_title` text NOT NULL,
  `description` text NOT NULL,
  `show_navigation` tinyint(1) NOT NULL COMMENT 'ob in der navi angezeigt',
  `show_defined` text NOT NULL COMMENT 'vordefinierte gruppe',
  `prio` int(8) NOT NULL COMMENT 'reihenfolge fuer navi',
  `modified_when` datetime NOT NULL,
  `modified_by` int(8) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `page`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pid_rid_uid`
--

CREATE TABLE IF NOT EXISTS `pid_rid_uid` (
  `pid` int(16) NOT NULL,
  `uid` int(16) NOT NULL,
  `rid` int(16) NOT NULL,
  `view` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `pid_rid_uid`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plugin`
--

CREATE TABLE IF NOT EXISTS `plugin` (
  `plid` int(16) NOT NULL AUTO_INCREMENT,
  `pl_name` varchar(40) NOT NULL,
  `pl_hash` varchar(512) NOT NULL,
  `pl_version` varchar(8) NOT NULL,
  PRIMARY KEY (`plid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `plugin`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_answer`
--

CREATE TABLE IF NOT EXISTS `question_answer` (
  `answerid` int(11) NOT NULL AUTO_INCREMENT,
  `ownerquestion` int(11) NOT NULL,
  `answertext` varchar(100) NOT NULL,
  `rightAnswer` tinyint(1) NOT NULL COMMENT 'true if it is the right answer, false if not (for multiple answers)',
  PRIMARY KEY (`answerid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Daten für Tabelle `question_answer`
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
(41, 48, 'frage', 0),
(42, 49, 'blau', 0),
(43, 50, 'grÃ¼n', 0),
(44, 51, 'violett', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_question`
--

CREATE TABLE IF NOT EXISTS `question_question` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `set` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `mode` text NOT NULL,
  `rightAnswered` int(11) NOT NULL DEFAULT '0',
  `wrongAnswered` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`questionid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Daten für Tabelle `question_question`
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
(28, 26, 'wo ist walter?', '1', 1, 0),
(49, 32, 'blau', '1', 1, 1),
(50, 32, 'grÃ¼n', '1', 0, 0),
(51, 32, 'violett', '1', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_set`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Daten für Tabelle `question_set`
--

INSERT INTO `question_set` (`setid`, `setname`, `setdescription`, `ownerid`, `editcount`, `lasttimestamp`, `createtimestamp`, `firstowner`, `tagsid`) VALUES
(7, 'bi widr zruegg!', 'fuck you! und so.. haha und hier geht''s auch :p\r\njuhui!', 16, 1, '2010-01-12 08:00:06', '0000-00-00 00:00:00', 16, 0),
(12, 'test', 'teeeest', 16, 1, '2010-01-11 20:44:39', '0000-00-00 00:00:00', 16, 0),
(26, 'test', 'hallo welt', 17, 1, '2009-12-25 15:07:21', '0000-00-00 00:00:00', 17, 0),
(27, 'English', 'Swearwords', 18, 1, '2010-01-12 08:51:17', '0000-00-00 00:00:00', 18, 0),
(30, 'lehrer', 'prÃ¤sentation und so..', 16, 1, '2010-01-12 13:18:50', '0000-00-00 00:00:00', 16, 0),
(31, 'testset', 'ein beispiel', 16, 1, '2010-01-12 13:35:24', '0000-00-00 00:00:00', 16, 0),
(32, 'blaaa', '', 21, 1, '2012-02-13 12:31:25', '0000-00-00 00:00:00', 21, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(22) NOT NULL,
  `r_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`rid`, `role`, `r_admin`) VALUES
(1, 'admin', 0),
(2, 'normal', 0),
(6, 'blubb', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1026) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` date NOT NULL,
  `lastip` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `lastlogin`, `lastip`) VALUES
(16, 'test', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2009-11-27', '127.0.0.1'),
(17, 'kobi', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2009-12-25', '169.254.12.'),
(18, 'JT', 'a09f253d075dcc2b76d7bbcd21998fb6db6e1eeb9b7c87d58adb8fcae619e4751457f87f6a07a9e48de4882e35f51c5212bf15f78bc1984623d70b864e717dc8', '2010-01-12', '172.20.25.1'),
(19, 'gdfsg', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2010-02-23', '127.0.0.1'),
(20, 'test2', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2010-03-02', '127.0.0.1'),
(21, 'root', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', '2012-02-13', '127.0.0.1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_customfields`
--

CREATE TABLE IF NOT EXISTS `user_customfields` (
  `cf_id` int(16) NOT NULL AUTO_INCREMENT COMMENT 'id 4 customfields',
  `cf_uid` int(11) DEFAULT NULL,
  `cf_key` varchar(30) NOT NULL,
  `cf_value` text NOT NULL,
  PRIMARY KEY (`cf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user_customfields`
--

INSERT INTO `user_customfields` (`cf_id`, `cf_uid`, `cf_key`, `cf_value`) VALUES
(1, 16, 'fdsgsgsd', 'fsdgsdgfsgfdsg'),
(2, 16, 'mail', 'blub@blab.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `ur_uid` int(11) NOT NULL,
  `ur_rid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user_role`
--

INSERT INTO `user_role` (`ur_uid`, `ur_rid`) VALUES
(16, 6),
(17, 1),
(18, 1),
(19, 2),
(20, 1),
(21, 1);

-- --------------------------------------------------------



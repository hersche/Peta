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
-- Daten für Tabelle `fullquestionset`
--
-- in Benutzung (#1356 - View 'learncards.fullquestionset' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

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
-- Daten für Tabelle `question_set`
--


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



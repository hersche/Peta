-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. November 2009 um 20:44
-- Server Version: 5.1.41
-- PHP-Version: 5.2.11-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `learncards`
--

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `fullUser`
--
CREATE TABLE IF NOT EXISTS `fullUser` (
`id` int(11)
,`username` varchar(22)
,`password` varchar(22)
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
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(22) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`roleid`, `role`) VALUES
(1, 'admin');

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
(1, 1),
(2, 1),
(6, 1),
(7, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(22) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` date NOT NULL,
  `lastip` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `lastlogin`, `lastip`) VALUES
(1, 'test', 'test', '2009-11-24', '127.0.0.1'),
(2, 'blubb', 'blubb', '2009-11-18', '33'),
(3, 'test', 'testing', '2009-11-24', '127.0.0.1'),
(4, 'test', '3619bfe523bfdd5ad2f0ac', '2009-11-24', '127.0.0.1'),
(5, 'test', '3619bfe523bfdd5ad2f0ac', '2009-11-24', '127.0.0.1'),
(6, 'test', '3619bfe523bfdd5ad2f0ac', '2009-11-24', '127.0.0.1'),
(7, 'test', '3619bfe523bfdd5ad2f0ac', '2009-11-24', '127.0.0.1');

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
(2, 'blabla', 0, 0, 0, 0),
(6, '', 0, 0, 0, 0),
(7, 'test', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur des Views `fullUser`
--
DROP TABLE IF EXISTS `fullUser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `fullUser` AS select `users`.`id` AS `id`,`users`.`username` AS `username`,`users`.`password` AS `password`,`users`.`lastlogin` AS `lastlogin`,`users`.`lastip` AS `lastip`,`userrole`.`buserid` AS `buserid`,`userrole`.`broleid` AS `broleid`,`role`.`roleid` AS `roleid`,`role`.`role` AS `role`,`users_profile`.`user_profile_id` AS `user_profile_id`,`users_profile`.`name` AS `name`,`users_profile`.`schule` AS `schule`,`users_profile`.`klasse` AS `klasse`,`users_profile`.`mail` AS `mail`,`users_profile`.`hobbys` AS `hobbys` from (`users` join ((`userrole` join `role`) join `users_profile`) on(((`users`.`id` = `userrole`.`buserid`) and (`userrole`.`broleid` = `role`.`roleid`) and (`users`.`id` = `users_profile`.`user_profile_id`))));

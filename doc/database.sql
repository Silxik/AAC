-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Loomise aeg: Nov 10, 2015 kell 09:46 PL
-- Serveri versioon: 5.6.24
-- PHP versioon: 5.5.24

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Andmebaas: `aac`
--


-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `discussion_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(64) unsigned NOT NULL,
  `file_name` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(225) CHARACTER SET utf8 NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 NOT NULL,
  `profile_image` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email` varchar(225) CHARACTER SET utf8 NOT NULL,
  `birthday` date NOT NULL,
  `bio` text CHARACTER SET utf8 NOT NULL,
  `online` tinyint(1) NOT NULL,
  `location` varchar(200) NOT NULL,
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gender` tinyint(1) NOT NULL,
  `ip_joined` varchar(64) NOT NULL,
  `ip_last` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `userpost`
--

DROP TABLE IF EXISTS `userpost`;
CREATE TABLE IF NOT EXISTS `userpost` (
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `file_id` int(64) unsigned NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE IF NOT EXISTS `version` (
  `version_nr` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `discussion`
--
ALTER TABLE `discussion`
ADD PRIMARY KEY (`discussion_id`);

--
-- Indeksid tabelile `files`
--
ALTER TABLE `files`
ADD PRIMARY KEY (`file_id`);

--
-- Indeksid tabelile `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`user_id`);

--
-- Indeksid tabelile `userpost`
--
ALTER TABLE `userpost`
ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `discussion`
--
ALTER TABLE `discussion`
MODIFY `discussion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT tabelile `files`
--
ALTER TABLE `files`
MODIFY `file_id` int(64) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT tabelile `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT tabelile `userpost`
--
ALTER TABLE `userpost`
MODIFY `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;SET FOREIGN_KEY_CHECKS=1;
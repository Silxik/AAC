-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2016 at 07:06 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `aac`
--
CREATE DATABASE IF NOT EXISTS `aac` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aac`;

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

DROP TABLE IF EXISTS `discussion`;
CREATE TABLE IF NOT EXISTS `discussion` (
  `discussion_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_comments`
--

DROP TABLE IF EXISTS `discussion_comments`;
CREATE TABLE IF NOT EXISTS `discussion_comments` (
  `comment_id` int(10) unsigned NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(64) unsigned NOT NULL,
  `file_name` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
  `gender` varchar(6) NOT NULL,
  `ip_joined` varchar(64) NOT NULL,
  `ip_last` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userpost`
--

DROP TABLE IF EXISTS `userpost`;
CREATE TABLE IF NOT EXISTS `userpost` (
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `file_id` int(64) unsigned NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_code`
--

DROP TABLE IF EXISTS `user_code`;
CREATE TABLE IF NOT EXISTS `user_code` (
  `code_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `css_editor` text NOT NULL,
  `bg_img` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE IF NOT EXISTS `version` (
  `version_nr` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`discussion_id`);

--
-- Indexes for table `discussion_comments`
--
ALTER TABLE `discussion_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `userpost`
--
ALTER TABLE `userpost`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user_code`
--
ALTER TABLE `user_code`
  ADD PRIMARY KEY (`code_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `discussion_comments`
--
ALTER TABLE `discussion_comments`
  MODIFY `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(64) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `userpost`
--
ALTER TABLE `userpost`
  MODIFY `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user_code`
--
ALTER TABLE `user_code`
  MODIFY `code_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
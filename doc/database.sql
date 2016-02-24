-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2016 at 05:21 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `aac`
--
CREATE DATABASE IF NOT EXISTS `aac` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aac`;

-- --------------------------------------------------------

--
-- Table structure for table `adminmail`
--

DROP TABLE IF EXISTS `adminmail`;
CREATE TABLE IF NOT EXISTS `adminmail` (
  `mail_id` int(10) unsigned NOT NULL,
  `subject` tinytext NOT NULL,
  `message` text NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminmail`
--

INSERT INTO `adminmail` (`mail_id`, `subject`, `message`, `email`) VALUES
  (1, '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`discussion_id`, `user_id`, `file_id`, `title`, `text`, `date`) VALUES
  (1, 1, 1, 'Test', 'test', '2015-11-17 10:41:45'),
  (2, 1, 2, 'REALLY MUCH TEXT', 'REALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXTREALLY MUCH TEXT', '2015-11-17 10:45:05'),
  (3, 1, 3, 'New test', 'New test\r\nNew test\r\nNew test\r\nNew test\r\nNew test\r\nNew test\r\nNew test\r\nNew test\r\nvNew test', '2015-11-17 11:54:11'),
  (4, 1, 0, 'Test', 'Tesljhjlfsdrg', '2015-11-19 13:19:49'),
  (5, 1, 0, 'Test', 'teseteset', '2015-11-19 13:20:06'),
  (6, 1, 4, 'res', 'tesdf', '2015-11-19 13:24:49');

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

--
-- Dumping data for table `discussion_comments`
--

INSERT INTO `discussion_comments` (`comment_id`, `discussion_id`, `user_id`, `text`, `date`) VALUES
  (1, 1, 1, 'Test', '2016-01-25 23:29:58'),
  (2, 1, 1, 'Test', '2016-01-25 23:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(64) unsigned NOT NULL,
  `file_name` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_name`) VALUES
  (1, 'uploads/files/8c056c567c2de0953863d8c4bd7e60d0.jpeg'),
  (2, 'uploads/files/2014-10-26 13.21.58.jpg'),
  (3, 'uploads/files/7ad51e0c5b557a3d9d46bf0e4dfff9d3.png'),
  (4, 'uploads/files/2014-10-26 13.23.56.jpg'),
  (5, 'uploads/files/7ad51e0c5b557a3d9d46bf0e4dfff9d3.jpg'),
  (6, 'uploads/files/8c056c567c2de0953863d8c4bd7e60d0.jpeg');

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
  `gender` tinyint(1) NOT NULL,
  `ip_joined` varchar(64) NOT NULL,
  `ip_last` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `profile_image`, `email`, `birthday`, `bio`, `online`, `location`, `date_joined`, `gender`, `ip_joined`, `ip_last`) VALUES
  (1, 'Kurikutsu', '65066a6d5acad2e30a5228b3776ace34973518aa', 'uploads/avatars/Kurikutsu_avatar.jpg', '', '1994-05-12', 'Testtesttest', 1, 'Estonia', '2015-11-17 09:52:51', 0, '::1', '::1'),
  (2, 'Test', 'dddd5d7b474d2c78ebbb833789c4bfd721edf4bf', '', '', '0000-00-00', '', 1, '', '2016-01-26 07:15:51', 0, '::1', '::1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userpost`
--

INSERT INTO `userpost` (`post_id`, `user_id`, `text`, `file_id`, `post_date`) VALUES
  (1, 1, 'Test', 5, '2016-02-23 21:45:42'),
  (2, 1, 'New\r\nTest Huehuehuehuehue', 6, '2016-02-24 14:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE IF NOT EXISTS `version` (
  `version_nr` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`version_nr`) VALUES
  ('1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminmail`
--
ALTER TABLE `adminmail`
ADD PRIMARY KEY (`mail_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminmail`
--
ALTER TABLE `adminmail`
MODIFY `mail_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
MODIFY `discussion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `discussion_comments`
--
ALTER TABLE `discussion_comments`
MODIFY `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `file_id` int(64) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userpost`
--
ALTER TABLE `userpost`
MODIFY `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;SET FOREIGN_KEY_CHECKS=1;

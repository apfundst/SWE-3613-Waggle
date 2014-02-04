-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2014 at 11:17 PM
-- Server version: 5.5.33-31.1
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jsalvo_waggle`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `file_name_path` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `creator` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `file_id` (`file_id`),
  KEY `file_id_2` (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(1) NOT NULL AUTO_INCREMENT,
  `creator` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `group_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `group_description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_id_2` (`group_id`),
  UNIQUE KEY `group_name` (`group_name`),
  KEY `group_id` (`group_id`),
  KEY `group_id_3` (`group_id`),
  KEY `group_id_4` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `creator`, `group_name`, `group_description`, `date_created`) VALUES
(3, 'jcathcar@spsu.edu', 'Group 8 Waggle', NULL, '2014-01-31 04:17:29'),
(4, 'apfundst@spsu.edu', 'Le Herpes Derpes', NULL, '2014-01-31 06:26:38'),
(5, 'jcathcar@spsu.edu', 'Other Test group num', NULL, '2014-01-31 04:19:01'),
(6, 'jcathcar@spsu.edu', 'test', 'test', '2014-02-04 04:14:34'),
(8, 'apfundst@spsu.edu', 'this thing', 'this        \r\n        ', '2014-02-04 04:44:04'),
(11, 'jcathcar@spsu.edu', 'New Group', '        \r\n        this is a test', '2014-02-04 05:11:57'),
(12, 'apfundst@spsu.edu', 'SWE3613-programming', '        A group for SWE3613 stuff\r\n        ', '2014-02-04 05:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `group_id` int(11) NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `banned` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `group_id` (`group_id`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`group_id`, `email`, `banned`, `date_created`) VALUES
(3, 'jcathcar@spsu.edu', 0, '2014-01-31 04:20:20'),
(4, 'jcathcar@spsu.edu', 0, '2014-01-31 04:21:12'),
(5, 'jcathcar@spsu.edu', 0, '2014-01-31 04:21:12'),
(4, 'apfundst@spsu.edu', 0, '2014-01-31 04:28:16'),
(5, 'apfundst@spsu.edu', 0, '2014-01-31 04:28:16'),
(11, 'jcathcar@spsu.edu', 0, '2014-02-04 05:11:57'),
(12, 'apfundst@spsu.edu', 0, '2014-02-04 05:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `creator` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `message_text` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  UNIQUE KEY `message_id` (`message_id`),
  KEY `message_id_2` (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `thread_id`, `creator`, `message_text`, `date_created`) VALUES
(1, 2, 'jcathcar@spsu.edu', 'The persistence cont', '2014-01-31 08:22:57'),
(2, 3, 'jcathcar@spsu.edu', 'SPOIOOOBGSOIHGOIHJRE', '2014-01-31 08:23:08'),
(3, 2, 'jcathcar@spsu.edu', 'This better work', '2014-01-31 08:18:53'),
(4, 2, '', '        \r\n        yolo', '2014-01-31 08:44:41'),
(5, 2, '', '        \r\n        try again', '2014-01-31 08:45:04'),
(6, 2, '', 'Why is this not posting creator?        \r\n        ', '2014-01-31 08:45:34'),
(7, 2, '', '        \r\n        this', '2014-01-31 08:46:46'),
(8, 2, 'apfundst@spsu.edu', '        \r\n        this hsould work', '2014-01-31 08:47:31'),
(9, 2, 'apfundst@spsu.edu', '        \r\n        hkhdlkhd', '2014-01-31 08:47:56'),
(10, 2, 'apfundst@spsu.edu', '        \r\n        A textarea is an element on a webpage that you can type into. These are commonly used as commenting areas, contact forms or address entry areas. All browsers have defaults styles for textareas which vary. You can take control of your textareas and style them with CSS, just like any', '2014-01-31 08:48:20'),
(11, 2, 'jcathcar@spsu.edu', 'We have been doing this for eight hours! #no parents', '2014-01-31 08:48:29'),
(12, 5, 'apfundst@spsu.edu', '        \r\n        hello', '2014-01-31 08:57:30'),
(13, 4, 'apfundst@spsu.edu', '        \r\n        First!!!!!!', '2014-01-31 08:57:51'),
(14, 5, 'jcathcar@spsu.edu', '        \r\n        GOodboye', '2014-01-31 08:58:17'),
(15, 4, 'jcathcar@spsu.edu', '        \r\n        to get herpes', '2014-01-31 08:58:51'),
(16, 5, 'apfundst@spsu.edu', '        \r\n        is a good band\r\n', '2014-01-31 09:12:33'),
(17, 4, 'apfundst@spsu.edu', '        \r\n        Herp derp?', '2014-01-31 18:35:25'),
(18, 4, 'apfundst@spsu.edu', '        \r\n        Hello world!', '2014-01-31 18:36:10'),
(19, 4, 'apfundst@spsu.edu', '        \r\n        hey', '2014-02-03 18:03:07'),
(20, 4, 'apfundst@spsu.edu', '        \r\n        YOLO', '2014-02-03 18:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE IF NOT EXISTS `thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `creator` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`thread_id`),
  UNIQUE KEY `thread_id` (`thread_id`),
  KEY `thread_id_2` (`thread_id`),
  KEY `thread_id_3` (`thread_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`thread_id`, `group_id`, `creator`, `subject`, `date_created`) VALUES
(2, 3, 'jcathcar@spsu.edu', 'test thread', '2014-01-31 07:36:16'),
(3, 3, 'jcathcar@spsu.edu', 'The physics of bras', '2014-01-31 07:56:02'),
(4, 4, 'apfundst@spsu.edu', 'I like the computron', '2014-01-31 07:56:02'),
(5, 5, 'apfundst@spsu.edu', 'Poopie in the Pooty', '2014-01-31 07:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorized` tinyint(1) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='The "groups" section might need to be looked at?';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`, `first_name`, `last_name`, `authorized`, `student_id`) VALUES
('apfundst@spsu.edu', 'yerp', 'Andrew', 'Pfundstein', NULL, NULL),
('jcathcar@spsu.edu', 'derp', 'Justin', 'Cathcart', NULL, NULL),
('test@spsu.edu', 'test', 'Test', 'Le Test', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 24, 2024 at 11:12 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collab_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `cmt_reply`
--

DROP TABLE IF EXISTS `cmt_reply`;
CREATE TABLE IF NOT EXISTS `cmt_reply` (
  `cr_id` int NOT NULL,
  `cr_desc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cr_date` date NOT NULL,
  `cr_time` time NOT NULL,
  `cmt_id` int NOT NULL,
  `s_id` int DEFAULT NULL,
  `f_id` int DEFAULT NULL,
  PRIMARY KEY (`cr_id`),
  KEY `Students_ComReply` (`s_id`),
  KEY `Faculties_ComReply` (`f_id`),
  KEY `Comments_ComReply` (`cmt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cmt_reply`
--

INSERT INTO `cmt_reply` (`cr_id`, `cr_desc`, `cr_date`, `cr_time`, `cmt_id`, `s_id`, `f_id`) VALUES
(123001, 'Absolutely', '2024-02-17', '00:12:46', 9001001, 1003006, NULL),
(123002, 'Absolutely', '2024-02-23', '14:12:46', 9001002, 1003006, NULL),
(123003, 'Absolutely', '2024-02-17', '00:12:46', 9001005, 1003005, NULL),
(123004, 'Absolutely', '2024-02-23', '14:12:46', 9001004, 1003005, NULL),
(123005, 'Absolutely', '2024-02-17', '00:12:46', 9001005, 1003008, NULL),
(123006, 'Absolutely', '2024-02-23', '14:12:46', 9001006, 1003010, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cmt_vote`
--

DROP TABLE IF EXISTS `cmt_vote`;
CREATE TABLE IF NOT EXISTS `cmt_vote` (
  `cmt_id` int DEFAULT NULL,
  `cmtr_id` int DEFAULT NULL,
  `s_id` int DEFAULT NULL,
  `f_id` int DEFAULT NULL,
  `is_upvote` tinyint(1) NOT NULL,
  KEY `CmtVote_Comments` (`cmt_id`),
  KEY `CmtVote_CmtReply` (`cmtr_id`),
  KEY `ComVote_Students` (`s_id`),
  KEY `ComVote_Faculties` (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cmt_vote`
--

INSERT INTO `cmt_vote` (`cmt_id`, `cmtr_id`, `s_id`, `f_id`, `is_upvote`) VALUES
(9001001, NULL, 1003004, NULL, 1),
(NULL, 123002, 1003007, NULL, 1),
(9001007, NULL, NULL, 2003004, 1),
(NULL, NULL, NULL, NULL, 0),
(9001007, 123004, 1003005, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `collab`
--

DROP TABLE IF EXISTS `collab`;
CREATE TABLE IF NOT EXISTS `collab` (
  `c_id` int NOT NULL,
  `c_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_pic` blob,
  `c_start` datetime NOT NULL,
  `c_city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `c_desc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_id` int NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `Collab_Students` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collab`
--

INSERT INTO `collab` (`c_id`, `c_name`, `c_pic`, `c_start`, `c_city`, `c_desc`, `s_id`) VALUES
(7003001, 'Gathering for gate', NULL, '2024-02-22 04:20:37', 'Bhavnagar', 'Here we are going to solve PYQs', 1003001),
(7003002, 'Interview practice', NULL, '2024-02-22 04:20:37', 'Ahmedabad', 'Here we are going to conduct expert talk on interview skills', 1003003),
(7003003, 'Gathering for gate', NULL, '2024-02-22 04:26:08', 'Bhavnagar', '', 1003003),
(7003004, 'Expert talk', NULL, '2024-02-22 04:26:08', 'Patan', 'Expert talk on dsa', 1003005),
(7003005, 'Java studies', NULL, '2024-02-22 04:24:31', 'Mahesana', 'Here we are going to solve some problems using java and teach it', 1003005),
(7003006, 'Expert talk', NULL, '2024-02-22 04:24:31', 'Patan', 'Expert talk on block chain and its scope', 1003006);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `cmt_id` int NOT NULL,
  `cmt_desc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cmt_rating` tinyint NOT NULL,
  `cmt_date` date NOT NULL,
  `cmt_time` time NOT NULL,
  `c_id` int DEFAULT NULL,
  `e_id` int DEFAULT NULL,
  `s_id` int DEFAULT NULL,
  `f_id` int DEFAULT NULL,
  PRIMARY KEY (`cmt_id`),
  KEY `Collab_Comments` (`c_id`),
  KEY `Events_Comments` (`e_id`),
  KEY `Students_Comments` (`s_id`),
  KEY `Faculties_Comments` (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cmt_id`, `cmt_desc`, `cmt_rating`, `cmt_date`, `cmt_time`, `c_id`, `e_id`, `s_id`, `f_id`) VALUES
(9001001, 'Fabulous', 5, '2024-02-23', '14:07:17', NULL, 8001003, 1003001, NULL),
(9001002, 'Good', 4, '2024-02-16', '06:07:17', 7003002, NULL, 1003003, NULL),
(9001003, 'Fabulous', 5, '2024-02-23', '14:07:17', NULL, 8001004, 1003005, NULL),
(9001004, 'Good', 4, '2024-02-16', '06:07:17', 7003005, NULL, 1003007, NULL),
(9001005, 'Fabulous', 5, '2024-02-23', '14:07:17', NULL, 8001001, NULL, 2003003),
(9001006, 'Good', 4, '2024-02-16', '06:07:17', 7003003, NULL, 1003004, NULL),
(9001007, 'Fabulous', 5, '2024-02-23', '14:07:17', NULL, 8001003, NULL, 2003004),
(9001008, 'Good', 4, '2024-02-16', '06:07:17', 7003003, NULL, 1003003, NULL),
(9001009, 'Fabulous', 5, '2024-02-23', '14:07:17', NULL, 8001003, NULL, 2003004),
(9001010, 'Good', 4, '2024-02-16', '06:07:17', 7003004, NULL, 1003008, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `e_id` int NOT NULL,
  `e_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `e_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `e_pic` blob,
  `e_desc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `e_start` datetime NOT NULL,
  `e_end` datetime NOT NULL,
  `e_loc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prize1` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prize2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prize3` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `e_min` tinyint DEFAULT NULL,
  `e_max` tinyint DEFAULT NULL,
  `want_reg` tinyint(1) NOT NULL,
  `is_big` tinyint(1) NOT NULL,
  `f_id` int NOT NULL,
  PRIMARY KEY (`e_id`),
  KEY `Event_Faculty` (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`e_id`, `e_name`, `e_type`, `e_pic`, `e_desc`, `e_start`, `e_end`, `e_loc`, `prize1`, `prize2`, `prize3`, `e_min`, `e_max`, `want_reg`, `is_big`, `f_id`) VALUES
(8001001, 'Hack It Up', 'Hackathon', NULL, 'Biggest hackathon in India', '2024-02-22 04:30:35', '2024-02-22 04:30:35', 'Ahmedabad', '100000', '20000', '5000', 2, 6, 1, 1, 2003001),
(8001002, 'Walk A Mile', 'Walkathon', NULL, 'We are going to conduct a walkathon for environmental issues.', '2024-02-22 04:30:35', '2024-02-22 04:30:35', 'Patan', NULL, NULL, NULL, NULL, NULL, 1, 0, 2003002),
(8001003, 'Let\'s Do It', 'Adios', NULL, 'It is a college festival of our collage.\r\nHere we are going to conduct many competitions', '2024-02-22 04:34:03', '2024-02-22 04:34:03', 'Bhavnagar', '10000', '5000', '4000', NULL, NULL, 1, 0, 2003003),
(8001004, 'Fit India', 'Cyclothon', NULL, '', '2024-02-22 04:34:03', '2024-02-22 04:34:03', 'Patan', NULL, NULL, NULL, NULL, NULL, 1, 0, 2003005);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
CREATE TABLE IF NOT EXISTS `faculties` (
  `f_id` int NOT NULL,
  `f_pass` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `f_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `f_state` varchar(20) NOT NULL,
  `f_city` varchar(20) NOT NULL,
  `f_pic` blob,
  `f_email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `f_mob` bigint NOT NULL,
  `f_inst` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `f_dep` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `f_post` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `f_desc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`f_id`, `f_pass`, `f_name`, `f_state`, `f_city`, `f_pic`, `f_email`, `f_mob`, `f_inst`, `f_dep`, `f_post`, `f_desc`) VALUES
(2003001, 'Anilp@001', 'Anil', '', '', NULL, 'Anilp001@gmail.com', 1596741236, 'L.E., Morbi', 'Computer', 'Professor', 'Hi I am Anil.'),
(2003002, 'Rajesh@002', 'Rajesh', '', '', NULL, 'Rajeshp002@gmail.com', 8596747845, 'GEC, Bhavnagar', 'Mechnical', 'Assi.Prof', 'Hi I am Rajesh.'),
(2003003, 'Mohanp@003', 'Mohan', '', '', NULL, 'Mohanp003@gmail.com', 7845126598, 'GEC, Patan', 'Computer', 'Assi.Prof', 'Hi I am Mohan.'),
(2003004, 'Nitishp@004', 'Nitish', '', '', NULL, 'Nitishp004@gmail.com', 7845126545, 'GEC, Patan', 'Computer', 'Professor', 'Hi I am Nitish.'),
(2003005, 'Kishorp@005', 'Kishor', '', '', NULL, 'Kishorp005@gmail.com', 8545126545, 'L.D. Institute', 'Computer', 'HOD', 'Hi I am Kishor.');

-- --------------------------------------------------------

--
-- Table structure for table `involved`
--

DROP TABLE IF EXISTS `involved`;
CREATE TABLE IF NOT EXISTS `involved` (
  `c_id` int NOT NULL,
  `s_id` int NOT NULL,
  KEY `Collab_Involved` (`c_id`),
  KEY `Students_Involved` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `involved`
--

INSERT INTO `involved` (`c_id`, `s_id`) VALUES
(7003002, 1003001),
(7003002, 1003005),
(7003003, 1003002),
(7003003, 1003004),
(7003005, 1003008),
(7003005, 1003007),
(7003006, 1003006),
(7003006, 1003010),
(7003004, 1003006),
(7003004, 1003005);

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `i_id` int NOT NULL,
  `i_title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `i_city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `i_desc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `i_date` date NOT NULL,
  `i_time` time NOT NULL,
  `s_id` int NOT NULL,
  PRIMARY KEY (`i_id`),
  KEY `Students_Issues` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`i_id`, `i_title`, `i_city`, `i_desc`, `i_date`, `i_time`, `s_id`) VALUES
(5003001, 'Bhojan', 'Bhavnagar', 'Bhojan ke liye achhi jagah suggest kare', '2024-02-06', '27:37:15', 1003001),
(5003002, 'Suggest Course', 'Ahmedabad', 'Which should i opt dsa or webdev', '2024-02-05', '17:39:02', 1003002),
(5003003, 'Book Review', 'Ahmedabad', 'Is R.D. Sharma good for maths ?', '2024-02-06', '27:37:15', 1003003),
(5003004, 'Suggest Book', 'Ahmedabad', 'Suggest book for java', '2024-02-05', '17:39:02', 1003004);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `s_id` int NOT NULL,
  `t_id` int NOT NULL,
  `is_leader` tinyint(1) NOT NULL,
  KEY `Team_Members` (`t_id`),
  KEY `Student_Members` (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`s_id`, `t_id`, `is_leader`) VALUES
(1003001, 3003004, 1),
(1003002, 3003004, 0),
(1003003, 3003005, 1),
(1003004, 3003005, 0),
(1003005, 3003001, 1),
(1003006, 3003001, 0),
(1003007, 3003002, 1),
(1003008, 3003002, 0),
(1003009, 3003003, 1),
(1003010, 3003003, 0);

-- --------------------------------------------------------

--
-- Table structure for table `participates`
--

DROP TABLE IF EXISTS `participates`;
CREATE TABLE IF NOT EXISTS `participates` (
  `s_id` int NOT NULL,
  `e_id` int NOT NULL,
  KEY `s_id` (`s_id`),
  KEY `e_id` (`e_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

DROP TABLE IF EXISTS `solutions`;
CREATE TABLE IF NOT EXISTS `solutions` (
  `sol_id` int NOT NULL,
  `sol_desc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sol_date` date NOT NULL,
  `sol_time` time NOT NULL,
  `i_id` int NOT NULL,
  `s_id` int DEFAULT NULL,
  `f_id` int DEFAULT NULL,
  PRIMARY KEY (`sol_id`),
  KEY `Solutions_Students` (`s_id`),
  KEY `Solutions_Faculties` (`f_id`),
  KEY `Issues_Solutions` (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`sol_id`, `sol_desc`, `sol_date`, `sol_time`, `i_id`, `s_id`, `f_id`) VALUES
(6003001, 'Mahalakshmi Canteen', '2024-02-16', '21:42:51', 5003001, 1003006, NULL),
(6003002, 'Vishala near uni ground', '2024-02-08', '08:42:51', 5003001, 1003008, NULL),
(6003003, 'You should opt Webdev', '2024-02-16', '21:42:51', 5003002, 1003008, NULL),
(6003004, 'You should opt DSA', '2024-02-08', '08:42:51', 5003002, 1003009, NULL),
(6003005, 'Yes', '2024-02-09', '12:46:06', 5003003, 1003009, NULL),
(6003006, 'No', '2024-02-15', '09:46:06', 5003003, 1003010, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sol_vote`
--

DROP TABLE IF EXISTS `sol_vote`;
CREATE TABLE IF NOT EXISTS `sol_vote` (
  `sol_id` int NOT NULL,
  `s_id` int DEFAULT NULL,
  `f_id` int DEFAULT NULL,
  `is_upvote` tinyint(1) NOT NULL,
  KEY `Solution_SolVote` (`sol_id`),
  KEY `SolVote_Students` (`s_id`),
  KEY `SolVote_Faculties` (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sol_vote`
--

INSERT INTO `sol_vote` (`sol_id`, `s_id`, `f_id`, `is_upvote`) VALUES
(6003001, 1003002, NULL, 1),
(6003002, 1003003, NULL, 1),
(6003005, 1003003, NULL, 1),
(6003006, 1003004, NULL, 0),
(6003003, NULL, 2003001, 1),
(6003004, NULL, 2003003, 1),
(6003003, 1003006, NULL, 1),
(6003004, 1003007, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `s_id` int NOT NULL,
  `s_pass` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_state` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `s_city` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `s_pic` blob,
  `s_email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_mob` bigint NOT NULL,
  `s_inst` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_course` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `s_dep` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `s_sem` tinyint NOT NULL,
  `s_desc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `s_pass`, `s_name`, `s_state`, `s_city`, `s_pic`, `s_email`, `s_mob`, `s_inst`, `s_course`, `s_dep`, `s_sem`, `s_desc`) VALUES
(1003001, 'Aakash@001', 'Aakash', NULL, '', NULL, 'Aakash001@gmail.com', 1234567890, 'L.D. Patel Institute', 'BE', 'Computer Eng.', 2, 'Hi I am Aakash.'),
(1003002, 'Binal@002', 'Binal', NULL, '', NULL, 'Binal002@gmail.com', 1234567891, 'B.P.T.I.', 'BE', 'Information Eng.', 4, 'Hi I am Binal.'),
(1003003, 'Better@003', 'Better', NULL, '', NULL, 'Better003@gmail.com', 1234567892, 'B.P.T.I.', 'Diploma', 'Information Eng.', 4, 'Hi I am Better.'),
(1003004, 'Dipak@004', 'Dipak', NULL, '', NULL, 'Dipak004@gmail.com', 1234567893, 'L.E., Morbi', 'BE', 'Information Eng.', 5, 'Hi I am Dipak.'),
(1003005, 'Fenil@005', 'Fenil', NULL, '', NULL, 'Fenil005@gmail.com', 1234567894, 'L.E., Morbi', 'BE', 'Computer Eng.', 5, NULL),
(1003006, 'Gunjan@006', 'Gunjan', NULL, '', NULL, 'Gunjan006@gmail.com', 1234567895, 'GEC, Bhavnagar', 'BE', 'Computer Eng.', 5, 'Hi I am Gunjan.'),
(1003007, 'Hina@007', 'Hina', NULL, '', NULL, 'Hina007@gmail.com', 1234567896, 'GEC, Bhavnagar', 'BE', 'I.T. Eng.', 3, 'Hi I am Hina.'),
(1003008, 'Karan@008', 'Karan', NULL, '', NULL, 'Karan008@gmail.com', 1234568922, 'B.P.T.I.', 'BE', 'I.T. Eng.', 3, 'Hi I am Karan.'),
(1003009, 'Meet@009', 'Meet', NULL, '', NULL, 'Meet009@gmail.com', 1234568927, 'L.D. Patel Institute', 'BE', 'Computer Eng.', 3, 'Hi I am Meet.'),
(1003010, 'Nischay@010', 'Nischay', NULL, '', NULL, 'Nischay010@gmail.com', 2045967814, 'L.E., Morbi', 'BE', 'Computer Eng.', 7, 'Hi I am Nischay.');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `t_id` int NOT NULL,
  `t_proj` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `t_pic` blob,
  `t_desc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `f_id` int DEFAULT NULL,
  `e_id` int DEFAULT NULL,
  PRIMARY KEY (`t_id`),
  KEY `Team_Student` (`f_id`),
  KEY `e_id` (`e_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`t_id`, `t_proj`, `t_pic`, `t_desc`, `f_id`, `e_id`) VALUES
(3003001, 'Hackathon ', NULL, 'Best Team Ever', 2003001, 8001001),
(3003002, 'Hackathon Nirm ', NULL, 'Best Team Ever Exist', 2003005, 8001001),
(3003003, 'Hackathon Nirmala', NULL, 'Best Team Exist Now', 2003004, 8001001),
(3003004, 'Expense Tracker', NULL, 'Our project is to make expense tracker.', 2003003, 8001001),
(3003005, 'Garbage Manager', NULL, 'Our project is to make a system which detects the level of garbage and inform us.', 2003004, 8001001);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cmt_reply`
--
ALTER TABLE `cmt_reply`
  ADD CONSTRAINT `Comments_ComReply` FOREIGN KEY (`cmt_id`) REFERENCES `comments` (`cmt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Faculties_ComReply` FOREIGN KEY (`f_id`) REFERENCES `faculties` (`f_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Students_ComReply` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cmt_vote`
--
ALTER TABLE `cmt_vote`
  ADD CONSTRAINT `CmtVote_CmtReply` FOREIGN KEY (`cmtr_id`) REFERENCES `cmt_reply` (`cr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CmtVote_Comments` FOREIGN KEY (`cmt_id`) REFERENCES `comments` (`cmt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ComVote_Faculties` FOREIGN KEY (`f_id`) REFERENCES `faculties` (`f_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ComVote_Students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `collab`
--
ALTER TABLE `collab`
  ADD CONSTRAINT `Collab_Students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Collab_Comments` FOREIGN KEY (`c_id`) REFERENCES `collab` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Events_Comments` FOREIGN KEY (`e_id`) REFERENCES `events` (`e_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Faculties_Comments` FOREIGN KEY (`f_id`) REFERENCES `faculties` (`f_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Students_Comments` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `Event_Faculty` FOREIGN KEY (`f_id`) REFERENCES `faculties` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `involved`
--
ALTER TABLE `involved`
  ADD CONSTRAINT `Collab_Involved` FOREIGN KEY (`c_id`) REFERENCES `collab` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Students_Involved` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `Students_Issues` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `Student_Members` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Team_Members` FOREIGN KEY (`t_id`) REFERENCES `teams` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participates`
--
ALTER TABLE `participates`
  ADD CONSTRAINT `By` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `In` FOREIGN KEY (`e_id`) REFERENCES `events` (`e_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `Issues_Solutions` FOREIGN KEY (`i_id`) REFERENCES `issues` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Solutions_Faculties` FOREIGN KEY (`f_id`) REFERENCES `faculties` (`f_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Solutions_Students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sol_vote`
--
ALTER TABLE `sol_vote`
  ADD CONSTRAINT `Solution_SolVote` FOREIGN KEY (`sol_id`) REFERENCES `solutions` (`sol_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SolVote_Faculties` FOREIGN KEY (`f_id`) REFERENCES `faculties` (`f_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `SolVote_Students` FOREIGN KEY (`s_id`) REFERENCES `students` (`s_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `BigEvent` FOREIGN KEY (`e_id`) REFERENCES `events` (`e_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Guides` FOREIGN KEY (`f_id`) REFERENCES `faculties` (`f_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

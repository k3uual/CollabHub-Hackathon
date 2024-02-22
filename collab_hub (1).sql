-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2024 at 07:35 AM
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
  `Cmtr_id` int NOT NULL,
  `Cmtr_desc` varchar(50) NOT NULL,
  `Cmtr_date` date NOT NULL,
  `Cmtr_time` time NOT NULL,
  `Cmt_id` int NOT NULL,
  `S_id` int DEFAULT NULL,
  `F_id` int DEFAULT NULL,
  PRIMARY KEY (`Cmtr_id`),
  KEY `Students_ComReply` (`S_id`),
  KEY `Faculties_ComReply` (`F_id`),
  KEY `Comments_ComReply` (`Cmt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cmt_reply`
--

INSERT INTO `cmt_reply` (`Cmtr_id`, `Cmtr_desc`, `Cmtr_date`, `Cmtr_time`, `Cmt_id`, `S_id`, `F_id`) VALUES
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
  `Cmt_id` int DEFAULT NULL,
  `Cmtr_id` int DEFAULT NULL,
  `S_id` int DEFAULT NULL,
  `F_id` int DEFAULT NULL,
  `Is_upvote` tinyint(1) NOT NULL,
  KEY `CmtVote_Comments` (`Cmt_id`),
  KEY `CmtVote_CmtReply` (`Cmtr_id`),
  KEY `ComVote_Students` (`S_id`),
  KEY `ComVote_Faculties` (`F_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cmt_vote`
--

INSERT INTO `cmt_vote` (`Cmt_id`, `Cmtr_id`, `S_id`, `F_id`, `Is_upvote`) VALUES
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
  `C_id` int NOT NULL,
  `C_name` varchar(20) NOT NULL,
  `C_pic` blob,
  `C_date_time` datetime NOT NULL,
  `C_city` varchar(20) NOT NULL,
  `C_desc` varchar(100) NOT NULL,
  `S_id` int NOT NULL,
  PRIMARY KEY (`C_id`),
  KEY `Collab_Students` (`S_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collab`
--

INSERT INTO `collab` (`C_id`, `C_name`, `C_pic`, `C_date_time`, `C_city`, `C_desc`, `S_id`) VALUES
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
  `Cmt_id` int NOT NULL,
  `Cmt_desc` varchar(50) NOT NULL,
  `Cmt_rating` tinyint NOT NULL,
  `Cmt_date` date NOT NULL,
  `Cmt_time` time NOT NULL,
  `C_id` int DEFAULT NULL,
  `E_id` int DEFAULT NULL,
  `S_id` int DEFAULT NULL,
  `F_id` int DEFAULT NULL,
  PRIMARY KEY (`Cmt_id`),
  KEY `Collab_Comments` (`C_id`),
  KEY `Events_Comments` (`E_id`),
  KEY `Students_Comments` (`S_id`),
  KEY `Faculties_Comments` (`F_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Cmt_id`, `Cmt_desc`, `Cmt_rating`, `Cmt_date`, `Cmt_time`, `C_id`, `E_id`, `S_id`, `F_id`) VALUES
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
  `E_id` int NOT NULL,
  `E_name` varchar(20) NOT NULL,
  `E_pic` blob,
  `E_desc` varchar(100) NOT NULL,
  `E_sta_date_time` datetime NOT NULL,
  `E_end_date_time` datetime NOT NULL,
  `E_loc` varchar(20) NOT NULL,
  `E_prize1` varchar(20) DEFAULT NULL,
  `E_prize2` varchar(20) DEFAULT NULL,
  `E_prize3` varchar(20) DEFAULT NULL,
  `E_min` tinyint DEFAULT NULL,
  `E_max` tinyint DEFAULT NULL,
  `want_reg` tinyint(1) NOT NULL,
  `Is_big` tinyint(1) NOT NULL,
  `F_id` int NOT NULL,
  PRIMARY KEY (`E_id`),
  KEY `Event_Faculty` (`F_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`E_id`, `E_name`, `E_pic`, `E_desc`, `E_sta_date_time`, `E_end_date_time`, `E_loc`, `E_prize1`, `E_prize2`, `E_prize3`, `E_min`, `E_max`, `want_reg`, `Is_big`, `F_id`) VALUES
(8001001, 'Hackathon', NULL, 'Biggest hackathon in India', '2024-02-22 04:30:35', '2024-02-22 04:30:35', 'Ahmedabad', '100000', '20000', '5000', 2, 6, 1, 1, 2003001),
(8001002, 'Walkathon', NULL, 'We are going to conduct a walkathon for environmental issues.', '2024-02-22 04:30:35', '2024-02-22 04:30:35', 'Patan', NULL, NULL, NULL, NULL, NULL, 1, 0, 2003002),
(8001003, 'Adios', NULL, 'It is a collage festival of our collage.\r\nHere we are going to conduct many competitions', '2024-02-22 04:34:03', '2024-02-22 04:34:03', 'Bhavnagar', '10000', '5000', '4000', NULL, NULL, 1, 0, 2003003),
(8001004, 'Cyclothon', NULL, '', '2024-02-22 04:34:03', '2024-02-22 04:34:03', 'Patan', NULL, NULL, NULL, NULL, NULL, 1, 0, 2003005);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
CREATE TABLE IF NOT EXISTS `faculties` (
  `F_id` int NOT NULL,
  `F_password` varchar(20) NOT NULL,
  `F_name` varchar(20) NOT NULL,
  `F_pic` blob,
  `F_email` varchar(20) NOT NULL,
  `F_mob` bigint NOT NULL,
  `F_inst` varchar(20) NOT NULL,
  `F_dep` varchar(20) NOT NULL,
  `F_post` varchar(20) NOT NULL,
  `F_desc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`F_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`F_id`, `F_password`, `F_name`, `F_pic`, `F_email`, `F_mob`, `F_inst`, `F_dep`, `F_post`, `F_desc`) VALUES
(2003001, 'Anilp@001', 'Anil', NULL, 'Anilp001@gmail.com', 1596741236, 'L.E., Morbi', 'Computer', 'Professor', 'Hi I am Anil.'),
(2003002, 'Rajesh@002', 'Rajesh', NULL, 'Rajeshp002@gmail.com', 8596747845, 'GEC, Bhavnagar', 'Mechnical', 'Assi.Prof', 'Hi I am Rajesh.'),
(2003003, 'Mohanp@003', 'Mohan', NULL, 'Mohanp003@gmail.com', 7845126598, 'GEC, Patan', 'Computer', 'Assi.Prof', 'Hi I am Mohan.'),
(2003004, 'Nitishp@004', 'Nitish', NULL, 'Nitishp004@gmail.com', 7845126545, 'GEC, Patan', 'Computer', 'Professor', 'Hi I am Nitish.'),
(2003005, 'Kishorp@005', 'Kishor', NULL, 'Kishorp005@gmail.com', 8545126545, 'L.D. Institute', 'Computer', 'HOD', 'Hi I am Kishor.');

-- --------------------------------------------------------

--
-- Table structure for table `involved`
--

DROP TABLE IF EXISTS `involved`;
CREATE TABLE IF NOT EXISTS `involved` (
  `C_id` int NOT NULL,
  `S_id` int NOT NULL,
  KEY `Collab_Involved` (`C_id`),
  KEY `Students_Involved` (`S_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `involved`
--

INSERT INTO `involved` (`C_id`, `S_id`) VALUES
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
  `I_id` int NOT NULL,
  `I_title` varchar(20) NOT NULL,
  `I_city` varchar(20) DEFAULT NULL,
  `I_desc` varchar(50) NOT NULL,
  `I_date` date NOT NULL,
  `I_time` time NOT NULL,
  `S_id` int NOT NULL,
  PRIMARY KEY (`I_id`),
  KEY `Students_Issues` (`S_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`I_id`, `I_title`, `I_city`, `I_desc`, `I_date`, `I_time`, `S_id`) VALUES
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
  `S_id` int NOT NULL,
  `T_id` int NOT NULL,
  `Is_leader` tinyint(1) NOT NULL,
  KEY `Team_Members` (`T_id`),
  KEY `Student_Members` (`S_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`S_id`, `T_id`, `Is_leader`) VALUES
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
-- Table structure for table `solutions`
--

DROP TABLE IF EXISTS `solutions`;
CREATE TABLE IF NOT EXISTS `solutions` (
  `Sol_id` int NOT NULL,
  `Sol_desc` varchar(100) NOT NULL,
  `Sol_date` date NOT NULL,
  `Sol_time` time NOT NULL,
  `I_id` int NOT NULL,
  `S_id` int DEFAULT NULL,
  `F_id` int DEFAULT NULL,
  PRIMARY KEY (`Sol_id`),
  KEY `Solutions_Students` (`S_id`),
  KEY `Solutions_Faculties` (`F_id`),
  KEY `Issues_Solutions` (`I_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`Sol_id`, `Sol_desc`, `Sol_date`, `Sol_time`, `I_id`, `S_id`, `F_id`) VALUES
(6003001, 'Mahalakshmi Canteen', '2024-02-16', '21:42:51', 5003001, 1003006, NULL),
(6003002, 'Vishala near uni ground', '2024-02-08', '08:42:51', 5003001, 1003008, NULL),
(6003003, 'You nshold opt Webdev', '2024-02-16', '21:42:51', 5003002, 1003008, NULL),
(6003004, 'You should opt DSA', '2024-02-08', '08:42:51', 5003002, 1003009, NULL),
(6003005, 'Yes', '2024-02-09', '12:46:06', 5003003, 1003009, NULL),
(6003006, 'No', '2024-02-15', '09:46:06', 5003003, 1003010, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sol_vote`
--

DROP TABLE IF EXISTS `sol_vote`;
CREATE TABLE IF NOT EXISTS `sol_vote` (
  `Sol_id` int NOT NULL,
  `S_id` int DEFAULT NULL,
  `F_id` int DEFAULT NULL,
  `Is_upvote` tinyint(1) NOT NULL,
  KEY `Solution_SolVote` (`Sol_id`),
  KEY `SolVote_Students` (`S_id`),
  KEY `SolVote_Faculties` (`F_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sol_vote`
--

INSERT INTO `sol_vote` (`Sol_id`, `S_id`, `F_id`, `Is_upvote`) VALUES
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
  `S_id` int NOT NULL,
  `S_password` varchar(20) NOT NULL,
  `S_name` varchar(20) NOT NULL,
  `S_pic` blob,
  `S_email` varchar(20) NOT NULL,
  `S_mob` bigint NOT NULL,
  `S_inst` varchar(20) NOT NULL,
  `S_course` varchar(20) NOT NULL,
  `S_dep` varchar(20) DEFAULT NULL,
  `S_sem` tinyint NOT NULL,
  `S_desc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`S_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`S_id`, `S_password`, `S_name`, `S_pic`, `S_email`, `S_mob`, `S_inst`, `S_course`, `S_dep`, `S_sem`, `S_desc`) VALUES
(1003001, 'Aakash@001', 'Aakash', NULL, 'Aakash001@gmail.com', 1234567890, 'L.D. Patel Institute', 'BE', 'Computer Eng.', 2, 'Hi I am Aakash.'),
(1003002, 'Binal@002', 'Binal', NULL, 'Binal002@gmail.com', 1234567891, 'B.P.T.I.', 'BE', 'Information Eng.', 4, 'Hi I am Binal.'),
(1003003, 'Chaman@003', 'Chaman', NULL, 'Chaman003@gmail.com', 1234567892, 'B.P.T.I.', 'Diploma', 'Information Eng.', 4, 'Hi I am Chaman.'),
(1003004, 'Dipak@004', 'Dipak', NULL, 'Dipak004@gmail.com', 1234567893, 'L.E., Morbi', 'BE', 'Information Eng.', 5, 'Hi I am Dipak.'),
(1003005, 'Fenil@005', 'Fenil', NULL, 'Fenil005@gmail.com', 1234567894, 'L.E., Morbi', 'BE', 'Computer Eng.', 5, NULL),
(1003006, 'Gunjan@006', 'Gunjan', NULL, 'Gunjan006@gmail.com', 1234567895, 'GEC, Bhavnagar', 'BE', 'Computer Eng.', 5, 'Hi I am Gunjan.'),
(1003007, 'Hina@007', 'Hina', NULL, 'Hina007@gmail.com', 1234567896, 'GEC, Bhavnagar', 'BE', 'I.T. Eng.', 3, 'Hi I am Hina.'),
(1003008, 'Karan@008', 'Karan', NULL, 'Karan008@gmail.com', 1234568922, 'B.P.T.I.', 'BE', 'I.T. Eng.', 3, 'Hi I am Karan.'),
(1003009, 'Meet@009', 'Meet', NULL, 'Meet009@gmail.com', 1234568927, 'L.D. Patel Institute', 'BE', 'Computer Eng.', 3, 'Hi I am Meet.'),
(1003010, 'Nischay@010', 'Nischay', NULL, 'Nischay010@gmail.com', 2045967814, 'L.E., Morbi', 'BE', 'Computer Eng.', 7, 'Hi I am Nischay.');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `T_id` int NOT NULL,
  `T_proj` varchar(20) NOT NULL,
  `T_pic` blob,
  `T_desc` varchar(100) DEFAULT NULL,
  `F_id` int DEFAULT NULL,
  PRIMARY KEY (`T_id`),
  KEY `Team_Student` (`F_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`T_id`, `T_proj`, `T_pic`, `T_desc`, `F_id`) VALUES
(3003001, 'Hackathon ', NULL, 'Best Team Ever', 2003001),
(3003002, 'Hackathon Nirm ', NULL, 'Best Team Ever Exist', 2003005),
(3003003, 'Hackathon Nirmala', NULL, 'Best Team Exist Now', 2003004),
(3003004, 'Expense Tracker', NULL, 'Our project is to make expense tracker.', 2003003),
(3003005, 'Garbage Manager', NULL, 'Our project is to make a system which detects the level of garbage and inform us.', 2003004);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cmt_reply`
--
ALTER TABLE `cmt_reply`
  ADD CONSTRAINT `Comments_ComReply` FOREIGN KEY (`Cmt_id`) REFERENCES `comments` (`Cmt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Faculties_ComReply` FOREIGN KEY (`F_id`) REFERENCES `faculties` (`F_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Students_ComReply` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cmt_vote`
--
ALTER TABLE `cmt_vote`
  ADD CONSTRAINT `CmtVote_CmtReply` FOREIGN KEY (`Cmtr_id`) REFERENCES `cmt_reply` (`Cmtr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CmtVote_Comments` FOREIGN KEY (`Cmt_id`) REFERENCES `comments` (`Cmt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ComVote_Faculties` FOREIGN KEY (`F_id`) REFERENCES `faculties` (`F_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ComVote_Students` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `collab`
--
ALTER TABLE `collab`
  ADD CONSTRAINT `Collab_Students` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Collab_Comments` FOREIGN KEY (`C_id`) REFERENCES `collab` (`C_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Events_Comments` FOREIGN KEY (`E_id`) REFERENCES `events` (`E_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Faculties_Comments` FOREIGN KEY (`F_id`) REFERENCES `faculties` (`F_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Students_Comments` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `Event_Faculty` FOREIGN KEY (`F_id`) REFERENCES `faculties` (`F_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `involved`
--
ALTER TABLE `involved`
  ADD CONSTRAINT `Collab_Involved` FOREIGN KEY (`C_id`) REFERENCES `collab` (`C_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Students_Involved` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `Students_Issues` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `Student_Members` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Team_Members` FOREIGN KEY (`T_id`) REFERENCES `teams` (`T_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `Issues_Solutions` FOREIGN KEY (`I_id`) REFERENCES `issues` (`I_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Solutions_Faculties` FOREIGN KEY (`F_id`) REFERENCES `faculties` (`F_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Solutions_Students` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sol_vote`
--
ALTER TABLE `sol_vote`
  ADD CONSTRAINT `Solution_SolVote` FOREIGN KEY (`Sol_id`) REFERENCES `solutions` (`Sol_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SolVote_Faculties` FOREIGN KEY (`F_id`) REFERENCES `faculties` (`F_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `SolVote_Students` FOREIGN KEY (`S_id`) REFERENCES `students` (`S_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `Team_Student` FOREIGN KEY (`F_id`) REFERENCES `faculties` (`F_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;


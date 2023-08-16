-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 04:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisdomdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountID` int(11) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(90) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `token` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountID`, `email`, `password`, `role`, `token`) VALUES
(1, 'adu@email.com', '$2y$10$X3uErLW.2Z7f0pTIZfoOnOAAlrgvSV5ZwbXnrPqENj8H4fEBQ2Cxa', 'school', NULL),
(2, 'chs1@email.com', NULL, 'student', NULL),
(3, 'chs2@email.com', NULL, 'student', NULL),
(4, 'chs3@email.com', NULL, 'student', NULL),
(5, 'chs4@email.com', NULL, 'student', NULL),
(6, 'chs5@email.com', NULL, 'student', NULL),
(7, 'chs6@email.com', NULL, 'student', NULL),
(8, 'chs7@email.com', NULL, 'student', NULL),
(9, 'chs8@email.com', NULL, 'student', NULL),
(10, 'chs9@email.com', NULL, 'student', NULL),
(12, 'admin@email.com', '$2y$10$OY0xEa6/OPzfxh.hA3Qn3Ov/Xm/RV5SxrLFQR22Cj.wleA8FdNLKC', 'admin', NULL),
(23, 'facilitator@email.com', '$2y$10$Aptb7IR4kHUKQWL/a6PqL.R8Ei4apsU/8jLjFmszVVKMbQcJOJl/q', 'facilitator', NULL),
(24, 'hr@email.com', '$2y$10$OxLvuHDfHJq1AKlPWpSVSumVTB7UxipPQpmqNO06WECTJPjzFEg7e', 'hr', NULL),
(26, 'tup@email.com', '$2y$10$461o5uu6Fee4yFvNLXUmp.NUHVQL5vi5tTXwbD9eRLGDA/Uhzvme.', 'school', NULL),
(27, 'pcu@email.com', '$2y$10$PsTDQU954xWE5xtnfRh4UOBc.x1n8hAj8pcjhM62W135G7obmVAmy', 'school', NULL),
(28, 'pcus1@email.com', NULL, 'student', NULL),
(29, 'pcus2@email.com', NULL, 'student', NULL),
(30, 'pcus3@email.com', NULL, 'student', NULL),
(31, 'pcus4@email.com', NULL, 'student', NULL),
(32, 'pcus5@email.com', NULL, 'student', NULL),
(33, 'pcus6@email.com', NULL, 'student', NULL),
(34, 'pcus7@email.com', NULL, 'student', NULL),
(35, 'pcus8@email.com', NULL, 'student', NULL),
(36, 'pcus9@email.com', NULL, 'student', NULL),
(37, 'pcus10@email.com', NULL, 'student', NULL),
(38, 'pcus11@email.com', NULL, 'student', NULL),
(39, 'pcus12@email.com', NULL, 'student', NULL),
(40, 'pcus13@email.com', NULL, 'student', NULL),
(41, 'pcus14@email.com', NULL, 'student', NULL),
(42, 'pcus15@email.com', NULL, 'student', NULL),
(43, 'tups1@email.com', NULL, 'student', NULL),
(44, 'tups2@email.com', NULL, 'student', NULL),
(45, 'tups3@email.com', NULL, 'student', NULL),
(46, 'tups4@email.com', NULL, 'student', NULL),
(47, 'tups5@email.com', NULL, 'student', NULL),
(48, 'tups6@email.com', NULL, 'student', NULL),
(49, 'tups7@email.com', NULL, 'student', NULL),
(50, 'tups8@email.com', NULL, 'student', NULL),
(51, 'tups9@email.com', NULL, 'student', NULL),
(52, 'tups10@email.com', NULL, 'student', NULL),
(53, 'tups11@email.com', NULL, 'student', NULL),
(54, 'tups12@email.com', NULL, 'student', NULL),
(55, 'mapua@email.com', '1234', 'school', NULL),
(56, 'mapua2@email.com', '$2y$10$pfc6OxiUSX3GJFC4t7KtsO6HSzuGKaDmdBSp3ASRh2vp9AUKkyY4.', 'school', NULL),
(90, 'admin1@gmail.com', '1234', 'admin', NULL),
(91, 'admin1@gmail.com', '1234', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `adminID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contactInfo` varchar(20) NOT NULL,
  `adminLogo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`adminID`, `accountID`, `adminName`, `address`, `contactInfo`, `adminLogo`) VALUES
(1, 90, 'admin1', 'Manila', '1234567890', ''),
(2, 91, 'admin2', 'Manila', '0987654321', '');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batchID` int(11) NOT NULL,
  `schoolID` int(11) DEFAULT NULL,
  `batchNo` int(11) DEFAULT NULL,
  `batchName` varchar(90) DEFAULT NULL,
  `batchDescription` varchar(255) DEFAULT NULL,
  `startDate` varchar(50) DEFAULT NULL,
  `endDate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batchID`, `schoolID`, `batchNo`, `batchName`, `batchDescription`, `startDate`, `endDate`) VALUES
(1, 1, 0, 'Batch George Lucas', 'George Lucas Adamson\'s 9 students from schoolID: 1', '2023-08-04', NULL),
(2, 17, 1, 'Batch Christian U', 'Christian U Prof\'s 15 students from schoolID: 17', '2023-08-04', NULL),
(3, 16, 2, 'Batch TUP', 'TUP Prof\'s 12 students from schoolID: 16', '2023-08-04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dailylog`
--

CREATE TABLE `dailylog` (
  `logID` int(11) NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `hoursRendered` int(11) DEFAULT NULL,
  `date` varchar(80) DEFAULT NULL,
  `dateTimeIn` varchar(80) DEFAULT NULL,
  `dateTimeOut` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dailylog`
--

INSERT INTO `dailylog` (`logID`, `studentID`, `hoursRendered`, `date`, `dateTimeIn`, `dateTimeOut`) VALUES
(1, 1, 8, '08/04/2023', '8:00', '5:00'),
(2, 2, 8, '08/04/2023', '8:00', '5:00'),
(3, 1, 8, '08/03/2023', '8:00', '5:00'),
(4, 1, 8, '08/04/2023', '8:00', '5:00'),
(5, 1, 8, '08/03/2023', '8:00', '5:00'),
(6, 1, 8, '08/02/2023', '8:00', '5:00'),
(7, 1, 8, '08/01/2023', '8:00', '5:00'),
(8, 2, 8, '08/03/2023', '8:00', '5:00'),
(9, 2, 8, '08/02/2023', '8:00', '5:00'),
(10, 2, 8, '08/01/2023', '8:00', '5:00');

-- --------------------------------------------------------

--
-- Table structure for table `dailylogtask`
--

CREATE TABLE `dailylogtask` (
  `task` int(11) DEFAULT NULL,
  `dailyLog` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dailylogtask`
--

INSERT INTO `dailylogtask` (`task`, `dailyLog`) VALUES
(3, 1),
(4, 2),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `facilitator`
--

CREATE TABLE `facilitator` (
  `facilitatorID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `batchID` int(11) DEFAULT NULL,
  `facilitatorName` varchar(90) DEFAULT NULL,
  `position` varchar(90) DEFAULT NULL,
  `profileImage` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilitator`
--

INSERT INTO `facilitator` (`facilitatorID`, `accountID`, `batchID`, `facilitatorName`, `position`, `profileImage`) VALUES
(1, 23, NULL, 'N/A', NULL, '64cc800a7e67b.png');

-- --------------------------------------------------------

--
-- Table structure for table `getintouch`
--

CREATE TABLE `getintouch` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `getintouch`
--

INSERT INTO `getintouch` (`name`, `email`, `message`) VALUES
('', '', ''),
('', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

CREATE TABLE `hr` (
  `hrID` int(11) NOT NULL,
  `accountID` int(11) NOT NULL,
  `hrName` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `profileImage` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hr`
--

INSERT INTO `hr` (`hrID`, `accountID`, `hrName`, `position`, `profileImage`) VALUES
(1, 24, 0, NULL, '64cc807614d73.png');

-- --------------------------------------------------------

--
-- Table structure for table `internshipapplication`
--

CREATE TABLE `internshipapplication` (
  `internshipApplicationID` int(11) NOT NULL,
  `schoolID` int(11) DEFAULT NULL,
  `batchID` int(11) DEFAULT NULL,
  `programAdviser` varchar(80) DEFAULT NULL,
  `adviserEmail` varchar(80) DEFAULT NULL,
  `dateSubmitted` varchar(80) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `noStudents` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internshipapplication`
--

INSERT INTO `internshipapplication` (`internshipApplicationID`, `schoolID`, `batchID`, `programAdviser`, `adviserEmail`, `dateSubmitted`, `duration`, `noStudents`) VALUES
(1, 1, 1, 'George Lucas Adamson', 'georgeadamson@email.com', '2023-08-04', 300, 7),
(2, 17, 2, 'Christian U Prof', 'pcu.prof@email.com', '2023-08-04', 240, 15),
(3, 16, 3, 'TUP Prof', 'tup.prof@email.com', '2023-08-04', 240, 9);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `schoolID` int(11) NOT NULL,
  `accountID` int(11) DEFAULT NULL,
  `schoolName` varchar(90) DEFAULT NULL,
  `address` varchar(90) DEFAULT NULL,
  `contactInfo` varchar(20) DEFAULT NULL,
  `schoolLogo` varchar(90) DEFAULT NULL,
  `Moa` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`schoolID`, `accountID`, `schoolName`, `address`, `contactInfo`, `schoolLogo`, `Moa`) VALUES
(1, 1, 'Adamson University', 'Ermita, Paco, Manila, Metro Manila', NULL, '64cc5927352f8.png', 'Application Letter.docx.pdf'),
(3, 12, 'TechnoKids', 'N/A, Manila, Metro Manila', 'N/A', '64cc634d88f4f.png', NULL),
(16, 26, 'TUP Manila', 'N/A, Manila, Metro Manila', NULL, '64cc831c27a5a.png', 'Application Letter.docx.pdf'),
(17, 27, 'PCU', 'N/A, Manila, Metro Manila', NULL, '64cc8422baa11.png', 'Application Letter.docx.pdf'),
(18, 55, 'Mapua University', 'Intramuros, Manila', '987654321', '64d7a9e3a9a84.jfif', NULL),
(19, 56, 'Mapua University', 'Intramuros, Manila, Manila, Metro Manila', '987654321', '64d7c194c1d12.jfif', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `accountID` int(11) DEFAULT NULL,
  `applicationID` int(11) DEFAULT NULL,
  `schoolID` int(11) DEFAULT NULL,
  `studentName` varchar(80) DEFAULT NULL,
  `course` varchar(90) DEFAULT NULL,
  `hoursRendered` varchar(80) DEFAULT NULL,
  `submittedRequirements` varchar(255) DEFAULT NULL,
  `profileImage` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `accountID`, `applicationID`, `schoolID`, `studentName`, `course`, `hoursRendered`, `submittedRequirements`, `profileImage`) VALUES
(1, 2, 1, 1, 'Chem Student One', 'Chemical Engineering', '10', NULL, NULL),
(2, 3, 1, 1, 'Chem Student Two', 'Chemical Engineering', '11', NULL, NULL),
(3, 4, 1, 1, 'Chem Student Three', 'Chemical Engineering', '10', NULL, NULL),
(4, 5, 1, 1, 'Chem Student Four', 'Chemical Engineering', '16', NULL, NULL),
(5, 6, 1, 1, 'Chem Student Five', 'Chemical Engineering', '9', NULL, NULL),
(6, 7, 1, 1, 'Chem Student Six', 'Chemical Engineering', '0', NULL, NULL),
(7, 8, 1, 1, 'Chem Student Seven', 'Chemical Engineering', '0', NULL, NULL),
(8, 9, 1, 1, 'Chem Student Eight', 'Chemical Engineering', '0', NULL, NULL),
(9, 10, 1, 1, 'Chem Student Nine', 'Chemical Engineering', '0', NULL, NULL),
(10, 28, 2, 17, 'PCU Student 1', 'Information Technology', '0', NULL, NULL),
(11, 29, 2, 17, 'PCU Student 2', 'Information Technology', '0', NULL, NULL),
(12, 30, 2, 17, 'PCU Student 3', 'Information Technology', '0', NULL, NULL),
(13, 31, 2, 17, 'PCU Student 4', 'Information Technology', '0', NULL, NULL),
(14, 32, 2, 17, 'PCU Student 5', 'Information Technology', '0', NULL, NULL),
(15, 33, 2, 17, 'PCU Student 6', 'Information Technology', '0', NULL, NULL),
(16, 34, 2, 17, 'PCU Student 7', 'Information Technology', '0', NULL, NULL),
(17, 35, 2, 17, 'PCU Student 8', 'Information Technology', '0', NULL, NULL),
(18, 36, 2, 17, 'PCU Student 9', 'Information Technology', '0', NULL, NULL),
(19, 37, 2, 17, 'PCU Student 10', 'Information Technology', '0', NULL, NULL),
(20, 38, 2, 17, 'PCU Student 11', 'Information Technology', '0', NULL, NULL),
(21, 39, 2, 17, 'PCU Student 12', 'Information Technology', '0', NULL, NULL),
(22, 40, 2, 17, 'PCU Student 13', 'Information Technology', '0', NULL, NULL),
(23, 41, 2, 17, 'PCU Student 14', 'Information Technology', '0', NULL, NULL),
(24, 42, 2, 17, 'PCU Student 15', 'Information Technology', '0', NULL, NULL),
(25, 43, 3, 16, 'TUP Student 1', 'Computer Science', '0', NULL, NULL),
(26, 44, 3, 16, 'TUP Student 2', 'Computer Science', '0', NULL, NULL),
(27, 45, 3, 16, 'TUP Student 3', 'Computer Science', '0', NULL, NULL),
(28, 46, 3, 16, 'TUP Student 4', 'Computer Science', '0', NULL, NULL),
(29, 47, 3, 16, 'TUP Student 5', 'Computer Science', '0', NULL, NULL),
(30, 48, 3, 16, 'TUP Student 6', 'Computer Science', '0', NULL, NULL),
(31, 49, 3, 16, 'TUP Student 7', 'Computer Science', '0', NULL, NULL),
(32, 50, 3, 16, 'TUP Student 8', 'Computer Science', '0', NULL, NULL),
(33, 51, 3, 16, 'TUP Student 9', 'Computer Science', '0', NULL, NULL),
(34, 52, 3, 16, 'TUP Student 10', 'Computer Science', '0', NULL, NULL),
(35, 53, 3, 16, 'TUP Student 11', 'Computer Science', '0', NULL, NULL),
(36, 54, 3, 16, 'TUP Student 12', 'Computer Science', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentstatus`
--

CREATE TABLE `studentstatus` (
  `schoolID` int(11) DEFAULT NULL,
  `studentID` int(11) DEFAULT NULL,
  `status` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentstatus`
--

INSERT INTO `studentstatus` (`schoolID`, `studentID`, `status`) VALUES
(1, 1, 'declined'),
(1, 2, 'pending'),
(1, 3, 'pending'),
(1, 4, 'pending'),
(1, 5, 'pending'),
(1, 6, 'pending'),
(1, 7, 'pending'),
(1, 8, 'pending'),
(1, 9, 'accepted'),
(17, 10, 'pending'),
(17, 11, 'pending'),
(17, 12, 'pending'),
(17, 13, 'pending'),
(17, 14, 'pending'),
(17, 15, 'pending'),
(17, 16, 'pending'),
(17, 17, 'pending'),
(17, 18, 'pending'),
(17, 19, 'pending'),
(17, 20, 'pending'),
(17, 21, 'pending'),
(17, 22, 'pending'),
(17, 23, 'pending'),
(17, 24, 'pending'),
(16, 25, 'accepted'),
(16, 26, 'accepted'),
(16, 27, 'accepted'),
(16, 28, 'pending'),
(16, 29, 'pending'),
(16, 30, 'pending'),
(16, 31, 'pending'),
(16, 32, 'pending'),
(16, 33, 'pending'),
(16, 34, 'pending'),
(16, 35, 'pending'),
(16, 36, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `studenttask`
--

CREATE TABLE `studenttask` (
  `taskID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studenttask`
--

INSERT INTO `studenttask` (`taskID`, `studentID`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(6, 30),
(6, 31),
(6, 32),
(6, 33),
(6, 34),
(5, 35),
(5, 36);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskID` int(11) NOT NULL,
  `applicationID` int(11) DEFAULT NULL,
  `assignmentSlots` int(11) DEFAULT NULL,
  `title` varchar(90) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `labels` varchar(255) DEFAULT NULL,
  `allotedHours` int(11) DEFAULT NULL,
  `dateStarted` varchar(80) DEFAULT NULL,
  `dateFinished` varchar(80) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskID`, `applicationID`, `assignmentSlots`, `title`, `description`, `labels`, `allotedHours`, `dateStarted`, `dateFinished`, `status`) VALUES
(1, 2, 5, 'Create the Class Diagram', 'Create the class diagram which will be user in the development of the app.', 'App Development', 40, NULL, NULL, 'pending'),
(2, 2, 5, 'Search for frameworks', 'Look for frameworks that will be useful.', 'App Development, Programming', 40, NULL, NULL, 'pending'),
(3, 1, 5, 'Research', 'Submit a report on the given topic.', 'Research', 40, NULL, NULL, 'pending'),
(4, 1, 10, 'Pubmat', 'Create a publication material.', 'Design', 40, NULL, NULL, 'pending'),
(5, 3, 10, 'Website Design Mockup', 'Create a mockup design using Figma for the website.', 'Web Development, Design', 40, NULL, NULL, 'pending'),
(6, 3, 10, 'Documentation', 'Create a shared file intended for documentation.', 'Documentation', 40, NULL, NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `accountID` int(11) DEFAULT NULL,
  `date` varchar(80) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `accountID`, `date`, `amount`, `description`) VALUES
(1, 2, '08/04/2023', 500, NULL),
(2, 3, '08/04/2023', 200, NULL),
(3, 42, '08/04/2023', 300, NULL),
(4, 41, '08/04/2023', 350, NULL),
(5, 3, '08/04/2023', 200, NULL),
(6, 4, '08/04/2023', 200, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `admintb`
--
ALTER TABLE `admintb`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `fk_id` (`accountID`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batchID`),
  ADD KEY `schoolID` (`schoolID`);

--
-- Indexes for table `dailylog`
--
ALTER TABLE `dailylog`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `dailylogtask`
--
ALTER TABLE `dailylogtask`
  ADD KEY `task` (`task`),
  ADD KEY `dailyLog` (`dailyLog`);

--
-- Indexes for table `facilitator`
--
ALTER TABLE `facilitator`
  ADD PRIMARY KEY (`facilitatorID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `batchID` (`batchID`);

--
-- Indexes for table `hr`
--
ALTER TABLE `hr`
  ADD PRIMARY KEY (`hrID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `internshipapplication`
--
ALTER TABLE `internshipapplication`
  ADD PRIMARY KEY (`internshipApplicationID`),
  ADD KEY `schoolID` (`schoolID`),
  ADD KEY `batchID` (`batchID`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`schoolID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `applicationID` (`applicationID`),
  ADD KEY `schoolID` (`schoolID`);

--
-- Indexes for table `studentstatus`
--
ALTER TABLE `studentstatus`
  ADD KEY `schoolID` (`schoolID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `studenttask`
--
ALTER TABLE `studenttask`
  ADD KEY `taskID` (`taskID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskID`),
  ADD KEY `applicationID` (`applicationID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `accountID` (`accountID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `admintb`
--
ALTER TABLE `admintb`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dailylog`
--
ALTER TABLE `dailylog`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `facilitator`
--
ALTER TABLE `facilitator`
  MODIFY `facilitatorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hr`
--
ALTER TABLE `hr`
  MODIFY `hrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `internshipapplication`
--
ALTER TABLE `internshipapplication`
  MODIFY `internshipApplicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `schoolID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admintb`
--
ALTER TABLE `admintb`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`schoolID`) REFERENCES `school` (`schoolID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dailylog`
--
ALTER TABLE `dailylog`
  ADD CONSTRAINT `dailylog_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `dailylogtask`
--
ALTER TABLE `dailylogtask`
  ADD CONSTRAINT `dailylogtask_ibfk_1` FOREIGN KEY (`task`) REFERENCES `task` (`taskID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dailylogtask_ibfk_2` FOREIGN KEY (`dailyLog`) REFERENCES `dailylog` (`logID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facilitator`
--
ALTER TABLE `facilitator`
  ADD CONSTRAINT `facilitator_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facilitator_ibfk_2` FOREIGN KEY (`batchID`) REFERENCES `batch` (`batchID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `hr`
--
ALTER TABLE `hr`
  ADD CONSTRAINT `hr_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `internshipapplication`
--
ALTER TABLE `internshipapplication`
  ADD CONSTRAINT `internshipapplication_ibfk_1` FOREIGN KEY (`schoolID`) REFERENCES `school` (`schoolID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `internshipapplication_ibfk_2` FOREIGN KEY (`batchID`) REFERENCES `batch` (`batchID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`schoolID`) REFERENCES `school` (`schoolID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`applicationID`) REFERENCES `internshipapplication` (`internshipApplicationID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `studentstatus`
--
ALTER TABLE `studentstatus`
  ADD CONSTRAINT `studentstatus_ibfk_1` FOREIGN KEY (`schoolID`) REFERENCES `school` (`schoolID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studentstatus_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studenttask`
--
ALTER TABLE `studenttask`
  ADD CONSTRAINT `studenttask_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studenttask_ibfk_2` FOREIGN KEY (`taskID`) REFERENCES `task` (`taskID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`applicationID`) REFERENCES `internshipapplication` (`internshipApplicationID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

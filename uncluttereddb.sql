-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2022 at 08:50 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uncluttereddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentstb`
--

CREATE TABLE `commentstb` (
  `id` int(11) NOT NULL,
  `userAccountId` int(11) NOT NULL,
  `updateId` int(11) NOT NULL,
  `comment` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groupchattb`
--

CREATE TABLE `groupchattb` (
  `id` int(11) NOT NULL,
  `repositoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ideastb`
--

CREATE TABLE `ideastb` (
  `id` int(11) NOT NULL,
  `userAccountId` int(11) NOT NULL,
  `repositoryId` int(11) NOT NULL,
  `idea` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ideastb`
--

INSERT INTO `ideastb` (`id`, `userAccountId`, `repositoryId`, `idea`) VALUES
(1, 2, 3, ' * test 1\r\n * Changes 2\r\n'),
(2, 2, 25, 'new idea'),
(3, 8, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `repositorytb`
--

CREATE TABLE `repositorytb` (
  `id` int(11) NOT NULL,
  `repositoryName` varchar(100) NOT NULL,
  `members` varchar(1000) NOT NULL,
  `userAccountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `repositorytb`
--

INSERT INTO `repositorytb` (`id`, `repositoryName`, `members`, `userAccountId`) VALUES
(1, 'report 101', 'a:14:{i:0;i:2;i:1;i:54;i:2;i:3;i:3;i:65;i:4;i:65;i:5;i:54;i:6;i:65;i:7;i:7;i:8;i:6;i:9;i:877;i:10;i:9;i:11;i:7;i:12;i:1;i:13;i:34;}', 2),
(2, 'Project 101', 'a:3:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";}', 2),
(3, 'Test repository', 'a:8:{i:0;s:1:\"2\";i:1;s:1:\"7\";i:2;s:1:\"8\";i:3;s:1:\"9\";i:4;s:2:\"29\";i:5;s:1:\"1\";i:6;s:1:\"3\";i:7;s:1:\"4\";}', 2),
(4, 'Test project', 'a:4:{i:0;s:1:\"3\";i:1;s:1:\"4\";i:2;s:1:\"7\";i:3;s:1:\"1\";}', 2),
(5, 'Test', 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"2\";}', 3),
(6, 'MyRepo', 'i:3;', 3),
(7, 'aaa', 'i:3;', 3),
(9, 'Subjects', 'i:2;', 2),
(10, 'Thesis Project', 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"7\";}', 2),
(11, 'Thesis ', 'a:2:{i:0;s:1:\"3\";i:1;s:1:\"1\";}', 2),
(12, 'Test repo', 'a:2:{i:0;s:1:\"3\";i:1;s:1:\"1\";}', 2),
(13, 'Test project', 'a:1:{i:0;s:1:\"3\";}', 2),
(14, 'Test project', 'i:2;', 2),
(15, 'test project', 'a:1:{i:0;s:1:\"3\";}', 2),
(16, 'folder repo', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 2),
(17, 'Project Making', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}', 2),
(18, 'sample repository', 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"7\";i:4;s:1:\"4\";}', 2),
(19, 'new repository for random file', 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}', 2),
(20, 'random test repo', 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"7\";}', 2),
(21, 'test again', 'i:2;', 2),
(22, 'My repo', 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 29),
(23, 'Thesis', 'a:2:{i:0;s:1:\"8\";i:1;s:1:\"9\";}', 29),
(24, 'test repo', 'a:5:{i:0;s:2:\"29\";i:1;s:1:\"9\";i:2;s:1:\"7\";i:3;s:1:\"4\";i:4;s:1:\"3\";}', 29),
(25, 'Project QrApp Repository', 'a:8:{i:0;s:2:\"29\";i:1;s:1:\"1\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:2:\"30\";i:5;s:1:\"9\";i:6;s:1:\"8\";i:7;s:1:\"2\";}', 29),
(26, 'New repository', 'a:6:{i:0;s:2:\"29\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";i:4;s:1:\"8\";i:5;s:1:\"9\";}', 29),
(27, 'My files', 'i:8;', 8);

-- --------------------------------------------------------

--
-- Table structure for table `updatestb`
--

CREATE TABLE `updatestb` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `filename` varchar(500) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `datetimeCreation` varchar(80) NOT NULL,
  `userAccountId` int(11) NOT NULL,
  `repositoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updatestb`
--

INSERT INTO `updatestb` (`id`, `title`, `filename`, `note`, `datetimeCreation`, `userAccountId`, `repositoryId`) VALUES
(1, 'test post', 'Chapter1-3.docx', '', '2022-11-29 05:31:45 pm', 2, 4),
(2, 'TEST POST', '', '', '2022-11-29 05:31:45 pm', 2, 4),
(3, 'TESTTEST 1st upload', '', 'TEST 1st upload', '2022-12-06 09:49:15 am', 2, 3),
(4, 'RRL file ', 'RRL-problem.docx', 'test file post lang', '2022-12-06 09:51:04 am', 4, 3),
(6, 'Meeting @DMCI', '', '', '2022-11-29 06:15:19 pm', 2, 1),
(7, 'new update sa thesis', '', '', '2022-11-29 09:37:23 pm', 2, 3),
(9, 'test post', '', 'randomrandomrandomrandomrandomrandomrandomrandomrandomrandom', '2022-11-29 10:47:01 pm', 2, 3),
(11, 'test update 121213', '', '', '2022-11-29 11:42:48 pm', 2, 3),
(12, 'new File upload', 'RRL-2.docx', 'RRL 2 dagdag', '2022-11-30 01:33:30 am', 8, 3),
(14, 'Input test', '', '', '2022-11-30 04:08:24 pm', 8, 3),
(15, 'asdasdasdasd', '', '', '2022-11-30 04:09:05 pm', 8, 3),
(16, 'Thesis chap 1-3 revision', '', 'Mandap0123Mandap0123Mandap0123Mandap0123', '2022-12-01 12:06:57 am', 9, 3),
(18, 'new file edited', 'systemdb (7).sql', 'new file editted', '2022-12-02 12:31:09 am', 2, 3),
(19, 'New upload', 'RRL-2 (1).docx', 'New uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew uploadNew upload ne upload ne uploadNew upload', '2022-12-02 12:58:46 am', 2, 3),
(20, 'new post (No file)', '', 'new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No file)new post (No f', '2022-12-02 02:05:46 am', 2, 3),
(21, 'new post (file attached)', 'LESSON-PLAN-JAVASCRIPT.docx', 'new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)', '2022-12-02 02:06:03 am', 2, 3),
(22, 'PPT for thesis', 'Group-6.pptx', '', '2022-12-04 01:22:36 am', 29, 3),
(23, 'test post', 'RRL-problem.docx', 'GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. (SURNAME,SURNAME,SURNMAE)GROUP NO. ', '2022-12-05 10:21:44 pm', 29, 26),
(24, 'new update for thesis', 'RRL-2 (1) (1).docx', '', '2022-12-06 12:40:54 am', 2, 3),
(25, 'file', 'organized.png', '', '2022-12-06 12:41:36 am', 2, 3),
(26, 'Test post file', 'orig.txt', 'dsadsadsadsadas', '2022-12-06 02:33:22 am', 8, 3),
(27, 'random upload test', '', 'this is a sample post', '2022-12-06 10:53:16 pm', 4, 3),
(28, 'new file editted', '', '', '2022-12-07 08:31:27 am', 4, 3),
(29, 'file test', '', 'file testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile testfile test', '2022-12-07 05:20:55 pm', 8, 27);

-- --------------------------------------------------------

--
-- Table structure for table `useraccountstb`
--

CREATE TABLE `useraccountstb` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imageName` varchar(300) DEFAULT NULL,
  `resetCode` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `gmail_Id` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccountstb`
--

INSERT INTO `useraccountstb` (`id`, `firstname`, `lastname`, `username`, `password`, `imageName`, `resetCode`, `email`, `gmail_Id`) VALUES
(1, 'jojo', 'max', 'jojo0123', 'A529DFCDD72CD20F1DD17160976BC3B5DB6073C538A1C6F1A7439DAA1B63CE76', NULL, NULL, '', NULL),
(2, 'William', 'Jimenez', 'admin', 'A529DFCDD72CD20F1DD17160976BC3B5DB6073C538A1C6F1A7439DAA1B63CE76', 'user2.png', NULL, 'admin.william@gmail.com', NULL),
(3, 'Jade', 'Lopez', 'jade0123', 'A529DFCDD72CD20F1DD17160976BC3B5DB6073C538A1C6F1A7439DAA1B63CE76', NULL, NULL, '', NULL),
(4, 'Ash', 'Satoshi', 'ash0123', 'A529DFCDD72CD20F1DD17160976BC3B5DB6073C538A1C6F1A7439DAA1B63CE76', 'user4.png', NULL, 'ash.william@gmail.com', NULL),
(7, 'Alfred William', 'Changco', 'batman', '271EEB70B0338A3F287EDBC0ACC2A9F5235F02309E9FBE66D5FBDFC431E2A05D', NULL, NULL, 'alfredwilliam.changco@tup.edu.ph', NULL),
(8, 'Onah Marie', 'Naputo', 'naputo0123', '5276F154287C1BC57F47DF7B5302119CD507B7BA537DF234002F051DF0CEA635', 'user8.jpg', NULL, 'onahmarie.naputo@tup.edu.ph', NULL),
(9, 'Gabriel justine', 'Mandap', 'mandap0123', '41CFB8185E6965C94B062F024C8B34789C61A507DEFE77B7AE504D354F7A4B20', 'user9.jpg', NULL, 'gabrieljustine.mandap@tup.edu.ph', NULL),
(29, 'Alfred William', 'Changco', 'alfredwilliam.changco@tup.edu.ph', '939CDF04AD3DC4A75027270E46C87C2CFDEE4725B08E93BB4E3B839C19526846', 'https://lh3.googleusercontent.com/a/ALm5wu21rqV0sx0lrFr1-NM_GmeADafwdBMxytr39e_4=s96-c', NULL, 'alfredwilliam.changco@tup.edu.ph', '100912781138234264795'),
(30, 'William', 'Changco', 'williamchangco26@gmail.com', '2C9D4DFD8CDFFB3B2C3B437D96F80D25A326CA8ECC1260F501464DA5D8478D50', 'https://lh3.googleusercontent.com/a/ALm5wu00C1KuREdOmdHtgwdelJqhm2p9Mhn4RZbXX9er=s96-c', NULL, 'williamchangco26@gmail.com', '112935279415944060164');

-- --------------------------------------------------------

--
-- Table structure for table `versiontb`
--

CREATE TABLE `versiontb` (
  `id` int(11) NOT NULL,
  `updateId` int(11) NOT NULL,
  `userAccountId` int(11) NOT NULL,
  `datetimeCreation` varchar(100) NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `versiontb`
--

INSERT INTO `versiontb` (`id`, `updateId`, `userAccountId`, `datetimeCreation`, `note`, `filename`) VALUES
(1, 21, 2, '2022-12-02 02:07:06 am', 'new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attached)new post (file attac', ''),
(2, 21, 2, '2022-12-02 02:21:33 am', 'no file', ''),
(3, 20, 2, '2022-12-03 01:03:10 am', 'theres nothing in this note', ''),
(4, 20, 2, '2022-12-03 01:04:23 am', 'there\'s nothing in this note', ''),
(5, 20, 29, '2022-12-04 01:02:14 am', 'Test Version', ''),
(6, 21, 29, '2022-12-04 01:03:01 am', '', 'Chapter1-3-updated (3).docx'),
(7, 23, 29, '2022-12-05 10:22:51 pm', 'updated file', 'RRL-problem.docx'),
(8, 26, 8, '2022-12-06 02:33:46 am', '1st ver', 'version.txt'),
(9, 26, 8, '2022-12-06 02:51:54 am', 'Test upload', ''),
(10, 25, 8, '2022-12-06 02:52:34 am', 'New version', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentstb`
--
ALTER TABLE `commentstb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupchattb`
--
ALTER TABLE `groupchattb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ideastb`
--
ALTER TABLE `ideastb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repositorytb`
--
ALTER TABLE `repositorytb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updatestb`
--
ALTER TABLE `updatestb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useraccountstb`
--
ALTER TABLE `useraccountstb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `versiontb`
--
ALTER TABLE `versiontb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentstb`
--
ALTER TABLE `commentstb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupchattb`
--
ALTER TABLE `groupchattb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ideastb`
--
ALTER TABLE `ideastb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `repositorytb`
--
ALTER TABLE `repositorytb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `updatestb`
--
ALTER TABLE `updatestb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `useraccountstb`
--
ALTER TABLE `useraccountstb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `versiontb`
--
ALTER TABLE `versiontb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

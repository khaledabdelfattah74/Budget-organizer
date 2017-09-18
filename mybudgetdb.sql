-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 03, 2017 at 10:37 AM
-- Server version: 5.6.34-log
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybudgetdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgetstable`
--

CREATE TABLE IF NOT EXISTS `budgetstable` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BudgetName` char(255) NOT NULL,
  `StartedMoney` int(11) NOT NULL,
  `Money` int(11) NOT NULL,
  `Spent` int(11) NOT NULL DEFAULT '0',
  `Income` int(11) NOT NULL DEFAULT '0',
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budgetstable`
--

INSERT INTO `budgetstable` (`ID`, `UserID`, `BudgetName`, `StartedMoney`, `Money`, `Spent`, `Income`, `DateCreated`) VALUES
(16, 6, 'c5', 13, 13, 0, 0, '2017-04-25 23:41:43'),
(17, 6, 'cc`', 213, 213, 0, 0, '2017-04-25 23:44:44'),
(18, 6, 'c4', 121, 4434, 10, 4323, '2017-04-25 23:46:26'),
(19, 3, 'sa', 124, 3394, 30, 3300, '2017-04-26 00:19:18'),
(21, 6, 'C52', 21, 21, 0, 0, '2017-04-26 22:40:15'),
(23, 6, '', 0, 0, 0, 0, '2017-04-29 14:44:23'),
(24, 6, 'sad', 1, 1, 0, 0, '2017-04-29 14:52:35'),
(25, 6, 'sa', 0, 0, 0, 0, '2017-04-29 14:53:05'),
(26, 6, 'sdsa', 2143, 2143, 0, 0, '2017-04-29 14:53:31'),
(27, 6, 'hi', 0, 0, 0, 0, '2017-04-29 14:53:45'),
(32, 3, 'ssa', 0, 0, 0, 0, '2017-04-30 18:58:46'),
(33, 3, 'ss', 0, 0, 0, 0, '2017-05-02 15:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `categoriestable`
--

CREATE TABLE IF NOT EXISTS `categoriestable` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` char(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categoriestable`
--

INSERT INTO `categoriestable` (`ID`, `UserID`, `Name`) VALUES
(1, 2, 'Home'),
(5, 2, 'School'),
(9, 3, 'School'),
(6, 6, 'Food'),
(8, 6, 'Home'),
(7, 6, 'School');

-- --------------------------------------------------------

--
-- Table structure for table `incomesscheduletable`
--

CREATE TABLE IF NOT EXISTS `incomesscheduletable` (
  `ID` int(11) NOT NULL,
  `Source` text NOT NULL,
  `Amount` int(11) NOT NULL,
  `BudgetID` int(11) NOT NULL,
  `Every` text NOT NULL,
  `Times` int(11) NOT NULL DEFAULT '1',
  `StartDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `StartedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomesscheduletable`
--

INSERT INTO `incomesscheduletable` (`ID`, `Source`, `Amount`, `BudgetID`, `Every`, `Times`, `StartDate`, `StartedDate`) VALUES
(7, 'hSalary', 50, 19, 'H', 1, '2017-04-29 14:08:56', '2017-05-02 16:51:23'),
(8, 'dSalary', 1000, 18, 'D', 1, '2017-04-28 22:06:56', '2017-05-02 16:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `incomestable`
--

CREATE TABLE IF NOT EXISTS `incomestable` (
  `ID` int(11) NOT NULL,
  `Source` text NOT NULL,
  `Amount` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BudgetID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=975 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomestable`
--

INSERT INTO `incomestable` (`ID`, `Source`, `Amount`, `DateCreated`, `BudgetID`) VALUES
(901, 'hSalary', 50, '2017-04-26 21:08:56', 19),
(902, 'hSalary', 50, '2017-04-26 22:08:56', 19),
(904, 'dSalary', 1000, '2017-04-26 22:06:56', 18),
(905, 'hSalary', 50, '2017-04-26 23:08:56', 19),
(906, 'hSalary', 50, '2017-04-27 00:08:56', 19),
(907, 'hSalary', 50, '2017-04-27 01:08:56', 19),
(908, 'hSalary', 50, '2017-04-27 02:08:56', 19),
(909, 'hSalary', 50, '2017-04-27 03:08:56', 19),
(910, 'hSalary', 50, '2017-04-27 04:08:56', 19),
(911, 'hSalary', 50, '2017-04-27 05:08:56', 19),
(912, 'hSalary', 50, '2017-04-27 06:08:56', 19),
(913, 'hSalary', 50, '2017-04-27 07:08:56', 19),
(914, 'hSalary', 50, '2017-04-27 08:08:56', 19),
(915, 'dSalary', 1000, '2017-04-27 22:06:56', 18),
(916, 'dSalary', 1000, '2017-04-28 22:06:56', 18),
(917, 'hSalary', 50, '2017-04-27 09:08:56', 19),
(918, 'hSalary', 50, '2017-04-27 10:08:56', 19),
(919, 'hSalary', 50, '2017-04-27 11:08:56', 19),
(920, 'hSalary', 50, '2017-04-27 12:08:56', 19),
(921, 'hSalary', 50, '2017-04-27 13:08:56', 19),
(922, 'hSalary', 50, '2017-04-27 14:08:56', 19),
(923, 'hSalary', 50, '2017-04-27 15:08:56', 19),
(924, 'hSalary', 50, '2017-04-27 16:08:56', 19),
(925, 'hSalary', 50, '2017-04-27 17:08:56', 19),
(926, 'hSalary', 50, '2017-04-27 18:08:56', 19),
(927, 'hSalary', 50, '2017-04-27 19:08:56', 19),
(928, 'hSalary', 50, '2017-04-27 20:08:56', 19),
(929, 'hSalary', 50, '2017-04-27 21:08:56', 19),
(930, 'hSalary', 50, '2017-04-27 22:08:56', 19),
(931, 'hSalary', 50, '2017-04-27 23:08:56', 19),
(932, 'hSalary', 50, '2017-04-28 00:08:56', 19),
(933, 'hSalary', 50, '2017-04-28 01:08:56', 19),
(934, 'hSalary', 50, '2017-04-28 02:08:56', 19),
(935, 'hSalary', 50, '2017-04-28 03:08:56', 19),
(936, 'hSalary', 50, '2017-04-28 04:08:56', 19),
(937, 'hSalary', 50, '2017-04-28 05:08:56', 19),
(938, 'hSalary', 50, '2017-04-28 06:08:56', 19),
(939, 'hSalary', 50, '2017-04-28 07:08:56', 19),
(940, 'hSalary', 50, '2017-04-28 08:08:56', 19),
(941, 'hSalary', 50, '2017-04-28 09:08:56', 19),
(942, 'hSalary', 50, '2017-04-28 10:08:56', 19),
(943, 'hSalary', 50, '2017-04-28 11:08:56', 19),
(944, 'hSalary', 50, '2017-04-28 12:08:56', 19),
(945, 'hSalary', 50, '2017-04-28 13:08:56', 19),
(946, 'hSalary', 50, '2017-04-28 14:08:56', 19),
(947, 'hSalary', 50, '2017-04-28 15:08:56', 19),
(948, 'hSalary', 50, '2017-04-28 16:08:56', 19),
(949, 'hSalary', 50, '2017-04-28 17:08:56', 19),
(950, 'hSalary', 50, '2017-04-28 18:08:56', 19),
(951, 'hSalary', 50, '2017-04-28 19:08:56', 19),
(952, 'hSalary', 50, '2017-04-28 20:08:56', 19),
(953, 'hSalary', 50, '2017-04-28 21:08:56', 19),
(954, 'hSalary', 50, '2017-04-28 22:08:56', 19),
(955, 'hSalary', 50, '2017-04-28 23:08:56', 19),
(956, 'hSalary', 50, '2017-04-29 00:08:56', 19),
(957, 'hSalary', 50, '2017-04-29 01:08:56', 19),
(958, 'hSalary', 50, '2017-04-29 02:08:56', 19),
(959, 'hSalary', 50, '2017-04-29 03:08:56', 19),
(960, 'hSalary', 50, '2017-04-29 04:08:56', 19),
(961, 'hSalary', 50, '2017-04-29 05:08:56', 19),
(962, 'hSalary', 50, '2017-04-29 06:08:56', 19),
(963, 'hSalary', 50, '2017-04-29 07:08:56', 19),
(964, 'hSalary', 50, '2017-04-29 08:08:56', 19),
(965, 'hSalary', 50, '2017-04-29 09:08:56', 19),
(966, 'hSalary', 50, '2017-04-29 10:08:56', 19),
(967, 'hSalary', 50, '2017-04-29 11:08:56', 19),
(968, 'hSalary', 50, '2017-04-29 12:08:56', 19),
(971, '', 0, '2017-04-29 14:42:33', 17),
(973, 'El Hawa', 123, '2017-04-30 14:58:48', 18),
(974, 'ss', 100, '2017-04-30 19:20:52', 19);

-- --------------------------------------------------------

--
-- Table structure for table `newstable`
--

CREATE TABLE IF NOT EXISTS `newstable` (
  `ID` int(11) NOT NULL,
  `Title` char(255) NOT NULL,
  `Tobic` longtext NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ImgUrl` char(255) DEFAULT NULL,
  `Author` char(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newstable`
--

INSERT INTO `newstable` (`ID`, `Title`, `Tobic`, `DateCreated`, `ImgUrl`, `Author`) VALUES
(1, 'Hakeem is now an admin', 'IMPORTANT\r\nHakeem is now an admin...3aaaaaaa', '2017-04-22 13:17:14', '', 'Admin'),
(2, 'Hakeem is now an admin !!!!!', 'IMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaa', '2017-05-02 14:12:03', 'https://static.pexels.com/photos/9135/sky-clouds-blue-horizon.jpg', 'Admin'),
(3, 'Aymanis now an admin !!!!!', 'IMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaa\r\nIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaaIMPORTANT\r\nHakeem is now an admin...3aaaaaaa', '2017-05-02 14:18:57', 'https://static.pexels.com/photos/9135/sky-clouds-blue-horizon.jpg', 'Admin'),
(4, 'Hiiii', 'Referrals Are The Most Effective Way To Get Hired\r\nA recent LinkedIn survey on talent trends showed that 1 in 3 people were actively looking for new work. As of January 2017, the population of employed people in the United States was 123 million. This means that, at any given time, 41 million people are looking for work.\r\nOn average, an open role at a well known company gets ~250 resumes. 75% of these resumes came from some sort of online portal (like the companyâ€™s online application, or a career aggregator site like Indeed.com).\r\nOnce submitted, these applications are screened by Applicant Tracking software that scans them for keywords. At the end of the process, ~5 resumes make it into the hands of a recruiter. Thatâ€™s 2% at best.\r\nAdditionally, The Wall Street Journal published an article stating that 80% of jobs arenâ€™t advertised online.\r\nThat means that 75% of people applying for jobs are all competing for 20% of the opportunities!\r\nOops.\r\nWhen it comes to getting hired, referrals are the most effective way to secure an interview and land the offer. Here are some stats from a recent Jobvite survey:\r\n40% of hires come from referrals, the next largest channel is via career sites at 21% (almost half as many)\r\nReferrals get hired in an average of 3 weeks while other applicants take up to 7 weeks\r\nReferrals get paid more on average than cold applicants', '2017-05-02 14:25:25', 'images/alarm.jpg', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `productstable`
--

CREATE TABLE IF NOT EXISTS `productstable` (
  `ID` int(11) NOT NULL,
  `SubCatID` int(11) NOT NULL,
  `Name` char(255) NOT NULL,
  `wasBought` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productstable`
--

INSERT INTO `productstable` (`ID`, `SubCatID`, `Name`, `wasBought`) VALUES
(1, 2, 'Tomato', 1),
(18, 7, 'Math Book', 1),
(19, 8, 'Sodo2', 1),
(20, 9, 'Math Book', 3),
(21, 10, 'Banana', 1),
(22, 9, 'English Book', 1),
(23, 11, 'Math Book', 3);

-- --------------------------------------------------------

--
-- Table structure for table `spentstable`
--

CREATE TABLE IF NOT EXISTS `spentstable` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `BudgetID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Datepuhrcased` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `spentstable`
--

INSERT INTO `spentstable` (`ID`, `ProductID`, `BudgetID`, `Price`, `Datepuhrcased`) VALUES
(7, 20, 18, 10, '2017-04-26 00:14:15'),
(15, 23, 19, 10, '2017-05-02 16:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `subcategoriestable`
--

CREATE TABLE IF NOT EXISTS `subcategoriestable` (
  `ID` int(11) NOT NULL,
  `CatID` int(11) NOT NULL,
  `Name` char(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategoriestable`
--

INSERT INTO `subcategoriestable` (`ID`, `CatID`, `Name`) VALUES
(2, 1, 'Food'),
(7, 5, 'Books'),
(8, 6, 'Pie'),
(9, 7, 'Books'),
(10, 8, 'Food'),
(11, 9, 'Books');

-- --------------------------------------------------------

--
-- Table structure for table `userstable`
--

CREATE TABLE IF NOT EXISTS `userstable` (
  `ID` int(11) NOT NULL,
  `Username` char(255) CHARACTER SET utf8 NOT NULL,
  `Firstname` char(255) CHARACTER SET utf8 NOT NULL DEFAULT 'Empty',
  `Lastname` char(255) CHARACTER SET utf8 NOT NULL DEFAULT 'Empty',
  `Email` char(255) CHARACTER SET utf8 NOT NULL,
  `Age` int(11) NOT NULL DEFAULT '0',
  `Password` char(255) CHARACTER SET utf8 NOT NULL,
  `Datejoined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  `DefaultBudgetID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstable`
--

INSERT INTO `userstable` (`ID`, `Username`, `Firstname`, `Lastname`, `Email`, `Age`, `Password`, `Datejoined`, `isAdmin`, `DefaultBudgetID`) VALUES
(2, 'admin', 'admin', 'admin', 'admin@mybudget.com', 20, 'admin', '2017-04-21 11:32:02', 1, 0),
(3, 'ayman', 'ayman', 'ahmed', 'basbosearn@gmail.com', 20, '123', '2017-04-21 22:34:21', 1, 19),
(4, 'biuasd', 'asdasudi', 'bdasjasiudb', 'ayman.a.samy.m@gmail.com', 121, '123', '2017-04-21 22:35:04', 0, 0),
(6, '3bdelhakeem', 'Abdelhakeem', 'Osama', '3bdelhakeem@gmail.com', 20, '123456kimo', '2017-04-22 13:13:11', 0, 18),
(7, 'ayman1', 'Ayman', 'ahmed', 'ayman.a.samy.m1@gmail.com', 18, '12345678', '2017-05-02 14:49:33', 0, 0),
(8, 'ayman222', 'Ayman', 'ahmed', 'wbasbosearn@gmail.com', 18, '12345678', '2017-05-02 14:54:28', 1, 0),
(9, 'aymanfasf', 'Ayman', 'ahmed', 'aymanaafhmed13697@gmail.com', 18, '12345678', '2017-05-02 15:06:09', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgetstable`
--
ALTER TABLE `budgetstable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`,`BudgetName`);

--
-- Indexes for table `categoriestable`
--
ALTER TABLE `categoriestable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`,`Name`);

--
-- Indexes for table `incomesscheduletable`
--
ALTER TABLE `incomesscheduletable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C10` (`BudgetID`);

--
-- Indexes for table `incomestable`
--
ALTER TABLE `incomestable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C2` (`BudgetID`);

--
-- Indexes for table `newstable`
--
ALTER TABLE `newstable`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `productstable`
--
ALTER TABLE `productstable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `SubCatID` (`SubCatID`,`Name`);

--
-- Indexes for table `spentstable`
--
ALTER TABLE `spentstable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C9` (`ProductID`),
  ADD KEY `C6` (`BudgetID`);

--
-- Indexes for table `subcategoriestable`
--
ALTER TABLE `subcategoriestable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CatID` (`CatID`,`Name`);

--
-- Indexes for table `userstable`
--
ALTER TABLE `userstable`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgetstable`
--
ALTER TABLE `budgetstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `categoriestable`
--
ALTER TABLE `categoriestable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `incomesscheduletable`
--
ALTER TABLE `incomesscheduletable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `incomestable`
--
ALTER TABLE `incomestable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=975;
--
-- AUTO_INCREMENT for table `newstable`
--
ALTER TABLE `newstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `productstable`
--
ALTER TABLE `productstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `spentstable`
--
ALTER TABLE `spentstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `subcategoriestable`
--
ALTER TABLE `subcategoriestable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `userstable`
--
ALTER TABLE `userstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgetstable`
--
ALTER TABLE `budgetstable`
  ADD CONSTRAINT `C1` FOREIGN KEY (`UserID`) REFERENCES `userstable` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `categoriestable`
--
ALTER TABLE `categoriestable`
  ADD CONSTRAINT `C3` FOREIGN KEY (`UserID`) REFERENCES `userstable` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `incomesscheduletable`
--
ALTER TABLE `incomesscheduletable`
  ADD CONSTRAINT `C10` FOREIGN KEY (`BudgetID`) REFERENCES `budgetstable` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `incomestable`
--
ALTER TABLE `incomestable`
  ADD CONSTRAINT `C2` FOREIGN KEY (`BudgetID`) REFERENCES `budgetstable` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `productstable`
--
ALTER TABLE `productstable`
  ADD CONSTRAINT `C5` FOREIGN KEY (`SubCatID`) REFERENCES `subcategoriestable` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `spentstable`
--
ALTER TABLE `spentstable`
  ADD CONSTRAINT `C6` FOREIGN KEY (`BudgetID`) REFERENCES `budgetstable` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `C9` FOREIGN KEY (`ProductID`) REFERENCES `productstable` (`ID`);

--
-- Constraints for table `subcategoriestable`
--
ALTER TABLE `subcategoriestable`
  ADD CONSTRAINT `C4` FOREIGN KEY (`CatID`) REFERENCES `categoriestable` (`ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

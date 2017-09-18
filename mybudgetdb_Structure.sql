SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `budgetstable` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BudgetName` char(255) NOT NULL,
  `StartedMoney` int(11) NOT NULL,
  `Money` int(11) NOT NULL,
  `Spent` int(11) NOT NULL DEFAULT '0',
  `Income` int(11) NOT NULL DEFAULT '0',
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `categoriestable` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `incomesscheduletable` (
  `ID` int(11) NOT NULL,
  `Source` text NOT NULL,
  `Amount` int(11) NOT NULL,
  `BudgetID` int(11) NOT NULL,
  `Every` text NOT NULL,
  `Times` int(11) NOT NULL DEFAULT '1',
  `StartDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `incomestable` (
  `ID` int(11) NOT NULL,
  `Source` text NOT NULL,
  `Amount` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BudgetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `newstable` (
  `ID` int(11) NOT NULL,
  `Title` char(255) NOT NULL,
  `Tobic` longtext NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ImgUrl` char(255) DEFAULT NULL,
  `Author` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `opinionstable` (
  `ID` int(11) NOT NULL,
  `Name` char(255) NOT NULL DEFAULT 'Annymous',
  `Gender` char(255) NOT NULL DEFAULT 'Unkown',
  `ImgNumber` int(11) NOT NULL,
  `Opinion` text NOT NULL,
  `State` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `productstable` (
  `ID` int(11) NOT NULL,
  `SubCatID` int(11) NOT NULL,
  `Name` char(255) NOT NULL,
  `wasBought` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `spentsscheduletable` (
  `ID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `BudgetID` int(11) NOT NULL,
  `Every` text NOT NULL,
  `Times` int(11) NOT NULL DEFAULT '1',
  `StartDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `spentstable` (
  `ID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `BudgetID` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantitiy` int(11) NOT NULL DEFAULT '1',
  `Datepuhrcased` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `subcategoriestable` (
  `ID` int(11) NOT NULL,
  `CatID` int(11) NOT NULL,
  `Name` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `budgetstable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`,`BudgetName`);

ALTER TABLE `categoriestable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`,`Name`);

ALTER TABLE `incomesscheduletable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C10` (`BudgetID`);

ALTER TABLE `incomestable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C2` (`BudgetID`);

ALTER TABLE `newstable`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `opinionstable`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `productstable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `SubCatID` (`SubCatID`,`Name`);

ALTER TABLE `spentsscheduletable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C13` (`BudgetID`),
  ADD KEY `C14` (`ProductID`);

ALTER TABLE `spentstable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `C9` (`ProductID`),
  ADD KEY `C6` (`BudgetID`);

ALTER TABLE `subcategoriestable`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CatID` (`CatID`,`Name`);

ALTER TABLE `userstable`
  ADD PRIMARY KEY (`ID`);


ALTER TABLE `budgetstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `categoriestable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `incomesscheduletable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `incomestable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `newstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `opinionstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `productstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `spentsscheduletable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `spentstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `subcategoriestable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `userstable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `budgetstable`
  ADD CONSTRAINT `C1` FOREIGN KEY (`UserID`) REFERENCES `userstable` (`ID`) ON DELETE CASCADE;

ALTER TABLE `categoriestable`
  ADD CONSTRAINT `C3` FOREIGN KEY (`UserID`) REFERENCES `userstable` (`ID`) ON DELETE CASCADE;

ALTER TABLE `incomesscheduletable`
  ADD CONSTRAINT `C10` FOREIGN KEY (`BudgetID`) REFERENCES `budgetstable` (`ID`) ON DELETE CASCADE;

ALTER TABLE `incomestable`
  ADD CONSTRAINT `C2` FOREIGN KEY (`BudgetID`) REFERENCES `budgetstable` (`ID`) ON DELETE CASCADE;

ALTER TABLE `productstable`
  ADD CONSTRAINT `C5` FOREIGN KEY (`SubCatID`) REFERENCES `subcategoriestable` (`ID`) ON DELETE CASCADE;

ALTER TABLE `spentsscheduletable`
  ADD CONSTRAINT `C13` FOREIGN KEY (`BudgetID`) REFERENCES `budgetstable` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `C14` FOREIGN KEY (`ProductID`) REFERENCES `productstable` (`ID`);

ALTER TABLE `spentstable`
  ADD CONSTRAINT `C6` FOREIGN KEY (`BudgetID`) REFERENCES `budgetstable` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `C9` FOREIGN KEY (`ProductID`) REFERENCES `productstable` (`ID`);

ALTER TABLE `subcategoriestable`
  ADD CONSTRAINT `C4` FOREIGN KEY (`CatID`) REFERENCES `categoriestable` (`ID`) ON DELETE CASCADE;




ALTER TABLE `incomesscheduletable` CHANGE `Amount` `Amount` DECIMAL(10,2) NOT NULL;
ALTER TABLE `incomestable` CHANGE `Amount` `Amount` DECIMAL(10,2) NOT NULL;
ALTER TABLE `spentsscheduletable` CHANGE `Price` `Price` DECIMAL(10,2) NOT NULL;
ALTER TABLE `spentstable` CHANGE `Price` `Price` DECIMAL(10,2) NOT NULL;
ALTER TABLE `budgetstable` CHANGE `StartedMoney` `StartedMoney` DECIMAL(10,2) NOT NULL DEFAULT '0', CHANGE `Money` `Money` DECIMAL(10,2) NOT NULL DEFAULT '0', CHANGE `Spent` `Spent` DECIMAL(10,2) NOT NULL DEFAULT '0', CHANGE `Income` `Income` DECIMAL(10,2) NOT NULL DEFAULT '0';
ALTER TABLE `userstable` CHANGE `Age` `BirthDay` DATE NULL DEFAULT NULL;
ALTER TABLE `userstable` ADD `Gender` CHAR(10) NOT NULL DEFAULT 'Unkown' AFTER `BirthDay`;

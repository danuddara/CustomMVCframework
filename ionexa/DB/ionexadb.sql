-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2013 at 12:52 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ionexadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliations`
--

CREATE TABLE IF NOT EXISTS `affiliations` (
  `id` int(10) unsigned NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Type` varchar(60) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Affiliations_IProfile1_idx` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `affiliations`
--


-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `Id` int(11) NOT NULL,
  `Path` varchar(250) NOT NULL,
  `Content-type` varchar(30) NOT NULL,
  `Size` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `beautyfullpeople`
--

CREATE TABLE IF NOT EXISTS `beautyfullpeople` (
  `Id` int(11) NOT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  `Height` varchar(10) DEFAULT NULL,
  `Weight` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_MarrageProposal_IonexaProfile1_idx` (`IonexaProfileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `beautyfullpeople`
--


-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`Id`, `Name`) VALUES
(3, 'AUS'),
(1, 'SL'),
(2, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `countrycities`
--

CREATE TABLE IF NOT EXISTS `countrycities` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CountryId` int(10) unsigned NOT NULL,
  `StateId` int(10) unsigned DEFAULT NULL,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_CountryCities_Countries1_idx` (`CountryId`),
  KEY `fk_CountryCities_CountryStates1_idx` (`StateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `countrycities`
--

INSERT INTO `countrycities` (`Id`, `CountryId`, `StateId`, `Name`) VALUES
(1, 1, 1, 'Thalawathugoda'),
(2, 1, 2, 'Modara'),
(3, 1, 3, 'Udunuwera'),
(4, 2, 4, 'xxyyxx'),
(5, 2, 5, 'yyzzxx'),
(6, 3, 6, 'Wrxttt'),
(7, 3, 7, 'STIii');

-- --------------------------------------------------------

--
-- Table structure for table `countrystates`
--

CREATE TABLE IF NOT EXISTS `countrystates` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CountryId` int(10) unsigned NOT NULL,
  `State` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_CountryStates_Countries_idx` (`CountryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `countrystates`
--

INSERT INTO `countrystates` (`Id`, `CountryId`, `State`) VALUES
(1, 1, 'colombo'),
(2, 1, 'galle'),
(3, 1, 'Kandy'),
(4, 2, 'XYZ'),
(5, 2, 'ABC'),
(6, 3, 'WRX'),
(7, 3, 'STI');

-- --------------------------------------------------------

--
-- Table structure for table `donationtypes`
--

CREATE TABLE IF NOT EXISTS `donationtypes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donationtypes`
--


-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CountryId` int(10) unsigned DEFAULT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Type` varchar(30) NOT NULL COMMENT 'Highschool, University etc...',
  `Name` varchar(30) NOT NULL,
  `GraduationYear` date NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Education_IonexaProfile1_idx` (`UserId`),
  KEY `fk_Education_CountryStates1_idx` (`CountryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `education`
--


-- --------------------------------------------------------

--
-- Table structure for table `employement`
--

CREATE TABLE IF NOT EXISTS `employement` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CountryId` int(10) unsigned DEFAULT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `Employer` varchar(50) NOT NULL,
  `Designation` varchar(30) DEFAULT NULL,
  `From` date DEFAULT NULL,
  `To` date DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `IonexaProfileId_UNIQUE` (`UserID`),
  KEY `fk_Employement_Countries1_idx` (`CountryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `employement`
--


-- --------------------------------------------------------

--
-- Table structure for table `eventcalender`
--

CREATE TABLE IF NOT EXISTS `eventcalender` (
  `Id` int(11) NOT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventcalender`
--


-- --------------------------------------------------------

--
-- Table structure for table `eventlocation`
--

CREATE TABLE IF NOT EXISTS `eventlocation` (
  `EventsId` int(11) NOT NULL,
  `LocationsId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`EventsId`,`LocationsId`),
  KEY `fk_EventLocation_Events1_idx` (`EventsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventlocation`
--


-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `Id` int(11) NOT NULL,
  `IonexaGroupId` int(11) DEFAULT NULL,
  `Type` int(11) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `UpdateTime` datetime DEFAULT NULL,
  `Photo` varchar(45) DEFAULT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  `EventCalenderId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Events_IonexaProfile1_idx` (`IonexaProfileId`),
  KEY `fk_Events_EventCalender1_idx` (`EventCalenderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--


-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CountryId` int(10) unsigned NOT NULL,
  `iProfileID` int(10) unsigned DEFAULT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `DateOfBirth` datetime DEFAULT NULL,
  `Gender` tinyint(1) DEFAULT NULL,
  `Relationship` varchar(30) DEFAULT NULL,
  `IsBPMember` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Family_IonexaProfile1_idx` (`iProfileID`),
  KEY `fk_Family_Countries1_idx` (`CountryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`Id`, `CountryId`, `iProfileID`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `Relationship`, `IsBPMember`) VALUES
(1, 1, 6, 'Janaka', 'Wijesekera', '1959-08-08 00:00:00', 1, '103', 1),
(2, 3, 6, 'Padma', 'Wijesekera', '1962-04-03 00:00:00', 0, '102', 1),
(3, 2, 6, 'Tharindaa', 'Wijesekera', '1991-10-10 00:00:00', 1, '101', 0),
(4, 2, 62, 'John', 'Meera', '1962-10-10 00:00:00', 1, '103', 1),
(5, 2, 62, 'Jackson', 'Michel', '1963-10-12 00:00:00', 1, '101', 1),
(6, 3, 40, 'Testing ', 'Testing', '0000-00-00 00:00:00', 0, '100', NULL),
(7, 3, 40, 'Testing', 'Testing', '0000-00-00 00:00:00', 0, '100', 1),
(8, 3, 40, 'Testing2', 'Testing3', '0000-00-00 00:00:00', 0, '100', 1),
(9, 1, 62, 'Testing', 'Testing', '1997-01-01 00:00:00', 0, '100', 0),
(10, 1, 62, 'testing4d', 'testing4', '1939-03-01 00:00:00', 1, '102', 1),
(11, 1, 61, 'testing first', 'testing first ', '2000-01-01 00:00:00', 1, '103', 1),
(12, 3, 61, 'testing second', 'secpd', '2000-01-01 00:00:00', 0, '104', 0),
(13, 1, 61, 'testing third ', 'ok inserted ', '2000-01-01 00:00:00', 1, '102', 1),
(14, 1, 61, 'fourth ', 'entering', '1997-06-01 00:00:00', 1, '101', 0),
(15, 1, 61, 'fifth ', 'testing', '2000-01-01 00:00:00', 0, '100', 1),
(16, 1, 61, 'sixth', 'testing', '2000-01-01 00:00:00', 0, '100', 0),
(17, 3, 61, 'last ', 'test', '2000-01-01 00:00:00', 1, '100', 0),
(18, 3, 61, 'final', 'and last', '0000-00-00 00:00:00', 0, '100', 0),
(19, 2, 6, 'suresh', 'wijesekera', '0000-00-00 00:00:00', 1, '101', 0);

-- --------------------------------------------------------

--
-- Table structure for table `favoritesmusicband`
--

CREATE TABLE IF NOT EXISTS `favoritesmusicband` (
  `Id` int(11) NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Categories` varchar(30) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Artist` varchar(30) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `IonexaProfileID_UNIQUE` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favoritesmusicband`
--


-- --------------------------------------------------------

--
-- Table structure for table `favouritebooks`
--

CREATE TABLE IF NOT EXISTS `favouritebooks` (
  `Id` int(11) NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `GenreIds` varchar(30) NOT NULL,
  `Author` varchar(30) DEFAULT NULL,
  `Title` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_FavouriteBooks_IProfile1_idx` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favouritebooks`
--


-- --------------------------------------------------------

--
-- Table structure for table `favouritedestinations`
--

CREATE TABLE IF NOT EXISTS `favouritedestinations` (
  `Id` int(11) NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `CountryId` int(10) unsigned NOT NULL,
  `CityId` int(10) unsigned NOT NULL,
  `Type` varchar(30) NOT NULL,
  `TravelBy` varchar(30) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Geotag` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_FavouriteDestinations_IProfile1_idx` (`UserId`),
  KEY `fk_FavouriteDestinations_Countries1_idx` (`CountryId`),
  KEY `fk_FavouriteDestinations_CountryCities1_idx` (`CityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favouritedestinations`
--


-- --------------------------------------------------------

--
-- Table structure for table `favouritefood`
--

CREATE TABLE IF NOT EXISTS `favouritefood` (
  `Id` int(11) NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`,`UserId`),
  KEY `fk_FavouriteFood_IProfile1_idx` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favouritefood`
--


-- --------------------------------------------------------

--
-- Table structure for table `favouritemovietvstage`
--

CREATE TABLE IF NOT EXISTS `favouritemovietvstage` (
  `Id` int(10) unsigned NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `GenreIds` varchar(30) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_FavouriteStagePlays_IProfile1_idx` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favouritemovietvstage`
--


-- --------------------------------------------------------

--
-- Table structure for table `favouriteperson`
--

CREATE TABLE IF NOT EXISTS `favouriteperson` (
  `Id` int(11) NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`,`UserId`),
  KEY `fk_FavouritePerson_IProfile1_idx` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favouriteperson`
--


-- --------------------------------------------------------

--
-- Table structure for table `favouritesportteam`
--

CREATE TABLE IF NOT EXISTS `favouritesportteam` (
  `Id` int(11) NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`,`UserId`),
  KEY `fk_FavouriteSportTeam_IProfile1_idx` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favouritesportteam`
--


-- --------------------------------------------------------

--
-- Table structure for table `forgotpassword`
--

CREATE TABLE IF NOT EXISTS `forgotpassword` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserId` int(10) unsigned NOT NULL,
  `eMail` varchar(250) NOT NULL COMMENT 'Highschool, University etc...',
  `RequestedOn` datetime NOT NULL,
  `IsExpired` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  KEY `fk_Education_IonexaProfile1_idx` (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `forgotpassword`
--

INSERT INTO `forgotpassword` (`Id`, `UserId`, `eMail`, `RequestedOn`, `IsExpired`) VALUES
(1, 6, '6', '0000-00-00 00:00:00', 0),
(2, 6, '6', '0000-00-00 00:00:00', 0),
(3, 6, 'danuddara@live.com', '0000-00-00 00:00:00', 0),
(4, 6, 'danuddara@live.com', '2013-06-27 11:37:01', 0),
(5, 6, 'danuddara@live.com', '2013-06-27 11:45:01', 0),
(6, 6, 'danuddara@live.com', '2013-06-27 11:46:01', 0),
(7, 6, 'danuddara@live.com', '2013-06-27 11:50:01', 0),
(8, 6, 'danuddara@live.com', '2013-06-27 12:17:01', 0),
(9, 6, 'danuddara@live.com', '2013-06-27 12:38:01', 0),
(10, 6, 'danuddara@live.com', '2013-06-27 12:49:01', 0),
(11, 6, 'danuddara@live.com', '2013-06-27 12:52:01', 0),
(12, 6, 'danuddara@live.com', '2013-06-27 12:54:01', 0),
(13, 6, 'danuddara@live.com', '2013-06-27 12:57:01', 0),
(14, 6, 'danuddara@live.com', '2013-06-27 12:58:01', 0),
(15, 6, 'danuddara@live.com', '2013-06-28 05:25:01', 0),
(16, 6, 'danuddara@live.com', '2013-06-28 05:38:01', 0),
(17, 6, 'danuddara@live.com', '2013-06-28 05:39:01', 0),
(18, 6, 'danuddara@live.com', '2013-06-28 05:41:01', 0),
(19, 6, 'danuddara@live.com', '2013-06-28 05:44:01', 0),
(20, 6, 'danuddara@live.com', '2013-06-28 05:45:01', 0),
(21, 6, 'danuddara@live.com', '2013-06-28 05:46:01', 0),
(22, 6, 'danuddara@live.com', '2013-06-28 06:05:01', 0),
(23, 6, 'danuddara@live.com', '2013-06-28 06:27:01', 0),
(24, 6, 'danuddara@live.com', '2013-06-28 09:47:01', 0),
(25, 6, 'danuddara@live.com', '2013-06-28 09:50:01', 0),
(26, 6, 'danuddara@live.com', '2013-06-28 09:53:01', 0),
(27, 6, 'danuddara@live.com', '2013-06-28 09:55:01', 0),
(28, 6, 'danuddara@live.com', '2013-06-28 10:00:01', 0),
(29, 6, 'danuddara@live.com', '2013-06-28 10:02:01', 0),
(30, 6, 'danuddara@live.com', '2013-06-28 10:07:01', 0),
(31, 6, 'danuddara@live.com', '2013-06-28 10:09:01', 0),
(32, 6, 'danuddara@live.com', '2013-06-28 10:11:01', 0),
(33, 36, 'ameera@gmail.com', '2013-07-01 10:27:01', 0),
(34, 63, 'manori@live.com', '2013-07-03 10:42:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `friendblock`
--

CREATE TABLE IF NOT EXISTS `friendblock` (
  `Id` int(11) NOT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_FriendBlock_IonexaProfile1_idx` (`IonexaProfileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friendblock`
--


-- --------------------------------------------------------

--
-- Table structure for table `friendcomment`
--

CREATE TABLE IF NOT EXISTS `friendcomment` (
  `Id` int(11) NOT NULL,
  `Like` int(11) DEFAULT NULL,
  `Comment` varchar(200) DEFAULT NULL,
  `IonexaFriendsId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_FriendComment_IonexaFriends1_idx` (`IonexaFriendsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friendcomment`
--


-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`Id`, `Name`, `Description`) VALUES
(1, 'df', 'sdf'),
(2, 'tetingtwo', 'autoincrement'),
(3, 'dsf', 'sdf'),
(4, NULL, NULL),
(5, 'Test', 'Test'),
(6, 'Test', 'Test'),
(7, 'newtest', '');

-- --------------------------------------------------------

--
-- Table structure for table `helps`
--

CREATE TABLE IF NOT EXISTS `helps` (
  `Id` int(11) NOT NULL,
  `UserId` int(10) unsigned NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_IonexaNeed_IonexaProfile1_idx` (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `helps`
--


-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

CREATE TABLE IF NOT EXISTS `hobbies` (
  `id` int(11) NOT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Hobbies_IonexaProfile1` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hobbies`
--


-- --------------------------------------------------------

--
-- Table structure for table `ionexafriends`
--

CREATE TABLE IF NOT EXISTS `ionexafriends` (
  `id` int(11) NOT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  `FriendType` varchar(20) DEFAULT NULL,
  `FriendUpdates` varchar(250) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IonexaWallId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_IonexaFriends_IonexaProfile1_idx` (`IonexaProfileId`),
  KEY `fk_IonexaFriends_IonexaWall1_idx` (`IonexaWallId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ionexafriends`
--


-- --------------------------------------------------------

--
-- Table structure for table `ionexagroup`
--

CREATE TABLE IF NOT EXISTS `ionexagroup` (
  `Id` int(11) NOT NULL,
  `PhotoId` int(11) DEFAULT NULL,
  `Type` varchar(30) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `RecentUpdates` varchar(200) DEFAULT NULL,
  `EventsId` int(11) NOT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_IonexaGroup_Events1_idx` (`EventsId`),
  KEY `fk_IonexaGroup_IonexaProfile1_idx` (`IonexaProfileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ionexagroup`
--


-- --------------------------------------------------------

--
-- Table structure for table `ionexawall`
--

CREATE TABLE IF NOT EXISTS `ionexawall` (
  `id` int(11) NOT NULL,
  `UpdateType` varchar(60) DEFAULT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_IonexaWall_IonexaProfile1_idx` (`IonexaProfileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ionexawall`
--


-- --------------------------------------------------------

--
-- Table structure for table `iprofile`
--

CREATE TABLE IF NOT EXISTS `iprofile` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(40) NOT NULL,
  `SeconderyEmail` varchar(40) DEFAULT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `DateofBirth` date DEFAULT NULL,
  `Relationship` tinyint(4) DEFAULT NULL,
  `Height` varchar(5) DEFAULT NULL,
  `Weight` varchar(5) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `CountryId` int(10) unsigned NOT NULL,
  `StateId` int(10) unsigned DEFAULT NULL,
  `CityId` int(10) unsigned DEFAULT NULL,
  `Zipcode` varchar(30) DEFAULT NULL,
  `LivingStateId` int(10) unsigned DEFAULT NULL,
  `LivingCityId` int(10) unsigned DEFAULT NULL,
  `LivingCountryId` int(10) unsigned DEFAULT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `SeconderyEmail_UNIQUE` (`SeconderyEmail`),
  KEY `fk_IProfile_Countries1_idx` (`CountryId`),
  KEY `fk_IProfile_CountryStates1_idx` (`StateId`),
  KEY `fk_IProfile_CountryCities1_idx` (`CityId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `iprofile`
--

INSERT INTO `iprofile` (`Id`, `Email`, `SeconderyEmail`, `FirstName`, `LastName`, `Password`, `DateofBirth`, `Relationship`, `Height`, `Weight`, `Gender`, `Address`, `CountryId`, `StateId`, `CityId`, `Zipcode`, `LivingStateId`, `LivingCityId`, `LivingCountryId`, `Active`) VALUES
(5, 'pasindudanuddara@gmail.co', NULL, 'Pasindu', 'Wijesekera', 'b1b9b6bbb3a176dde426', '0000-00-00', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(6, 'danuddara@live.com', 'danuddara@gmail.com', 'Pasindu', 'Danuddara', 'b1b9b6bbb3a176dde42602fa155c1b7c', '1989-06-13', 0, '5'' 10', '83kg', 1, '95 D Meemanagoda Rd, kalalgoda', 3, 7, 7, '12234', 1, 1, 1, 1),
(7, 'malith@gmail.com', 'malith@live.com', 'Malith', 'Waniganayake', 'b1b9b6bbb3a176dde426', '1991-09-13', 1, '6'' 2', '30', 1, 'Nawala', 1, 1, NULL, NULL, NULL, 2, 2, 0),
(10, 'dlank@gmail.com', NULL, 'dila', 'iresh', 'b123', '1991-06-13', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(12, 'dilanke@gmail.com', NULL, 'dilanke', 'iresh', 'b1b9b6bbb3a176dde42602fa155c1b7c', '1988-08-13', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(18, 'dilankea@gmail.com', '', 'dilanke', 'iresh', '2131', '1988-08-13', 0, '', '', 0, NULL, 1, NULL, NULL, NULL, 0, 0, 0, 0),
(20, 'dilanketwo@gmail.com', NULL, 'dilanke', 'iresh', '2131', '1988-08-13', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(21, 'dilankethree@gmail.com', NULL, 'dilanke', 'iresh', '2131', '1988-08-13', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(22, 'chandime@gmail.com', NULL, 'chandime', 'kulugammana', 'b123', '1988-08-13', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(23, 'pasindudanu@live.com', NULL, 'madhwa', 'wijesuriya', '12312', '1989-05-13', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(24, 'madhwaww@live.com', NULL, 'madhwa', 'wijesuriya', '12312', '1989-05-13', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(25, 'seth@live.com', NULL, 'tharainda', 'seth', 'be5e826806fe6abcb12109e29689ee25', '1971-01-01', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(27, 'pasindudanuddara@gmail.com', NULL, 'pasindu', 'Wijesekera', 'b1b9b6bbb3a176dde42602fa155c1b7c', '1973-04-04', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 'heshavi@live.com', NULL, 'heshavi', 'wijesuriya', '12312', '1989-05-13', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, 'malikaa@live.com', NULL, 'heshaavi', 'wijesekera', '12312', '1989-05-13', 1, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, 'padma@live.com', NULL, 'padma', 'Wijesekera', '3f68707f928bdf8404a51ad6b9ae1386', '1972-01-01', 1, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(31, 'jayanthi@gmail.com', NULL, 'jayanthi', 'nanayakkara', 'c6891798c7ebc6332850451597e7c8e5', '1976-01-01', 1, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(32, 'migel@live.com', NULL, 'tharindu', 'migel', '6368ad93c9fa22ab35bf311477f74bd3', '1975-01-01', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(33, 'tetingupadart@live.com', NULL, 'update', 'wijesekera', '12312', '1989-05-13', 1, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(34, 'iresh@live.com', NULL, 'update', 'wijesekera', '12312', '1989-05-13', 1, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, 'silva@gmail.com', NULL, 'irusha', 'silva', '5ecc4aa302d527a68a6538d72190310d', '1971-01-01', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(36, 'ameera@gmail.com', NULL, 'ameera', 'haroon', '31079871a617fb3de3815cbad46ec344', '1971-01-01', 1, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(37, 'john@gmail.com', NULL, 'john', 'silva', '9c5b1af65acf1c1f1dd926ec91a3f380', '1975-01-01', 1, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(38, 'siripala@gmail.com', 'siripala@live.com', 'siripala', 'mudianselage', '0ad28f73d534e4cf3941a477375d1d75', '1981-07-11', 0, '5'' 11', '90kg', 1, '89 sad', 1, 2, 2, '12312', NULL, NULL, 2, 1),
(39, 'koma@gmail.com', NULL, 'moditha', 'komamulla', '7cfec3d1deabd4ea4ef6e3253468197e', '1972-01-01', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(40, 'gihanidikwatte@gmail.com', NULL, 'gihani', 'dikwatte ', '0b226f87dae6bd63c77cd49e681a0e04', '1973-01-01', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(41, 'hansika@gmail.com', NULL, 'sajini', 'hansika', '2f53b84274bfad2ea60a44ff120f526b', '1982-01-01', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(42, 'vinu@gmail.com', NULL, 'vinu', 'perera', '2345bd7d0969c30f77ade20af6ab6a1b', '1972-01-01', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(43, 'ama@gmail.com', NULL, 'Ama', 'Wijesekera', 'e292b1d68c8b480c49074ff1b6e266b8', '1973-01-01', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(44, 'namz@gmail.com', NULL, 'narmadhaq', 'wijsuriya', '0aa1ea9a5a04b78d4581dd6d17742627', '1988-05-09', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(45, 'thusha@gmail.com', NULL, 'thushara', 'silava', '0433e3038e208089eb74b7d9c8f5725f', '1977-10-10', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(46, 'tharanga@live.com', NULL, 'tharanga', 'silva', 'd62129ba57e53adea5189ce35e676842', '1986-06-11', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(47, 'dhanuka@gmail.com', NULL, 'dhanuka', 'ramanayake', '6050c06d360209a0d8af687f62bb07b7', '1982-09-08', 2, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(48, 'lasantha@gmail.com', NULL, 'lasantha', 'mahampitiya', '5d991f8b60f20149a25e089d26810147', '1986-04-03', 3, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(49, 'kade@gmail.com', NULL, 'rosa', 'Koopi', '4297f44b13955235245b2497399d7a93', NULL, 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(50, 'mike@live.com', NULL, 'mike', 'silva', 'b6808aa22d6d4e430ade6201c1dd273a', NULL, 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(51, 'gee@gmail.com', NULL, 'sachith', 'geeganage', '8ad3fac6c6b3528499d347d924443abb', NULL, 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(52, 'videha@live.com', NULL, 'hasitha', 'perera', 'f542bff6a515b4e3020e803d871c1932', '1988-04-14', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(53, 'bhagya@gmail.com', NULL, 'bhagya', 'perera', '7cfec3d1deabd4ea4ef6e3253468197e', '1975-01-01', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(54, 'migara@gmail.com', NULL, 'migara', 'liyanage', '3f68707f928bdf8404a51ad6b9ae1386', '1977-03-03', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(56, 'susha@live.com', NULL, 'shusha', 'perera', '0aa1ea9a5a04b78d4581dd6d17742627', '1999-01-01', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(57, 'asd@live.com', NULL, 'ads', 'asda', '1f0a061e287eb85c5ceabc5861632558', '1988-07-06', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(58, 'damsari@gmail.com', NULL, 'Damsari', 'anthoney', 'b3ddbc502e307665f346cbd6e52cc10d', '1988-03-05', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(59, 'bimsari@gmail.com', NULL, 'bimsari', 'perera', '8bdcd61fb289c786f59c9106eafdee24', '1999-05-04', 0, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(60, 'danu@live.com', NULL, 'danuddara', 'da', 'b3ddbc502e307665f346cbd6e52cc10d', '1989-06-13', 0, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(61, 'gihani@live.com', 'gihani@gmail.com', 'gihani', 'mudianselage', '16ffa5ae20e452c3a6d6aa837c0c6ad0', '1994-03-03', 6, '175', '49', 0, 'No 1 ,Makubura', 1, 1, 1, 'asd', NULL, NULL, 1, 1),
(62, 'meera@live.com', 'meera@hotmail.com', 'meera', 'meera', '55232d6cee75030476853a5ee47588fa', '1982-02-07', 6, '5'' 4', '45', 0, 'dubai', 1, 2, 2, '12234', NULL, NULL, 3, 1),
(63, 'manori@live.com', 'suba@gmail.com', 'manori', 'subashini', '2eee72afbec0af6f2bebc0600baf99c9', '1989-08-06', 1, '5'' 4', '45kg', 0, '89 D Hill Street', 3, 7, 7, '213', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `liketohelp`
--

CREATE TABLE IF NOT EXISTS `liketohelp` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_LikeToHelp_IonexaProfile1_idx` (`IonexaProfileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liketohelp`
--


-- --------------------------------------------------------

--
-- Table structure for table `lookingfor`
--

CREATE TABLE IF NOT EXISTS `lookingfor` (
  `id` int(11) NOT NULL,
  `Type` varchar(30) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `IonexaFriends_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_LookingFor_IonexaFriends1_idx` (`IonexaFriends_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lookingfor`
--


-- --------------------------------------------------------

--
-- Table structure for table `marrageproposal`
--

CREATE TABLE IF NOT EXISTS `marrageproposal` (
  `Id` int(11) NOT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_BeautyfullPeople_IonexaProfile1_idx` (`IonexaProfileId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marrageproposal`
--


-- --------------------------------------------------------

--
-- Table structure for table `messageattachments`
--

CREATE TABLE IF NOT EXISTS `messageattachments` (
  `MessageId` int(11) NOT NULL,
  `Attachments_Id` int(11) NOT NULL,
  PRIMARY KEY (`MessageId`,`Attachments_Id`),
  KEY `fk_MessageAttachments_Messages1_idx` (`MessageId`),
  KEY `fk_MessageAttachments_Attachments1_idx` (`Attachments_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messageattachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `Id` int(11) NOT NULL,
  `FromId` int(10) unsigned NOT NULL,
  `Subject` varchar(45) DEFAULT NULL,
  `Message` varchar(250) NOT NULL,
  `ToId` int(11) NOT NULL,
  `SentOn` datetime NOT NULL,
  PRIMARY KEY (`Id`,`FromId`),
  KEY `fk_Messages_IProfile1_idx` (`FromId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `musictypes`
--

CREATE TABLE IF NOT EXISTS `musictypes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `musictypes`
--


-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `Id` int(11) NOT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `IonexaFriendsId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Notification_IonexaFriends1_idx` (`IonexaFriendsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--


-- --------------------------------------------------------

--
-- Table structure for table `notificationhas`
--

CREATE TABLE IF NOT EXISTS `notificationhas` (
  `NotificationId` int(11) NOT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`NotificationId`,`IonexaProfileId`),
  KEY `fk_Notification_has_IonexaProfile_IonexaProfile1_idx` (`IonexaProfileId`),
  KEY `fk_Notification_has_IonexaProfile_Notification1_idx` (`NotificationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notificationhas`
--


-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `Id` int(11) NOT NULL,
  `Caption` varchar(100) DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `PhotoAlbumId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_Photo_PhotoAlbum1_idx` (`PhotoAlbumId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--


-- --------------------------------------------------------

--
-- Table structure for table `photoalbum`
--

CREATE TABLE IF NOT EXISTS `photoalbum` (
  `Id` int(11) NOT NULL,
  `PhotoUrl` varchar(250) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Created` date DEFAULT NULL,
  `IonexaProfileId` int(10) unsigned NOT NULL,
  `IonexaGroupId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_PhotoAlbum_IonexaProfile1_idx` (`IonexaProfileId`),
  KEY `fk_PhotoAlbum_IonexaGroup1_idx` (`IonexaGroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photoalbum`
--


-- --------------------------------------------------------

--
-- Table structure for table `photolocation`
--

CREATE TABLE IF NOT EXISTS `photolocation` (
  `PhotoAlbumId` int(11) NOT NULL,
  `LocationsId` int(10) unsigned NOT NULL,
  `PhotoId` int(11) NOT NULL,
  KEY `fk_PhotoLocation_PhotoAlbum1_idx` (`PhotoAlbumId`),
  KEY `fk_PhotoLocation_Photo1_idx` (`PhotoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photolocation`
--


-- --------------------------------------------------------

--
-- Table structure for table `phototag`
--

CREATE TABLE IF NOT EXISTS `phototag` (
  `id` int(11) NOT NULL,
  `Position` varchar(45) DEFAULT NULL,
  `UserId` int(10) unsigned DEFAULT NULL,
  `PhotoId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_PhotoTag_IonexaProfile1_idx` (`UserId`),
  KEY `fk_PhotoTag_Photo1_idx` (`PhotoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phototag`
--


-- --------------------------------------------------------

--
-- Table structure for table `photovote`
--

CREATE TABLE IF NOT EXISTS `photovote` (
  `Id` int(11) NOT NULL,
  `IonexaProfileId` int(10) unsigned DEFAULT NULL,
  `Like` int(11) DEFAULT NULL,
  `Comment` varchar(200) DEFAULT NULL,
  `PhotoId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `fk_PhotoVote_Photo1_idx` (`PhotoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photovote`
--


-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE IF NOT EXISTS `privacy` (
  `Id` int(11) NOT NULL,
  `AllContent` int(11) DEFAULT NULL,
  `BasicInfo` int(11) DEFAULT NULL,
  `ExtendedInfo` int(11) DEFAULT NULL,
  `LikeToHelp` int(11) DEFAULT NULL,
  `Photos` int(11) DEFAULT NULL,
  `FriendList` int(11) DEFAULT NULL,
  `Announcements` int(11) DEFAULT NULL,
  `Need` int(11) DEFAULT NULL,
  `Events` int(11) DEFAULT NULL,
  `EventCalendar` int(11) DEFAULT NULL,
  `IonexaSettingId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privacy`
--


-- --------------------------------------------------------

--
-- Table structure for table `volunteertypes`
--

CREATE TABLE IF NOT EXISTS `volunteertypes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteertypes`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliations`
--
ALTER TABLE `affiliations`
  ADD CONSTRAINT `fk_Affiliations_IProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `beautyfullpeople`
--
ALTER TABLE `beautyfullpeople`
  ADD CONSTRAINT `fk_MarrageProposal_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `countrycities`
--
ALTER TABLE `countrycities`
  ADD CONSTRAINT `fk_CountryCities_Countries1` FOREIGN KEY (`CountryId`) REFERENCES `countries` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CountryCities_CountryStates1` FOREIGN KEY (`StateId`) REFERENCES `countrystates` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `countrystates`
--
ALTER TABLE `countrystates`
  ADD CONSTRAINT `fk_CountryStates_Countries` FOREIGN KEY (`CountryId`) REFERENCES `countries` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `fk_Education_CountryStates1` FOREIGN KEY (`CountryId`) REFERENCES `countrystates` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Education_IonexaProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employement`
--
ALTER TABLE `employement`
  ADD CONSTRAINT `fk_Employement_Countries1` FOREIGN KEY (`CountryId`) REFERENCES `countries` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Work_IonexaProfile1` FOREIGN KEY (`UserID`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventlocation`
--
ALTER TABLE `eventlocation`
  ADD CONSTRAINT `fk_EventLocation_Events1` FOREIGN KEY (`EventsId`) REFERENCES `events` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_Events_EventCalender1` FOREIGN KEY (`EventCalenderId`) REFERENCES `eventcalender` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Events_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `family`
--
ALTER TABLE `family`
  ADD CONSTRAINT `fk_Family_Countries1` FOREIGN KEY (`CountryId`) REFERENCES `countries` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Family_IonexaProfile1` FOREIGN KEY (`iProfileID`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favoritesmusicband`
--
ALTER TABLE `favoritesmusicband`
  ADD CONSTRAINT `fk_PersonalFavorites_IonexaProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favouritebooks`
--
ALTER TABLE `favouritebooks`
  ADD CONSTRAINT `fk_FavouriteBooks_IProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favouritedestinations`
--
ALTER TABLE `favouritedestinations`
  ADD CONSTRAINT `fk_FavouriteDestinations_Countries1` FOREIGN KEY (`CountryId`) REFERENCES `countries` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FavouriteDestinations_CountryCities1` FOREIGN KEY (`CityId`) REFERENCES `countrycities` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FavouriteDestinations_IProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favouritefood`
--
ALTER TABLE `favouritefood`
  ADD CONSTRAINT `fk_FavouriteFood_IProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favouritemovietvstage`
--
ALTER TABLE `favouritemovietvstage`
  ADD CONSTRAINT `fk_FavouriteStagePlays_IProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favouriteperson`
--
ALTER TABLE `favouriteperson`
  ADD CONSTRAINT `fk_FavouritePerson_IProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favouritesportteam`
--
ALTER TABLE `favouritesportteam`
  ADD CONSTRAINT `fk_FavouriteSportTeam_IProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD CONSTRAINT `fk_Education_IonexaProfile10` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friendblock`
--
ALTER TABLE `friendblock`
  ADD CONSTRAINT `fk_FriendBlock_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friendcomment`
--
ALTER TABLE `friendcomment`
  ADD CONSTRAINT `fk_FriendComment_IonexaFriends1` FOREIGN KEY (`IonexaFriendsId`) REFERENCES `ionexafriends` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `helps`
--
ALTER TABLE `helps`
  ADD CONSTRAINT `fk_IonexaNeed_IonexaProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD CONSTRAINT `fk_Hobbies_IonexaProfile1` FOREIGN KEY (`UserID`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ionexafriends`
--
ALTER TABLE `ionexafriends`
  ADD CONSTRAINT `fk_IonexaFriends_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_IonexaFriends_IonexaWall1` FOREIGN KEY (`IonexaWallId`) REFERENCES `ionexawall` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ionexagroup`
--
ALTER TABLE `ionexagroup`
  ADD CONSTRAINT `fk_IonexaGroup_Events1` FOREIGN KEY (`EventsId`) REFERENCES `events` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_IonexaGroup_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ionexawall`
--
ALTER TABLE `ionexawall`
  ADD CONSTRAINT `fk_IonexaWall_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `iprofile`
--
ALTER TABLE `iprofile`
  ADD CONSTRAINT `fk_IProfile_Countries1` FOREIGN KEY (`CountryId`) REFERENCES `countries` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_IProfile_CountryCities1` FOREIGN KEY (`CityId`) REFERENCES `countrycities` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_IProfile_CountryStates1` FOREIGN KEY (`StateId`) REFERENCES `countrystates` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `liketohelp`
--
ALTER TABLE `liketohelp`
  ADD CONSTRAINT `fk_LikeToHelp_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lookingfor`
--
ALTER TABLE `lookingfor`
  ADD CONSTRAINT `fk_LookingFor_IonexaFriends1` FOREIGN KEY (`IonexaFriends_id`) REFERENCES `ionexafriends` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `marrageproposal`
--
ALTER TABLE `marrageproposal`
  ADD CONSTRAINT `fk_BeautyfullPeople_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messageattachments`
--
ALTER TABLE `messageattachments`
  ADD CONSTRAINT `fk_MessageAttachments_Attachments1` FOREIGN KEY (`Attachments_Id`) REFERENCES `attachments` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MessageAttachments_Messages1` FOREIGN KEY (`MessageId`) REFERENCES `messages` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_Messages_IProfile1` FOREIGN KEY (`FromId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_Notification_IonexaFriends1` FOREIGN KEY (`IonexaFriendsId`) REFERENCES `ionexafriends` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notificationhas`
--
ALTER TABLE `notificationhas`
  ADD CONSTRAINT `fk_Notification_has_IonexaProfile_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Notification_has_IonexaProfile_Notification1` FOREIGN KEY (`NotificationId`) REFERENCES `notification` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_Photo_PhotoAlbum1` FOREIGN KEY (`PhotoAlbumId`) REFERENCES `photoalbum` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `photoalbum`
--
ALTER TABLE `photoalbum`
  ADD CONSTRAINT `fk_PhotoAlbum_IonexaGroup1` FOREIGN KEY (`IonexaGroupId`) REFERENCES `ionexagroup` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PhotoAlbum_IonexaProfile1` FOREIGN KEY (`IonexaProfileId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `photolocation`
--
ALTER TABLE `photolocation`
  ADD CONSTRAINT `fk_PhotoLocation_Photo1` FOREIGN KEY (`PhotoId`) REFERENCES `photo` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PhotoLocation_PhotoAlbum1` FOREIGN KEY (`PhotoAlbumId`) REFERENCES `photoalbum` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `phototag`
--
ALTER TABLE `phototag`
  ADD CONSTRAINT `fk_PhotoTag_IonexaProfile1` FOREIGN KEY (`UserId`) REFERENCES `iprofile` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PhotoTag_Photo1` FOREIGN KEY (`PhotoId`) REFERENCES `photo` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `photovote`
--
ALTER TABLE `photovote`
  ADD CONSTRAINT `fk_PhotoVote_Photo1` FOREIGN KEY (`PhotoId`) REFERENCES `photo` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

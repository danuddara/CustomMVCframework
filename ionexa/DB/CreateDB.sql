SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `ionexadb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ionexadb` ;

-- -----------------------------------------------------
-- Table `ionexadb`.`Countries`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Countries` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `Name` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`Id`) ,
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`CountryStates`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`CountryStates` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `CountryId` INT UNSIGNED NOT NULL ,
  `State` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_CountryStates_Countries_idx` (`CountryId` ASC) ,
  CONSTRAINT `fk_CountryStates_Countries`
    FOREIGN KEY (`CountryId` )
    REFERENCES `ionexadb`.`Countries` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`CountryCities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`CountryCities` (
  `Id` INT UNSIGNED NOT NULL ,
  `CountryId` INT UNSIGNED NOT NULL ,
  `StateId` INT UNSIGNED NULL ,
  `Name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_CountryCities_Countries1_idx` (`CountryId` ASC) ,
  INDEX `fk_CountryCities_CountryStates1_idx` (`StateId` ASC) ,
  CONSTRAINT `fk_CountryCities_Countries1`
    FOREIGN KEY (`CountryId` )
    REFERENCES `ionexadb`.`Countries` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CountryCities_CountryStates1`
    FOREIGN KEY (`StateId` )
    REFERENCES `ionexadb`.`CountryStates` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`IProfile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`IProfile` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `Email` VARCHAR(25) NOT NULL ,
  `SeconderyEmail` VARCHAR(25) NOT NULL ,
  `FirstName` VARCHAR(30) NOT NULL ,
  `LastName` VARCHAR(30) NOT NULL ,
  `Password` VARCHAR(20) NOT NULL ,
  `DateofBirth` DATE NULL ,
  `Relationship` TINYINT NULL ,
  `Height` VARCHAR(5) NULL ,
  `Weight` VARCHAR(5) NULL ,
  `Gender` TINYINT NULL ,
  `CountryId` INT UNSIGNED NOT NULL ,
  `StateId` INT UNSIGNED NOT NULL ,
  `CityId` INT UNSIGNED NOT NULL ,
  `LivingStateId` INT UNSIGNED NULL ,
  `LivingCityId` INT UNSIGNED NULL ,
  `LivingCountryId` INT UNSIGNED NULL ,
  PRIMARY KEY (`Id`) ,
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC) ,
  UNIQUE INDEX `SeconderyEmail_UNIQUE` (`SeconderyEmail` ASC) ,
  INDEX `fk_IProfile_Countries1_idx` (`CountryId` ASC) ,
  INDEX `fk_IProfile_CountryStates1_idx` (`StateId` ASC) ,
  INDEX `fk_IProfile_CountryCities1_idx` (`CityId` ASC) ,
  CONSTRAINT `fk_IProfile_Countries1`
    FOREIGN KEY (`CountryId` )
    REFERENCES `ionexadb`.`Countries` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_IProfile_CountryStates1`
    FOREIGN KEY (`StateId` )
    REFERENCES `ionexadb`.`CountryStates` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_IProfile_CountryCities1`
    FOREIGN KEY (`CityId` )
    REFERENCES `ionexadb`.`CountryCities` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Family`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Family` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `CountryId` INT UNSIGNED NOT NULL ,
  `iProfileID` INT UNSIGNED NULL ,
  `FirstName` VARCHAR(30) NOT NULL ,
  `LastName` VARCHAR(30) NULL ,
  `DateOfBirth` DATETIME NULL ,
  `Gender` TINYINT(1) NULL ,
  `Relationship` VARCHAR(30) NULL ,
  `IsBPMember` TINYINT(1) NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_Family_IonexaProfile1_idx` (`iProfileID` ASC) ,
  INDEX `fk_Family_Countries1_idx` (`CountryId` ASC) ,
  CONSTRAINT `fk_Family_IonexaProfile1`
    FOREIGN KEY (`iProfileID` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Family_Countries1`
    FOREIGN KEY (`CountryId` )
    REFERENCES `ionexadb`.`Countries` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Education`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Education` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `CountryId` INT UNSIGNED NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `Type` VARCHAR(30) NOT NULL COMMENT 'Highschool, University etc...' ,
  `Name` VARCHAR(30) NOT NULL ,
  `GraduationYear` DATE NOT NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_Education_IonexaProfile1_idx` (`UserId` ASC) ,
  INDEX `fk_Education_CountryStates1_idx` (`CountryId` ASC) ,
  CONSTRAINT `fk_Education_IonexaProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Education_CountryStates1`
    FOREIGN KEY (`CountryId` )
    REFERENCES `ionexadb`.`CountryStates` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Employement`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Employement` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `CountryId` INT UNSIGNED NULL ,
  `UserID` INT UNSIGNED NOT NULL ,
  `Employer` VARCHAR(50) NOT NULL ,
  `Designation` VARCHAR(30) NULL ,
  `From` DATE NULL ,
  `To` DATE NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`) ,
  UNIQUE INDEX `IonexaProfileId_UNIQUE` (`UserID` ASC) ,
  INDEX `fk_Employement_Countries1_idx` (`CountryId` ASC) ,
  CONSTRAINT `fk_Work_IonexaProfile1`
    FOREIGN KEY (`UserID` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Employement_Countries1`
    FOREIGN KEY (`CountryId` )
    REFERENCES `ionexadb`.`Countries` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Affiliations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Affiliations` (
  `id` INT UNSIGNED NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `Name` VARCHAR(30) NULL ,
  `Type` VARCHAR(60) NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Affiliations_IProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_Affiliations_IProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Hobbies`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Hobbies` (
  `id` INT NOT NULL ,
  `UserID` INT UNSIGNED NOT NULL ,
  `Name` VARCHAR(30) NOT NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_Hobbies_IonexaProfile1`
    FOREIGN KEY (`UserID` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FavoritesMusicBand`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FavoritesMusicBand` (
  `Id` INT NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `Categories` VARCHAR(30) NOT NULL ,
  `Type` VARCHAR(30) NOT NULL ,
  `Title` VARCHAR(150) NOT NULL ,
  `Artist` VARCHAR(30) NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`) ,
  UNIQUE INDEX `IonexaProfileID_UNIQUE` (`UserId` ASC) ,
  CONSTRAINT `fk_PersonalFavorites_IonexaProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`EventCalender`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`EventCalender` (
  `Id` INT NOT NULL ,
  `Subject` VARCHAR(100) NULL ,
  `Description` VARCHAR(250) NULL ,
  `StartDate` DATETIME NULL ,
  `EndDate` DATETIME NULL ,
  PRIMARY KEY (`Id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Events`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Events` (
  `Id` INT NOT NULL ,
  `IonexaGroupId` INT NULL ,
  `Type` INT NULL ,
  `Subject` VARCHAR(100) NULL ,
  `Description` VARCHAR(250) NULL ,
  `StartTime` DATETIME NULL ,
  `EndTime` DATETIME NULL ,
  `UpdateTime` DATETIME NULL ,
  `Photo` VARCHAR(45) NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  `EventCalenderId` INT NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_Events_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  INDEX `fk_Events_EventCalender1_idx` (`EventCalenderId` ASC) ,
  CONSTRAINT `fk_Events_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Events_EventCalender1`
    FOREIGN KEY (`EventCalenderId` )
    REFERENCES `ionexadb`.`EventCalender` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`IonexaGroup`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`IonexaGroup` (
  `Id` INT NOT NULL ,
  `PhotoId` INT NULL ,
  `Type` VARCHAR(30) NULL ,
  `Name` VARCHAR(100) NULL ,
  `Description` VARCHAR(45) NULL ,
  `RecentUpdates` VARCHAR(200) NULL ,
  `EventsId` INT NOT NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_IonexaGroup_Events1_idx` (`EventsId` ASC) ,
  INDEX `fk_IonexaGroup_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  CONSTRAINT `fk_IonexaGroup_Events1`
    FOREIGN KEY (`EventsId` )
    REFERENCES `ionexadb`.`Events` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_IonexaGroup_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`PhotoAlbum`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`PhotoAlbum` (
  `Id` INT NOT NULL ,
  `PhotoUrl` VARCHAR(250) NULL ,
  `Description` VARCHAR(250) NULL ,
  `Created` DATE NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  `IonexaGroupId` INT NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_PhotoAlbum_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  INDEX `fk_PhotoAlbum_IonexaGroup1_idx` (`IonexaGroupId` ASC) ,
  CONSTRAINT `fk_PhotoAlbum_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PhotoAlbum_IonexaGroup1`
    FOREIGN KEY (`IonexaGroupId` )
    REFERENCES `ionexadb`.`IonexaGroup` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Photo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Photo` (
  `Id` INT NOT NULL ,
  `Caption` VARCHAR(100) NULL ,
  `Created` DATETIME NULL ,
  `PhotoAlbumId` INT NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_Photo_PhotoAlbum1_idx` (`PhotoAlbumId` ASC) ,
  CONSTRAINT `fk_Photo_PhotoAlbum1`
    FOREIGN KEY (`PhotoAlbumId` )
    REFERENCES `ionexadb`.`PhotoAlbum` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`PhotoLocation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`PhotoLocation` (
  `PhotoAlbumId` INT NOT NULL ,
  `LocationsId` INT UNSIGNED NOT NULL ,
  `PhotoId` INT NOT NULL ,
  INDEX `fk_PhotoLocation_PhotoAlbum1_idx` (`PhotoAlbumId` ASC) ,
  INDEX `fk_PhotoLocation_Photo1_idx` (`PhotoId` ASC) ,
  CONSTRAINT `fk_PhotoLocation_PhotoAlbum1`
    FOREIGN KEY (`PhotoAlbumId` )
    REFERENCES `ionexadb`.`PhotoAlbum` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PhotoLocation_Photo1`
    FOREIGN KEY (`PhotoId` )
    REFERENCES `ionexadb`.`Photo` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`PhotoTag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`PhotoTag` (
  `id` INT NOT NULL ,
  `Position` VARCHAR(45) NULL ,
  `UserId` INT UNSIGNED NULL ,
  `PhotoId` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_PhotoTag_IonexaProfile1_idx` (`UserId` ASC) ,
  INDEX `fk_PhotoTag_Photo1_idx` (`PhotoId` ASC) ,
  CONSTRAINT `fk_PhotoTag_IonexaProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PhotoTag_Photo1`
    FOREIGN KEY (`PhotoId` )
    REFERENCES `ionexadb`.`Photo` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`IonexaWall`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`IonexaWall` (
  `id` INT NOT NULL ,
  `UpdateType` VARCHAR(60) NULL ,
  `Description` VARCHAR(300) NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_IonexaWall_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  CONSTRAINT `fk_IonexaWall_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`IonexaFriends`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`IonexaFriends` (
  `id` INT NOT NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  `FriendType` VARCHAR(20) NULL ,
  `FriendUpdates` VARCHAR(250) NULL ,
  `UpdateDate` DATETIME NULL ,
  `IonexaWallId` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_IonexaFriends_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  INDEX `fk_IonexaFriends_IonexaWall1_idx` (`IonexaWallId` ASC) ,
  CONSTRAINT `fk_IonexaFriends_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_IonexaFriends_IonexaWall1`
    FOREIGN KEY (`IonexaWallId` )
    REFERENCES `ionexadb`.`IonexaWall` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`LookingFor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`LookingFor` (
  `id` INT NOT NULL ,
  `Type` VARCHAR(30) NULL ,
  `Description` VARCHAR(250) NULL ,
  `IonexaFriends_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_LookingFor_IonexaFriends1_idx` (`IonexaFriends_id` ASC) ,
  CONSTRAINT `fk_LookingFor_IonexaFriends1`
    FOREIGN KEY (`IonexaFriends_id` )
    REFERENCES `ionexadb`.`IonexaFriends` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`EventLocation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`EventLocation` (
  `EventsId` INT NOT NULL ,
  `LocationsId` INT UNSIGNED NOT NULL ,
  INDEX `fk_EventLocation_Events1_idx` (`EventsId` ASC) ,
  PRIMARY KEY (`EventsId`, `LocationsId`) ,
  CONSTRAINT `fk_EventLocation_Events1`
    FOREIGN KEY (`EventsId` )
    REFERENCES `ionexadb`.`Events` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`PhotoVote`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`PhotoVote` (
  `Id` INT NOT NULL ,
  `IonexaProfileId` INT UNSIGNED NULL ,
  `Like` INT NULL ,
  `Comment` VARCHAR(200) NULL ,
  `PhotoId` INT NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_PhotoVote_Photo1_idx` (`PhotoId` ASC) ,
  CONSTRAINT `fk_PhotoVote_Photo1`
    FOREIGN KEY (`PhotoId` )
    REFERENCES `ionexadb`.`Photo` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FriendComment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FriendComment` (
  `Id` INT NOT NULL ,
  `Like` INT NULL ,
  `Comment` VARCHAR(200) NULL ,
  `IonexaFriendsId` INT NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_FriendComment_IonexaFriends1_idx` (`IonexaFriendsId` ASC) ,
  CONSTRAINT `fk_FriendComment_IonexaFriends1`
    FOREIGN KEY (`IonexaFriendsId` )
    REFERENCES `ionexadb`.`IonexaFriends` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FriendBlock`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FriendBlock` (
  `Id` INT NOT NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_FriendBlock_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  CONSTRAINT `fk_FriendBlock_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`MarrageProposal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`MarrageProposal` (
  `Id` INT NOT NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_BeautyfullPeople_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  CONSTRAINT `fk_BeautyfullPeople_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`BeautyfullPeople`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`BeautyfullPeople` (
  `Id` INT NOT NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  `Height` VARCHAR(10) NULL ,
  `Weight` VARCHAR(10) NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_MarrageProposal_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  CONSTRAINT `fk_MarrageProposal_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Messages` (
  `Id` INT NOT NULL ,
  `FromId` INT UNSIGNED NOT NULL ,
  `Subject` VARCHAR(45) NULL ,
  `Message` VARCHAR(250) NOT NULL ,
  `ToId` INT NOT NULL ,
  `SentOn` DATETIME NOT NULL ,
  PRIMARY KEY (`Id`, `FromId`) ,
  INDEX `fk_Messages_IProfile1_idx` (`FromId` ASC) ,
  CONSTRAINT `fk_Messages_IProfile1`
    FOREIGN KEY (`FromId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Notification`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Notification` (
  `Id` INT NOT NULL ,
  `Subject` VARCHAR(100) NULL ,
  `Description` VARCHAR(250) NULL ,
  `IonexaFriendsId` INT NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_Notification_IonexaFriends1_idx` (`IonexaFriendsId` ASC) ,
  CONSTRAINT `fk_Notification_IonexaFriends1`
    FOREIGN KEY (`IonexaFriendsId` )
    REFERENCES `ionexadb`.`IonexaFriends` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`NotificationHas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`NotificationHas` (
  `NotificationId` INT NOT NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`NotificationId`, `IonexaProfileId`) ,
  INDEX `fk_Notification_has_IonexaProfile_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  INDEX `fk_Notification_has_IonexaProfile_Notification1_idx` (`NotificationId` ASC) ,
  CONSTRAINT `fk_Notification_has_IonexaProfile_Notification1`
    FOREIGN KEY (`NotificationId` )
    REFERENCES `ionexadb`.`Notification` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Notification_has_IonexaProfile_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Helps`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Helps` (
  `Id` INT NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `Type` TINYINT NOT NULL ,
  `Subject` VARCHAR(100) NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_IonexaNeed_IonexaProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_IonexaNeed_IonexaProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Privacy`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Privacy` (
  `Id` INT NOT NULL ,
  `AllContent` INT NULL ,
  `BasicInfo` INT NULL ,
  `ExtendedInfo` INT NULL ,
  `LikeToHelp` INT NULL ,
  `Photos` INT NULL ,
  `FriendList` INT NULL ,
  `Announcements` INT NULL ,
  `Need` INT NULL ,
  `Events` INT NULL ,
  `EventCalendar` INT NULL ,
  `IonexaSettingId` INT NOT NULL ,
  PRIMARY KEY (`Id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`LikeToHelp`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`LikeToHelp` (
  `Id` INT NOT NULL ,
  `UserId` INT NULL ,
  `IonexaProfileId` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_LikeToHelp_IonexaProfile1_idx` (`IonexaProfileId` ASC) ,
  CONSTRAINT `fk_LikeToHelp_IonexaProfile1`
    FOREIGN KEY (`IonexaProfileId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`ForgotPassword`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`ForgotPassword` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `UserId` INT UNSIGNED NOT NULL ,
  `eMail` VARCHAR(250) NOT NULL COMMENT 'Highschool, University etc...' ,
  `RequestedOn` DATETIME NOT NULL ,
  `IsExpired` TINYINT(1) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_Education_IonexaProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_Education_IonexaProfile10`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FavouriteBooks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FavouriteBooks` (
  `Id` INT NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `GenreIds` VARCHAR(30) NOT NULL ,
  `Author` VARCHAR(30) NULL ,
  `Title` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_FavouriteBooks_IProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_FavouriteBooks_IProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Genres`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Genres` (
  `Id` INT NOT NULL ,
  `Name` VARCHAR(30) NOT NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FavouriteMovieTVStage`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FavouriteMovieTVStage` (
  `Id` INT UNSIGNED NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `GenreIds` VARCHAR(30) NOT NULL ,
  `Type` TINYINT NOT NULL ,
  `Name` VARCHAR(30) NOT NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_FavouriteStagePlays_IProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_FavouriteStagePlays_IProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`MusicTypes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`MusicTypes` (
  `Id` INT NOT NULL ,
  `Name` VARCHAR(30) NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FavouriteDestinations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FavouriteDestinations` (
  `Id` INT NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `CountryId` INT UNSIGNED NOT NULL ,
  `CityId` INT UNSIGNED NOT NULL ,
  `Type` VARCHAR(30) NOT NULL ,
  `TravelBy` VARCHAR(30) NULL ,
  `Description` VARCHAR(250) NULL ,
  `Geotag` VARCHAR(20) NULL ,
  PRIMARY KEY (`Id`) ,
  INDEX `fk_FavouriteDestinations_IProfile1_idx` (`UserId` ASC) ,
  INDEX `fk_FavouriteDestinations_Countries1_idx` (`CountryId` ASC) ,
  INDEX `fk_FavouriteDestinations_CountryCities1_idx` (`CityId` ASC) ,
  CONSTRAINT `fk_FavouriteDestinations_IProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FavouriteDestinations_Countries1`
    FOREIGN KEY (`CountryId` )
    REFERENCES `ionexadb`.`Countries` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FavouriteDestinations_CountryCities1`
    FOREIGN KEY (`CityId` )
    REFERENCES `ionexadb`.`CountryCities` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FavouriteFood`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FavouriteFood` (
  `Id` INT NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `Name` VARCHAR(30) NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`, `UserId`) ,
  INDEX `fk_FavouriteFood_IProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_FavouriteFood_IProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FavouritePerson`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FavouritePerson` (
  `Id` INT NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `Type` VARCHAR(30) NOT NULL ,
  `Name` VARCHAR(30) NOT NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`, `UserId`) ,
  INDEX `fk_FavouritePerson_IProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_FavouritePerson_IProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`FavouriteSportTeam`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`FavouriteSportTeam` (
  `Id` INT NOT NULL ,
  `UserId` INT UNSIGNED NOT NULL ,
  `Type` VARCHAR(30) NOT NULL ,
  `Name` VARCHAR(30) NOT NULL ,
  `Description` VARCHAR(250) NULL ,
  PRIMARY KEY (`Id`, `UserId`) ,
  INDEX `fk_FavouriteSportTeam_IProfile1_idx` (`UserId` ASC) ,
  CONSTRAINT `fk_FavouriteSportTeam_IProfile1`
    FOREIGN KEY (`UserId` )
    REFERENCES `ionexadb`.`IProfile` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`DonationTypes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`DonationTypes` (
  `Id` INT NOT NULL ,
  `Name` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`Id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`Attachments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`Attachments` (
  `Id` INT NOT NULL ,
  `Path` VARCHAR(250) NOT NULL ,
  `Content-type` VARCHAR(30) NOT NULL ,
  `Size` INT NOT NULL ,
  PRIMARY KEY (`Id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`MessageAttachments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`MessageAttachments` (
  `MessageId` INT NOT NULL ,
  `Attachments_Id` INT NOT NULL ,
  PRIMARY KEY (`MessageId`, `Attachments_Id`) ,
  INDEX `fk_MessageAttachments_Messages1_idx` (`MessageId` ASC) ,
  INDEX `fk_MessageAttachments_Attachments1_idx` (`Attachments_Id` ASC) ,
  CONSTRAINT `fk_MessageAttachments_Messages1`
    FOREIGN KEY (`MessageId` )
    REFERENCES `ionexadb`.`Messages` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MessageAttachments_Attachments1`
    FOREIGN KEY (`Attachments_Id` )
    REFERENCES `ionexadb`.`Attachments` (`Id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ionexadb`.`VolunteerTypes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ionexadb`.`VolunteerTypes` (
  `Id` INT NOT NULL ,
  `Name` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`Id`) )
ENGINE = InnoDB;

USE `ionexadb` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

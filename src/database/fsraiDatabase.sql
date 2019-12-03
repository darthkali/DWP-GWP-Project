-- MySQL Script generated by MySQL Workbench
-- Tue Dec  3 10:21:07 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema fsraiDatabase
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `fsraiDatabase` ;

-- -----------------------------------------------------
-- Schema fsraiDatabase
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `fsraiDatabase` DEFAULT CHARACTER SET utf8 ;
USE `fsraiDatabase` ;

-- -----------------------------------------------------
-- Table `fsraiDatabase`.`ROLE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`ROLE` ;

CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`ROLE` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `NAME` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`ID`));


-- -----------------------------------------------------
-- Table `fsraiDatabase`.`USER`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`USER` ;

CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`USER` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `FIRSTNAME` VARCHAR(21) NOT NULL,
  `LASTNAME` VARCHAR(24) NOT NULL,
  `DATE_OF_BIRTH` DATE NOT NULL,
  `DESCRIPTION` TEXT NULL,
  `PICTURE` VARCHAR(32) NULL,
  `EMAIL` VARCHAR(62) NOT NULL,
  `PASSWORD` VARCHAR(255) NOT NULL,
  `ROLE_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_USER_ROLE1_idx` (`ROLE_ID` ASC),
  CONSTRAINT `fk_USER_ROLE1`
    FOREIGN KEY (`ROLE_ID`)
    REFERENCES `fsraiDatabase`.`ROLE` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `fsraiDatabase`.`FUNCTION_FSR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`FUNCTION_FSR` ;

CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`FUNCTION_FSR` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `NAME` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`ID`));


-- -----------------------------------------------------
-- Table `fsraiDatabase`.`MEMBER_HISTORY`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`MEMBER_HISTORY` ;

CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`MEMBER_HISTORY` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `START_DATE` DATE NOT NULL,
  `END_DATE` DATE NULL,
  `MEMBER_ID` INT NOT NULL,
  `FUNCTION_FSR_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_MEMBER_HISTORY_MEMBER1_idx` (`MEMBER_ID` ASC),
  INDEX `fk_MEMBER_HISTORY_FUNCTION_FSR1_idx` (`FUNCTION_FSR_ID` ASC),
  CONSTRAINT `fk_MEMBER_HISTORY_MEMBER1`
    FOREIGN KEY (`MEMBER_ID`)
    REFERENCES `fsraiDatabase`.`USER` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MEMBER_HISTORY_FUNCTION_FSR1`
    FOREIGN KEY (`FUNCTION_FSR_ID`)
    REFERENCES `fsraiDatabase`.`FUNCTION_FSR` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `fsraiDatabase`.`LOCATION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`LOCATION` ;

CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`LOCATION` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `STREET` VARCHAR(50) NOT NULL,
  `NUMBER` VARCHAR(5) NOT NULL,
  `ZIPCODE` VARCHAR(5) NOT NULL,
  `CITY` VARCHAR(58) NOT NULL,
  `ROOM` VARCHAR(9) NULL,
  PRIMARY KEY (`ID`));


-- -----------------------------------------------------
-- Table `fsraiDatabase`.`EVENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`EVENT` ;

CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`EVENT` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `NAME` VARCHAR(64) NOT NULL,
  `DATE` DATE NOT NULL,
  `DESCRIPTION` TEXT NOT NULL,
  `PICTURE` VARCHAR(32) NULL,
  `LOCATION_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_EVENTS_LOCATION1_idx` (`LOCATION_ID` ASC),
  CONSTRAINT `fk_EVENTS_LOCATION1`
    FOREIGN KEY (`LOCATION_ID`)
    REFERENCES `fsraiDatabase`.`LOCATION` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `fsraiDatabase`.`BOOKING`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`BOOKING` ;

CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`BOOKING` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `CREATED_AT` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `EVENT_ID` INT NOT NULL,
  `USER_ID` INT NOT NULL,
  PRIMARY KEY (`ID`),
  INDEX `fk_REGISTRATION_EVENTS1_idx` (`EVENT_ID` ASC),
  INDEX `fk_REGISTRATION_MEMBER1_idx` (`USER_ID` ASC),
  CONSTRAINT `fk_REGISTRATION_EVENTS1`
    FOREIGN KEY (`EVENT_ID`)
    REFERENCES `fsraiDatabase`.`EVENT` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_REGISTRATION_MEMBER1`
    FOREIGN KEY (`USER_ID`)
    REFERENCES `fsraiDatabase`.`USER` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

USE `fsraiDatabase` ;

-- -----------------------------------------------------
-- Placeholder table for view `fsraiDatabase`.`geteventinfo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fsraiDatabase`.`geteventinfo` (`ID` INT, `NAME` INT, `DATE` INT, `DESCRIPTION` INT, `PICTURE` INT, `LOCATION_ID` INT, `STREET` INT, `NUMBER` INT, `ZIPCODE` INT, `CITY` INT, `ROOM` INT);

-- -----------------------------------------------------
-- View `fsraiDatabase`.`geteventinfo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `fsraiDatabase`.`geteventinfo`;
DROP VIEW IF EXISTS `fsraiDatabase`.`geteventinfo` ;
USE `fsraiDatabase`;
CREATE  OR REPLACE VIEW geteventinfo  AS  select e.`ID` AS `ID`,e.`NAME` AS `NAME`,e.`DATE` AS `DATE`,e.DESCRIPTION AS DESCRIPTION,e.PICTURE AS PICTURE,e.LOCATION_ID AS LOCATION_ID,l.STREET AS STREET,l.`NUMBER` AS `NUMBER`,l.ZIPCODE AS ZIPCODE,l.CITY AS CITY,l.ROOM AS ROOM from (`event` e join location l on(e.LOCATION_ID = l.`ID`)) ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `fsraiDatabase`.`ROLE`
-- -----------------------------------------------------
START TRANSACTION;
USE `fsraiDatabase`;
INSERT INTO `fsraiDatabase`.`ROLE` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Admin');
INSERT INTO `fsraiDatabase`.`ROLE` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Mitglied');
INSERT INTO `fsraiDatabase`.`ROLE` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Nutzer');

COMMIT;


-- -----------------------------------------------------
-- Data for table `fsraiDatabase`.`USER`
-- -----------------------------------------------------
START TRANSACTION;
USE `fsraiDatabase`;
INSERT INTO `fsraiDatabase`.`USER` (`ID`, `CREATED_AT`, `UPDATED_AT`, `FIRSTNAME`, `LASTNAME`, `DATE_OF_BIRTH`, `DESCRIPTION`, `PICTURE`, `EMAIL`, `PASSWORD`, `ROLE_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Danny', 'Steinbrecher', '1989-12-24', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore', '20191027.jpg', 'danny.steinbrecher@fh-erfurt.de', '123456', 1);
INSERT INTO `fsraiDatabase`.`USER` (`ID`, `CREATED_AT`, `UPDATED_AT`, `FIRSTNAME`, `LASTNAME`, `DATE_OF_BIRTH`, `DESCRIPTION`, `PICTURE`, `EMAIL`, `PASSWORD`, `ROLE_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Niclas', 'Jarowsky', '2000-01-01', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore', '20191027.jpg', 'niclas.jarowsky@fh-erfurt.de', '123456', 1);
INSERT INTO `fsraiDatabase`.`USER` (`ID`, `CREATED_AT`, `UPDATED_AT`, `FIRSTNAME`, `LASTNAME`, `DATE_OF_BIRTH`, `DESCRIPTION`, `PICTURE`, `EMAIL`, `PASSWORD`, `ROLE_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Anton', 'Bespablov', '2000-01-01', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore', '20191027.jpg', 'anton.bespablov@fh-erfurt.de', '123456', 2);
INSERT INTO `fsraiDatabase`.`USER` (`ID`, `CREATED_AT`, `UPDATED_AT`, `FIRSTNAME`, `LASTNAME`, `DATE_OF_BIRTH`, `DESCRIPTION`, `PICTURE`, `EMAIL`, `PASSWORD`, `ROLE_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Frieder', 'Ullmann', '2000-01-01', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lore', '20191027.jpg', 'frieder.ullmann@fh-erfurt.de', '123456', 2);
INSERT INTO `fsraiDatabase`.`USER` (`ID`, `CREATED_AT`, `UPDATED_AT`, `FIRSTNAME`, `LASTNAME`, `DATE_OF_BIRTH`, `DESCRIPTION`, `PICTURE`, `EMAIL`, `PASSWORD`, `ROLE_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Torsten', 'Petersen', '2000-01-01', NULL, NULL, 'torsten.petersen@outlook.com', '123456', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `fsraiDatabase`.`FUNCTION_FSR`
-- -----------------------------------------------------
START TRANSACTION;
USE `fsraiDatabase`;
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Sprecher');
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'stellv. Sprecher');
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Finanzer');
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'stellv. Finanzer');
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Mitglied');
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'inaktives Mitglied');
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Social Media');
INSERT INTO `fsraiDatabase`.`FUNCTION_FSR` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`) VALUES (DEFAULT, DEFAULT, NULL, 'Lagerverwalter');

COMMIT;


-- -----------------------------------------------------
-- Data for table `fsraiDatabase`.`MEMBER_HISTORY`
-- -----------------------------------------------------
START TRANSACTION;
USE `fsraiDatabase`;
INSERT INTO `fsraiDatabase`.`MEMBER_HISTORY` (`ID`, `CREATED_AT`, `UPDATED_AT`, `START_DATE`, `END_DATE`, `MEMBER_ID`, `FUNCTION_FSR_ID`) VALUES (DEFAULT, DEFAULT, NULL, '2019-01-01', NULL, 1, 1);
INSERT INTO `fsraiDatabase`.`MEMBER_HISTORY` (`ID`, `CREATED_AT`, `UPDATED_AT`, `START_DATE`, `END_DATE`, `MEMBER_ID`, `FUNCTION_FSR_ID`) VALUES (DEFAULT, DEFAULT, NULL, '2019-01-01', NULL, 2, 5);
INSERT INTO `fsraiDatabase`.`MEMBER_HISTORY` (`ID`, `CREATED_AT`, `UPDATED_AT`, `START_DATE`, `END_DATE`, `MEMBER_ID`, `FUNCTION_FSR_ID`) VALUES (DEFAULT, DEFAULT, NULL, '2019-01-01', '2019-06-01', 3, 5);
INSERT INTO `fsraiDatabase`.`MEMBER_HISTORY` (`ID`, `CREATED_AT`, `UPDATED_AT`, `START_DATE`, `END_DATE`, `MEMBER_ID`, `FUNCTION_FSR_ID`) VALUES (DEFAULT, DEFAULT, NULL, '2019-06-02', NULL, 3, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `fsraiDatabase`.`LOCATION`
-- -----------------------------------------------------
START TRANSACTION;
USE `fsraiDatabase`;
INSERT INTO `fsraiDatabase`.`LOCATION` (`ID`, `CREATED_AT`, `UPDATED_AT`, `STREET`, `NUMBER`, `ZIPCODE`, `CITY`, `ROOM`) VALUES (DEFAULT, DEFAULT, NULL, 'Altonaerstrasse', '3', '99806', 'Erfurt', '3.1.23');
INSERT INTO `fsraiDatabase`.`LOCATION` (`ID`, `CREATED_AT`, `UPDATED_AT`, `STREET`, `NUMBER`, `ZIPCODE`, `CITY`, `ROOM`) VALUES (DEFAULT, DEFAULT, NULL, 'Altonaerstrasse', '3', '99080', 'Erfurt', '9.3.12');
INSERT INTO `fsraiDatabase`.`LOCATION` (`ID`, `CREATED_AT`, `UPDATED_AT`, `STREET`, `NUMBER`, `ZIPCODE`, `CITY`, `ROOM`) VALUES (DEFAULT, DEFAULT, NULL, 'Altonaerstrasse', '3', '88068', 'Erfurt', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `fsraiDatabase`.`EVENT`
-- -----------------------------------------------------
START TRANSACTION;
USE `fsraiDatabase`;
INSERT INTO `fsraiDatabase`.`EVENT` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`, `DATE`, `DESCRIPTION`, `PICTURE`, `LOCATION_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'HYE 2019', '2019-10-22', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '20191027.jpg', 1);
INSERT INTO `fsraiDatabase`.`EVENT` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`, `DATE`, `DESCRIPTION`, `PICTURE`, `LOCATION_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Wintermarkt 2019', '2019-12-04', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '20191027.jpg', 1);
INSERT INTO `fsraiDatabase`.`EVENT` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`, `DATE`, `DESCRIPTION`, `PICTURE`, `LOCATION_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Weihnachtsfeier 2019', '2019-12-11', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '20191027.jpg', 2);
INSERT INTO `fsraiDatabase`.`EVENT` (`ID`, `CREATED_AT`, `UPDATED_AT`, `NAME`, `DATE`, `DESCRIPTION`, `PICTURE`, `LOCATION_ID`) VALUES (DEFAULT, DEFAULT, NULL, 'Erstiewoche', '2019-06-11', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '20191027.jpg', 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `fsraiDatabase`.`BOOKING`
-- -----------------------------------------------------
START TRANSACTION;
USE `fsraiDatabase`;
INSERT INTO `fsraiDatabase`.`BOOKING` (`ID`, `CREATED_AT`, `UPDATED_AT`, `EVENT_ID`, `USER_ID`) VALUES (DEFAULT, DEFAULT, NULL, 1, 1);
INSERT INTO `fsraiDatabase`.`BOOKING` (`ID`, `CREATED_AT`, `UPDATED_AT`, `EVENT_ID`, `USER_ID`) VALUES (DEFAULT, DEFAULT, NULL, 1, 2);
INSERT INTO `fsraiDatabase`.`BOOKING` (`ID`, `CREATED_AT`, `UPDATED_AT`, `EVENT_ID`, `USER_ID`) VALUES (DEFAULT, DEFAULT, NULL, 3, 1);
INSERT INTO `fsraiDatabase`.`BOOKING` (`ID`, `CREATED_AT`, `UPDATED_AT`, `EVENT_ID`, `USER_ID`) VALUES (DEFAULT, DEFAULT, NULL, 2, 3);
INSERT INTO `fsraiDatabase`.`BOOKING` (`ID`, `CREATED_AT`, `UPDATED_AT`, `EVENT_ID`, `USER_ID`) VALUES (DEFAULT, DEFAULT, NULL, 2, 1);

COMMIT;


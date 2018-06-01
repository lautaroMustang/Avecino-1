SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `avecino` ;
CREATE SCHEMA IF NOT EXISTS `avecino` DEFAULT CHARACTER SET latin1 ;
USE `avecino` ;

-- -----------------------------------------------------
-- Table `countries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `countries` ;

CREATE  TABLE IF NOT EXISTS `countries` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `flag` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `name_UNIQUE` ON `countries` (`name` ASC) ;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `avartar` VARCHAR(100) NULL ,
  `email` VARCHAR(100) NOT NULL ,
  `lastlogin` DATETIME NOT NULL ,
  `idcountry` INT NOT NULL ,
  `isactive` INT NOT NULL DEFAULT 0 ,
  `fullname` VARCHAR(70) NOT NULL ,
  `iddocnumber` VARCHAR(25) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_user_country`
    FOREIGN KEY (`idcountry` )
    REFERENCES `countries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `username_UNIQUE` ON `users` (`username` ASC) ;


-- -----------------------------------------------------
-- Table `states`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `states` ;

CREATE  TABLE IF NOT EXISTS `states` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `idcountry` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_states_country`
    FOREIGN KEY (`idcountry` )
    REFERENCES `countries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `departments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `departments` ;

CREATE  TABLE IF NOT EXISTS `departments` (
  `id` INT NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  `idstate` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_departments_states`
    FOREIGN KEY (`idstate` )
    REFERENCES `states` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cities` ;

CREATE  TABLE IF NOT EXISTS `cities` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `iddepartment` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_cities_departments`
    FOREIGN KEY (`iddepartment` )
    REFERENCES `departments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `neighborhoods`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `neighborhoods` ;

CREATE  TABLE IF NOT EXISTS `neighborhoods` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `idcity` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_neighborhoods_cities`
    FOREIGN KEY (`idcity` )
    REFERENCES `cities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `realestatetypes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `realestatetypes` ;

CREATE  TABLE IF NOT EXISTS `realestatetypes` (
  `id` INT NOT NULL ,
  `name` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `realestates`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `realestates` ;

CREATE  TABLE IF NOT EXISTS `realestates` (
  `id` DOUBLE NOT NULL AUTO_INCREMENT ,
  `address` VARCHAR(100) NOT NULL ,
  `idcity` INT NOT NULL ,
  `idneighborhood` INT NULL ,
  `idtype` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_realestate_city`
    FOREIGN KEY (`idcity` )
    REFERENCES `cities` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_realestate_neighborhood`
    FOREIGN KEY (`idneighborhood` )
    REFERENCES `neighborhoods` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_realestate_type`
    FOREIGN KEY (`idtype` )
    REFERENCES `realestatetypes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `attributetypes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `attributetypes` ;

CREATE  TABLE IF NOT EXISTS `attributetypes` (
  `id` INT NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `realestatesattributes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `realestatesattributes` ;

CREATE  TABLE IF NOT EXISTS `realestatesattributes` (
  `idrealestate` DOUBLE NOT NULL ,
  `idattribute` INT NOT NULL ,
  `quantity` INT NOT NULL ,
  PRIMARY KEY (`idrealestate`, `idattribute`) ,
  CONSTRAINT `fk_realestate_attributes`
    FOREIGN KEY (`idrealestate` )
    REFERENCES `realestates` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_realestate_attrtype`
    FOREIGN KEY (`idattribute` )
    REFERENCES `attributetypes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `realestatesimages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `realestatesimages` ;

CREATE  TABLE IF NOT EXISTS `realestatesimages` (
  `idrealestate` DOUBLE NOT NULL ,
  `imageorder` INT NOT NULL ,
  `image` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`idrealestate`, `imageorder`) ,
  CONSTRAINT `fk_realestates_images`
    FOREIGN KEY (`idrealestate` )
    REFERENCES `realestates` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `postings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `postings` ;

CREATE  TABLE IF NOT EXISTS `postings` (
  `id` DOUBLE NOT NULL ,
  `iduser` INT NOT NULL ,
  `idrealestate` DOUBLE NOT NULL ,
  `value` FLOAT NOT NULL ,
  `tosell` INT NULL ,
  `torent` INT NULL ,
  `startdate` DATETIME NOT NULL ,
  `sold` INT NULL ,
  `rented` INT NULL ,
  `enddate` DATETIME NULL ,
  `` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_posting_users`
    FOREIGN KEY (`iduser` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_posting_realestates`
    FOREIGN KEY (`idrealestate` )
    REFERENCES `realestates` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `avecino` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

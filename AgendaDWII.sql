-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema agendatwii
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema agendatwii
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `id19088349_agenda` DEFAULT CHARACTER SET utf8 ;
USE `id19088349_agenda` ;

-- -----------------------------------------------------
-- Table `agendatwii`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id19088349_agenda`.`Users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `login` VARCHAR(30) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `fone` VARCHAR(12) NULL,
  `active` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agendatwii`.`Contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id19088349_agenda`.`Contacts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NULL,
  `fone` VARCHAR(12) NULL,
  `active` TINYINT NOT NULL DEFAULT 1,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Contacts_Users1_idx` (`Users_id` ASC),
  CONSTRAINT `fk_Contacts_Users1`
    FOREIGN KEY (`Users_id`)
    REFERENCES `id19088349_agenda`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agendatwii`.`Groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id19088349_agenda`.`Groups` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(40) NOT NULL,
  `description` VARCHAR(250) NULL,
  `active` TINYINT NOT NULL DEFAULT 1,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Groups_Users1_idx` (`Users_id` ASC),
  CONSTRAINT `fk_Groups_Users1`
    FOREIGN KEY (`Users_id`)
    REFERENCES `id19088349_agenda`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agendatwii`.`Events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id19088349_agenda`.`Events` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(40) NOT NULL,
  `description` VARCHAR(250) NULL,
  `date` DATETIME NULL,
  `active` TINYINT NOT NULL DEFAULT 1,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Events_Users_idx` (`Users_id` ASC),
  CONSTRAINT `fk_Events_Users`
    FOREIGN KEY (`Users_id`)
    REFERENCES `id19088349_agenda`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agendatwii`.`Events_has_Contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id19088349_agenda`.`Events_has_Contacts` (
  `Events_id` INT NOT NULL,
  `Contacts_id` INT NOT NULL,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`Events_id`, `Contacts_id`),
  INDEX `fk_Events_has_Contacts_Contacts1_idx` (`Contacts_id` ASC),
  INDEX `fk_Events_has_Contacts_Events1_idx` (`Events_id` ASC),
  INDEX `fk_Events_has_Contacts_Users1_idx` (`Users_id` ASC),
  CONSTRAINT `fk_Events_has_Contacts_Events1`
    FOREIGN KEY (`Events_id`)
    REFERENCES `id19088349_agenda`.`Events` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Events_has_Contacts_Contacts1`
    FOREIGN KEY (`Contacts_id`)
    REFERENCES `id19088349_agenda`.`Contacts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Events_has_Contacts_Users1`
    FOREIGN KEY (`Users_id`)
    REFERENCES `id19088349_agenda`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `agendatwii`.`Groups_has_Contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `id19088349_agenda`.`Groups_has_Contacts` (
  `Groups_id` INT NOT NULL,
  `Contacts_id` INT NOT NULL,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`Groups_id`, `Contacts_id`),
  INDEX `fk_Groups_has_Contacts_Contacts1_idx` (`Contacts_id` ASC),
  INDEX `fk_Groups_has_Contacts_Groups1_idx` (`Groups_id` ASC),
  INDEX `fk_Groups_has_Contacts_Users1_idx` (`Users_id` ASC),
  CONSTRAINT `fk_Groups_has_Contacts_Groups1`
    FOREIGN KEY (`Groups_id`)
    REFERENCES `id19088349_agenda`.`Groups` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Groups_has_Contacts_Contacts1`
    FOREIGN KEY (`Contacts_id`)
    REFERENCES `id19088349_agenda`.`Contacts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Groups_has_Contacts_Users1`
    FOREIGN KEY (`Users_id`)
    REFERENCES `id19088349_agenda`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

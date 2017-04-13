-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema webquiz
-- -----------------------------------------------------
-- This is current database for web science project.

-- -----------------------------------------------------
-- Schema webquiz
--
-- This is current database for web science project.
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `webquiz` DEFAULT CHARACTER SET utf8 ;
USE `webquiz` ;

-- -----------------------------------------------------
-- Table `webquiz`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webquiz`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE `webquiz`.`user` ADD UNIQUE(`username`);

-- -----------------------------------------------------
-- Table `webquiz`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webquiz`.`questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(255) NULL,
  `answer` VARCHAR(55) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webquiz`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webquiz`.`questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(255) NULL,
  `answer` VARCHAR(55) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webquiz`.`quiz`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webquiz`.`quiz` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webquiz`.`question`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webquiz`.`question` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(255) NOT NULL,
  `option1` VARCHAR(100) NOT NULL,
  `option2` VARCHAR(100) NOT NULL,
  `option3` VARCHAR(100) NULL,
  `answer` INT NOT NULL,
  `comment` VARCHAR(255) NULL,
  `quiz_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_question_quiz_idx` (`quiz_id` ASC),
  CONSTRAINT `fk_question_quiz`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `webquiz`.`quiz` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webquiz`.`result`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webquiz`.`result` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `finished` DATETIME NOT NULL,
  `question_count` INT NULL,
  `correct_answers` INT NOT NULL,
  `quiz_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_result_quiz1_idx` (`quiz_id` ASC),
  INDEX `fk_result_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_result_quiz1`
    FOREIGN KEY (`quiz_id`)
    REFERENCES `webquiz`.`quiz` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_result_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `webquiz`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `webquiz` ;

-- -----------------------------------------------------
-- Placeholder table for view `webquiz`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webquiz`.`view1` (`id` INT);

-- -----------------------------------------------------
-- View `webquiz`.`view1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `webquiz`.`view1`;
USE `webquiz`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

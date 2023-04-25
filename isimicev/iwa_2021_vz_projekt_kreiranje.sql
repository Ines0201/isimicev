-- MySQL Script generated by MySQL Workbench
-- Fri Oct 22 22:40:22 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema iwa_2021_vz_projekt
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema iwa_2021_vz_projekt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iwa_2021_vz_projekt` DEFAULT CHARACTER SET utf8 ;
USE `iwa_2021_vz_projekt` ;

-- -----------------------------------------------------
-- Table `iwa_2021_vz_projekt`.`tip_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2021_vz_projekt`.`tip_korisnika` (
  `tip_korisnika_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`tip_korisnika_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2021_vz_projekt`.`medijska_kuca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2021_vz_projekt`.`medijska_kuca` (
  `medijska_kuca_id` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `opis` TEXT NULL,
  PRIMARY KEY (`medijska_kuca_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2021_vz_projekt`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2021_vz_projekt`.`korisnik` (
  `korisnik_id` INT NOT NULL AUTO_INCREMENT,
  `tip_korisnika_id` INT NOT NULL,
  `medijska_kuca_id` INT NULL,
  `korime` VARCHAR(50) NOT NULL,
  `ime` VARCHAR(50) NOT NULL,
  `prezime` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `lozinka` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`korisnik_id`),
  INDEX `tip_korisnika_id_fk_idx` (`tip_korisnika_id` ASC),
  INDEX `medijska_kuca_id_fk_idx` (`medijska_kuca_id` ASC),
  CONSTRAINT `tip_korisnika_id_fk`
    FOREIGN KEY (`tip_korisnika_id`)
    REFERENCES `iwa_2021_vz_projekt`.`tip_korisnika` (`tip_korisnika_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `medijska_kuca_id_fk`
    FOREIGN KEY (`medijska_kuca_id`)
    REFERENCES `iwa_2021_vz_projekt`.`medijska_kuca` (`medijska_kuca_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iwa_2021_vz_projekt`.`pjesma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iwa_2021_vz_projekt`.`pjesma` (
  `pjesma_id` INT NOT NULL AUTO_INCREMENT,
  `korisnik_id` INT NOT NULL,
  `medijska_kuca_id` INT NULL,
  `naziv` VARCHAR(45) NOT NULL,
  `poveznica` VARCHAR(150) NOT NULL,
  `opis` TEXT NOT NULL,
  `datum_vrijeme_kreiranja` TIMESTAMP NOT NULL,
  `datum_vrijeme_kupnje` TIMESTAMP NULL,
  `broj_svidanja` INT NULL,
  PRIMARY KEY (`pjesma_id`),
  INDEX `medijska_kuca_id_fk_idx` (`medijska_kuca_id` ASC),
  INDEX `korisnik_id_fk_idx` (`korisnik_id` ASC),
  CONSTRAINT `medijska_kuca_id_fk1`
    FOREIGN KEY (`medijska_kuca_id`)
    REFERENCES `iwa_2021_vz_projekt`.`medijska_kuca` (`medijska_kuca_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `korisnik_id_fk`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `iwa_2021_vz_projekt`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE USER 'iwa_2021'@'localhost' IDENTIFIED BY 'foi2021';

GRANT SELECT, INSERT, TRIGGER, UPDATE, DELETE ON TABLE `iwa_2021_vz_projekt`.* TO 'iwa_2021'@'localhost';

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

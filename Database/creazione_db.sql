/*----------------------------------------------------------------------
--  Create Database
----------------------------------------------------------------------*/
CREATE DATABASE IF NOT EXISTS `nomeApp` DEFAULT CHARACTER SET utf8 ;
USE `nomeApp`;

/* -----------------------------------------------------
-- Table `nomeApp`.`utente`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`utente` (
  `idUtente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cognome` VARCHAR(100) NOT NULL,
  `dataNascita` DATE NOT NULL,
  `sesso` VARCHAR(1) NOT NULL,
  `numeroTelefono` INT NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(512) NOT NULL,
  `cookie` BOOLEAN DEFAULT 0 NOT NULL,
  PRIMARY KEY (`idUtente`))
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `nomeApp`.`amicizia`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`amicizia` (
  `codUtente` INT NOT NULL,
  `codUtente2` INT NOT NULL,
  `dataAmicizia` DATE NOT NULL,
  PRIMARY KEY (`codUtente`, `codUtente2`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `nomeApp`.`post`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`post` (
  `idPost` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(2000) NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idPost`),
  CONSTRAINT `fk_post_utente` FOREIGN KEY (`codUtente`) 
  REFERENCES `nomeApp`.`utente` (`idUtente`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `nomeApp`.`likeSave`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`LikeSave` (
  `codUtente` INT NOT NULL,
  `codPost` INT NOT NULL,
  `like` BOOLEAN DEFAULT 0 NOT NULL,
  `save` BOOLEAN DEFAULT 0 NOT NULL,
  PRIMARY KEY (`codUtente`, `codPost`),
  CONSTRAINT `fk_like_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `nomeApp`.`utente` (`idUtente`),
  CONSTRAINT `fk_like_post` FOREIGN KEY (`codPost`)
  REFERENCES `nomeApp`.`post` (`idPost`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `nomeApp`.`impostazione`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`impostazione` (
  `idImpostazione` INT NOT NULL AUTO_INCREMENT,
  `privato` BOOLEAN DEFAULT 0 NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idImpostazione`),
  CONSTRAINT `fk_impostazione_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `nomeApp`.`utente` (`idUtente`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `nomeApp`.`chat`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`chat` (
  `idChat` INT NOT NULL AUTO_INCREMENT,
  `nomeChat` VARCHAR(50) NOT NULL,
  `descrizioneChat` VARCHAR(500) NOT NULL,
  `immagineGruppo` VARCHAR(500),
  PRIMARY KEY (`idChat`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `nomeApp`.`partecipazione`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`partecipazione` (
  `codUtente` INT NOT NULL,
  `codChat` INT NOT NULL,
  PRIMARY KEY (`codUtente`, `codChat`),
  CONSTRAINT `fk_partecipazione_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `nomeApp`.`utente` (`idUtente`),
  CONSTRAINT `fk_partecipazione_chat` FOREIGN KEY (`codChat`)
  REFERENCES `nomeApp`.`chat` (`idChat`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `nomeApp`.`messaggio`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `nomeApp`.`messaggio` (
  `idMessaggio` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(500) NOT NULL,
  `immagine` VARCHAR(500),
  `altroFile` VARCHAR(500),
  `codChat` INT NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idMessaggio`),
  CONSTRAINT `fk_messaggio_chat` FOREIGN KEY (`codChat`)
  REFERENCES `nomeApp`.`chat` (`idChat`),
  CONSTRAINT `fk_messaggio_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `nomeApp`.`utente` (`idUtente`)
)
ENGINE = InnoDB;
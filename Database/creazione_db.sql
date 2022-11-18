/*----------------------------------------------------------------------
--  Create Database
----------------------------------------------------------------------*/
CREATE DATABASE IF NOT EXISTS `ShareHub` DEFAULT CHARACTER SET utf8 ;
USE `ShareHub`;

/* -----------------------------------------------------
-- Table `ShareHub`.`utente`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`utente` (
  `idUtente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cognome` VARCHAR(100) NOT NULL,
  `dataNascita` DATE NOT NULL,
  `sesso` VARCHAR(1) NOT NULL,
  `prefissoTelefonico` VARCHAR(3) NOT NULL,
  `numeroTelefono` varchar(10) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(512) NOT NULL,
  `cookie` BOOLEAN DEFAULT 0 NOT NULL,
  PRIMARY KEY (`idUtente`))
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`amicizia`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`amicizia` (
  `codUtente` INT NOT NULL,
  `codUtente2` INT NOT NULL,
  `dataAmicizia` DATE NOT NULL,
  PRIMARY KEY (`codUtente`, `codUtente2`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`post`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`post` (
  `idPost` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(2000) NOT NULL,
  `immagine` VARCHAR(500), 
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idPost`),
  CONSTRAINT `fk_post_utente` FOREIGN KEY (`codUtente`) 
  REFERENCES `ShareHub`.`utente` (`idUtente`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`likeSave`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`LikeSave` (
  `codUtente` INT NOT NULL,
  `codPost` INT NOT NULL,
  `like` BOOLEAN DEFAULT 0 NOT NULL,
  `save` BOOLEAN DEFAULT 0 NOT NULL,
  PRIMARY KEY (`codUtente`, `codPost`),
  CONSTRAINT `fk_like_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `ShareHub`.`utente` (`idUtente`),
  CONSTRAINT `fk_like_post` FOREIGN KEY (`codPost`)
  REFERENCES `ShareHub`.`post` (`idPost`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`impostazione`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`impostazione` (
  `idImpostazione` INT NOT NULL AUTO_INCREMENT,
  `privato` BOOLEAN DEFAULT 0 NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idImpostazione`),
  CONSTRAINT `fk_impostazione_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `ShareHub`.`utente` (`idUtente`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`chat`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`chat` (
  `idChat` INT NOT NULL AUTO_INCREMENT,
  `nomeChat` VARCHAR(50) NOT NULL,
  `descrizioneChat` VARCHAR(500) NOT NULL,
  `immagineGruppo` VARCHAR(500),
  PRIMARY KEY (`idChat`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`partecipazione`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`partecipazione` (
  `codUtente` INT NOT NULL,
  `codChat` INT NOT NULL,
  PRIMARY KEY (`codUtente`, `codChat`),
  CONSTRAINT `fk_partecipazione_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `ShareHub`.`utente` (`idUtente`),
  CONSTRAINT `fk_partecipazione_chat` FOREIGN KEY (`codChat`)
  REFERENCES `ShareHub`.`chat` (`idChat`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`messaggio`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`messaggio` (
  `idMessaggio` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(2000) NOT NULL,
  `immagine` VARCHAR(500),
  `altroFile` VARCHAR(500),
  `codChat` INT NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idMessaggio`),
  CONSTRAINT `fk_messaggio_chat` FOREIGN KEY (`codChat`)
  REFERENCES `ShareHub`.`chat` (`idChat`),
  CONSTRAINT `fk_messaggio_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `ShareHub`.`utente` (`idUtente`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `ShareHub`.`messaggio`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `ShareHub`.`commento` (
  `idCommento` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(1000) NOT NULL,
  `dataCommento` DATE NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idCommento`),
  CONSTRAINT `fk_commento_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `ShareHub`.`utente` (`idUtente`)
)
ENGINE = InnoDB;
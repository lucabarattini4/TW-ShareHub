/*----------------------------------------------------------------------
--  Create Database
----------------------------------------------------------------------*/
CREATE DATABASE IF NOT EXISTS `sharehub` DEFAULT CHARACTER SET utf8 ;
USE `sharehub`;

/* -----------------------------------------------------
-- Table `sharehub`.`utente`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`utente` (
  `idUtente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cognome` VARCHAR(100) NOT NULL,
  `dataNascita` DATE NOT NULL,
  `sesso` VARCHAR(1) NOT NULL,
  `prefissoTelefonico` VARCHAR(5) NOT NULL,
  `numeroTelefono` varchar(10) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(512) NOT NULL,
  `immagineProfilo` VARCHAR(200) NOT NULL,
  `cookie` BOOLEAN DEFAULT 0 NOT NULL,
  PRIMARY KEY (`idUtente`))
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`amicizia`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`amicizia` (
  `codFollowed` INT NOT NULL,
  `codFollower` INT NOT NULL,
  `dataAmicizia` DATETIME NOT NULL DEFAULT current_timestamp(),
  `accettata` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`codFollowed`, `codFollower`),
  CONSTRAINT `fk_amicizia_followed` FOREIGN KEY (`codFollowed`) 
  REFERENCES `sharehub`.`utente` (`idUtente`)
  ON DELETE CASCADE,
  CONSTRAINT `fk_amicizia_follower` FOREIGN KEY (`codFollower`) 
  REFERENCES `sharehub`.`utente` (`idUtente`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`post`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`post` (
  `idPost` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(2000) NOT NULL,
  `immagine` VARCHAR(500),
  `descImmagine` VARCHAR(200), 
  `dataPost` DATETIME NOT NULL DEFAULT current_timestamp(),
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idPost`),
  CONSTRAINT `fk_post_utente` FOREIGN KEY (`codUtente`) 
  REFERENCES `sharehub`.`utente` (`idUtente`)
  ON DELETE CASCADE
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`likeSave`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`likeSave` (
  `codUtente` INT NOT NULL,
  `codPost` INT NOT NULL,
  `like` BOOLEAN DEFAULT 0 NOT NULL,
  `save` BOOLEAN DEFAULT 0 NOT NULL,
  PRIMARY KEY (`codUtente`, `codPost`),
  CONSTRAINT `fk_like_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `sharehub`.`utente` (`idUtente`)
  ON DELETE CASCADE,
  CONSTRAINT `fk_like_post` FOREIGN KEY (`codPost`)
  REFERENCES `sharehub`.`post` (`idPost`)
  ON DELETE CASCADE
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`impostazione`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`impostazione` (
  `idImpostazione` INT NOT NULL AUTO_INCREMENT,
  `privato` BOOLEAN DEFAULT 0 NOT NULL,
  `tema` BOOLEAN DEFAULT 0 NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idImpostazione`),
  CONSTRAINT `fk_impostazione_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `sharehub`.`utente` (`idUtente`)
  ON DELETE CASCADE
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`chat`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`chat` (
  `idChat` INT NOT NULL AUTO_INCREMENT,
  `nomeChat` VARCHAR(50),
  `descrizioneChat` VARCHAR(500),
  `immagineGruppo` VARCHAR(500),
  PRIMARY KEY (`idChat`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`partecipazione`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`partecipazione` (
  `codUtente` INT NOT NULL,
  `codChat` INT NOT NULL,
  PRIMARY KEY (`codUtente`, `codChat`),
  CONSTRAINT `fk_partecipazione_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `sharehub`.`utente` (`idUtente`)
  ON DELETE CASCADE,
  CONSTRAINT `fk_partecipazione_chat` FOREIGN KEY (`codChat`)
  REFERENCES `sharehub`.`chat` (`idChat`)
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`messaggio`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`messaggio` (
  `idMessaggio` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(2000) NOT NULL,
  `immagine` VARCHAR(500),
  `altroFile` VARCHAR(500),
  `dataMessaggio` DATETIME NOT NULL DEFAULT current_timestamp(),
  `codChat` INT NOT NULL,
  `codUtente` INT NOT NULL,
  PRIMARY KEY (`idMessaggio`),
  CONSTRAINT `fk_messaggio_chat` FOREIGN KEY (`codChat`)
  REFERENCES `sharehub`.`chat` (`idChat`),
  CONSTRAINT `fk_messaggio_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `sharehub`.`utente` (`idUtente`)
  ON DELETE CASCADE
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`commento`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`commento` (
  `idCommento` INT NOT NULL AUTO_INCREMENT,
  `testo` VARCHAR(1000) NOT NULL,
  `dataCommento` DATETIME NOT NULL DEFAULT current_timestamp(),
  `codUtente` INT NOT NULL,
  `codPost` INT NOT NULL,
  PRIMARY KEY (`idCommento`),
  CONSTRAINT `fk_commento_utente` FOREIGN KEY (`codUtente`)
  REFERENCES `sharehub`.`utente` (`idUtente`)
  ON DELETE CASCADE,
  CONSTRAINT `fk_commento_post` FOREIGN KEY (`codPost`)
  REFERENCES `sharehub`.`post` (`idPost`)
  ON DELETE CASCADE
)
ENGINE = InnoDB;

/* -----------------------------------------------------
-- Table `sharehub`.`notifica`
-- ---------------------------------------------------*/
CREATE TABLE IF NOT EXISTS `sharehub`.`notifica` (
  `idNotifica` INT NOT NULL AUTO_INCREMENT,
  `descrizioneNotifica` VARCHAR(200) NOT NULL,
  `dataNotifica` DATETIME NOT NULL DEFAULT current_timestamp(),
  `presaVisione` INT NOT NULL DEFAULT 0,
  `codUtenteDestinatario` INT NOT NULL,
  `codUtenteMittente` INT DEFAULT 0,
  PRIMARY KEY (`idNotifica`),
  CONSTRAINT `fk_notifica_utente_dest` FOREIGN KEY (`codUtenteDestinatario`) 
  REFERENCES `sharehub`.`utente` (`idUtente`),
  CONSTRAINT `fk_notifica_utente_mitt` FOREIGN KEY (`codUtenteMittente`) 
  REFERENCES `sharehub`.`utente` (`idUtente`)
)
ENGINE = InnoDB;
/* -----------------------------------------------------
-- Insert into `ShareHub`.`utente`
-- ---------------------------------------------------*/
INSERT INTO `utente` (`idUtente`, `nome`, `cognome`, `dataNascita`, `sesso`, `prefissoTelefonico`, `numeroTelefono`, `email`, `username`, `password`, `immagineProfilo`, `cookie`) VALUES
(1, 'pippo', 'cognomePippo', '1990-10-28', 'M', '+39','3347638900', 'pippo@gmail.com', 'pippoIlGrande', 'pippo1234', 'elmo.jpg', TRUE),
(2, 'topolino', 'cognomeTopolino', '1990-10-28', 'M', '+39','3347898910', 'topolino@gmail.com', 'topolinoIlGrande', 'topolino1234', 'elm3.webp', TRUE),
(3, 'zio', 'paperone', '1960-10-28', 'M', '+39','3347148910', 'ziopaperone@gmail.com', 'zioPaperoneIlGrande', 'paperone1234', 'elmo2.jfif', TRUE),
(4, 'pluto', 'cognomePluto', '1990-10-28', 'M', '+39','3347856710', 'pluto@gmail.com', 'plutoIlGrande', 'pluto1234', 'elmo4.jpg', FALSE);

/* -----------------------------------------------------
-- Insert into `ShareHub`.`amicizia`
-- ---------------------------------------------------*/
INSERT INTO `amicizia` (`codUtente`, `codUtente2`, `dataAmicizia`) VALUES
(1, 2, '2022-11-18'),
(1, 3, '2022-10-15'),
(2, 3, '2022-10-12');

/* -----------------------------------------------------
-- Insert into `ShareHub`.`post`
-- ---------------------------------------------------*/
INSERT INTO `post` (`idPost`, `testo`, `immagine`, `descImmagine`, `codUtente`) VALUES
(1, 'Primo post di Topolino', 'image.jpg', 'donna con occhiali',2),
(2, 'Secondo post di topolino', 'image2.jpg', 'baby yoda', 2),
(3, 'Primo post di ZioPaperone', 'image3.jpeg', 'gatto cowboy che va sullo skateboard', 3),
(4, 'Questo gatto è un gatto', 'image4.jpg', 'immagine di un gatto', 3),
(5, 'Wee bella gente', 'image5.jpg', 'battutona squallida', 1),
(6, 'Ciao sono pluto', 'image6.jfif', 'immagine divertentissima', 4);

/* -----------------------------------------------------
-- Insert into `ShareHub`.`likeSave`
-- ---------------------------------------------------*/
INSERT INTO `likeSave` (`codUtente`, `codPost`, `like`, `save`) VALUES
(1, 1, TRUE, TRUE),
(1, 3, TRUE, FALSE),
(2, 3, FALSE, TRUE);

/* -----------------------------------------------------
-- Insert into `ShareHub`.`commento`
-- ---------------------------------------------------*/
INSERT INTO `commento` (`idCommento`, `testo`, `dataCommento`, `codUtente`, `codPost`) VALUES
(1, 'wow, bella foto topolino, pippo.', '2022-11-18', 1, 1),
(2, 'wow, bella foto topolino, zioPaperone.', '2022-11-18', 3, 1),
(3, 'wow, bella la tua seconda foto topolino, pippo.', '2022-11-18', 1, 2),
(4, 'wow, bella la tua seconda foto topolino, zioPaperone.', '2022-11-18', 3, 2);

/* -----------------------------------------------------
-- Insert into `ShareHub`.`impostazione`
-- ---------------------------------------------------*/
INSERT INTO `impostazione` (`idImpostazione`, `privato`, `tema`, `codUtente`) VALUES
(1, TRUE, FALSE, 1),
(2, FALSE, FALSE, 2);

/* -----------------------------------------------------
-- Insert into `ShareHub`.`chat`
-- ---------------------------------------------------*/
INSERT INTO `chat` (`idChat`, `nomeChat`, `descrizioneChat`) VALUES
(1, 'PiPaTo', 'Gruppo di Pippo, Zio Paperone, Topolino'),
(2, '', ''),
(3, '', '');


/* -----------------------------------------------------
-- Insert into `ShareHub`.`partecipazione`
-- ---------------------------------------------------*/
INSERT INTO `partecipazione` (`codChat`, `codUtente`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 1),
(3, 2);

/* -----------------------------------------------------
-- Insert into `ShareHub`.`messaggio`
-- ---------------------------------------------------*/
INSERT INTO `messaggio` (`idMessaggio`, `testo`, `codChat`, `codUtente`) VALUES
(1, 'ciao gruppo, sono pippo', 1, 1),
(2, 'ciao gruppo, sono topolino', 1, 2),
(3, 'ciao gruppo, sono zio paperone', 1, 3),
(4, 'Ciao zio paperone, sono pippo', 2, 1)
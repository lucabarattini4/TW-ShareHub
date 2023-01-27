/* -----------------------------------------------------
-- Insert into `sharehub`.`utente`
-- ---------------------------------------------------*/
INSERT INTO `utente` (`idUtente`, `nome`, `cognome`, `dataNascita`, `sesso`, `prefissoTelefonico`, `numeroTelefono`, `email`, `username`, `password`, `immagineProfilo`, `cookie`) VALUES
(1, 'ShareHub',' ShareHub', '2022-09-26', 'A', '0039', '3351269845', 'sharehub@gmail.com', 'ShareHub', '$2y$10$pb7YChDcQzyJWxS/SaONaeU9H4CVyKA4606Rx5hxKsuORVpnY22/6', 'user.svg', TRUE),									
(2, 'Maria',' Ferrari', '1982-03-02', 'F', '0039', '3360543871', 'maria.ferrari@alice.it', 'maria.ferrari', '$2y$10$qKmSSlS0uZlgWBG.GFJwme.MBDmiJBIDAINqK.gwu7/w0ph3kwg.K', 'user.svg', TRUE),									
(3, 'Alessandra',' Marino', '1984-05-05', 'F', '0039', '3327986510', 'alessandra.marino@gmail.com', 'alessandra.marino', '$2y$10$tysS0w0FG3UujBwurBTlL.ZcQVe/ul.9YmUqWH3ty4RpSPg8WYby2', 'user.svg', TRUE),									
(4, 'Giulia',' Rizzo', '1986-08-08', 'F', '0039', '3340671298', 'giulia.rizzo@gmai.com', 'giulia.rizzo', '$2y$10$ULAxZz.QwCI7y1vI1lTJMOyi/6O7.6xKvQeBjTvpzJQTxq6wGGQwW', 'user.svg', TRUE),									
(5, 'Roberto',' De Luca', '1988-10-09', 'M', '0039', '3350298364', 'roberto.deluca@libero.it', 'roberto.de luca', '$2y$10$5ieX2y2zDU5FgY8atBt26eaRboNSrgqg3h579Bc6dH3JZMfY6mv6S', 'user.svg', TRUE),									
(6, 'Federica',' Esposito', '1990-12-12', 'F', '0039', '3389562470', 'federica.esposito@gmail.com', 'federica.esposito', '$2y$10$C2wbo9ap83fvq53Jp3lqmOWri0VyNF4qR7KIcjb3.i5tO0J30I/I2', 'user.svg', TRUE),									
(7, 'Andrea',' Giordano', '1993-02-15', 'M', '0039', '3312078594', 'andrea.giordano@libero.it', 'andrea.giordano', '$2y$10$W06pJRSMnYTtyTkyZHl09uFtahQRzmDINA4TJZdSGvy.zs0P.qK6i', 'user.svg', TRUE),									
(8, 'Valentina',' Conti', '1995-04-18', 'F', '0039', '3370491528', 'valentina.conti@virgilio.it', 'valentina.conti', '$2y$10$jPWWA6bzLJVl0Q5iCTs24u5Rlznjt/PcnWaD18lglbt3sBSgXl7Z6', 'user.svg', TRUE),									
(9, 'Angelo',' Greco', '1997-06-20', 'M', '0039', '3301256478', 'angelo.greco@gmail.com', 'angelo.greco', '$2y$10$dTV5icxywgfTkV6z9pjLte48c4rCWtlCx0/7ml6HI7alB6p9sTw3e', 'user.svg', TRUE),									
(10, 'Martina',' Colombo', '1999-08-25', 'F', '0039', '3389702351', 'martina.colombo@alice.it', 'martina.colombo', '$2y$10$u0xwEw3buXvCZHDSWF67HuuEhUpZ5a3NpN5bEyPMlhUHMqKIQm4p2', 'user.svg', TRUE),									
(11, 'Umberto',' Mancini', '2001-10-30', 'M', '0039', '3329561780', 'umberto.mancini@gmail.com', 'umberto.mancini', '$2y$10$QnIZXWpRDfm867Z7Qh/Tz..4pbB1m3mM1vMkonpnD3XYZbP68yqTa', 'user.svg', TRUE),									
(12, 'Ludovica',' Moretti', '2004-01-03', 'F', '0039', '3318097452', 'ludovica.moretti@gmail.com', 'ludovica.moretti', '$2y$10$fuPdxZkolBwZl6tmP9YNtOPJg/umbhniRvfuCWPWiMIkV57QdGJti', 'user.svg', TRUE),									
(13, 'Paolo',' Bellini', '1981-03-05', 'M', '0039', '3378641295', 'paolo.bellini@virgilio.it', 'paolo.bellini', '$2y$10$62lvSeOk8AGrsXm66MoEce9VBm6qFOfTfss.YukbMpAbeAa7yYGzi', 'user.svg', TRUE),									
(14, 'Simona',' Vitale', '1996-07-10', 'F', '0039', '3345780932', 'simona.vitale@gmail.com', 'simona.vitale', '$2y$10$0yEN5C/ScciVF0oa/sqnsu2kP9g66tS58V2G64E.X7blkjlbJEMDq', 'user.svg', TRUE),									
(15, 'Giovanni',' Rossi', '1980-01-01', 'M', '0039', '3314820976', 'giovanni.rossi@gmail.com', 'giovanni.rossi', '$2y$10$Qd2rYqi9AtnCeF/38pvln.DVKF4bTqEAaj9jchKPf/iZAugIbAkea', 'user.svg', TRUE),									
(16, 'Marco',' Lombardi', '1994-04-20', 'M', '0039', '3360945702', 'marco.lombardi@alice.it', 'marco.lombardi', '$2y$10$ZUYVgS.NLjxonJRA9GmAuesqOlZZk9XQwh94mqKUvhsSHYggYCRRK', 'user.svg', TRUE);			

/* -----------------------------------------------------
-- Insert into `sharehub`.`amicizia`
-- ---------------------------------------------------*/
INSERT INTO `amicizia` (`codFollowed`, `codFollower`, `dataAmicizia`, `accettata`) VALUES
(1, 2, '2022-11-18', 1),
(1, 3, '2022-10-15', 1),
(2, 3, '2022-10-12', 1);

/* -----------------------------------------------------
-- Insert into `sharehub`.`post`
-- ---------------------------------------------------*/
INSERT INTO `post` (`idPost`, `testo`, `immagine`, `descImmagine`, `codUtente`) VALUES
(1, 'Benvenuto in ShareHub. Inizia a seguire i tuoi amici per non perderti il divertimento.
Se risconti problemi non esitare a contattarci via mail all&#039;indirizzo sharehub@gmail.com', 'Logo_Nero.png', 'logo sharehub', 1),
(2, 'Primo post di Maria Ferrari', 'image2.jpg', 'baby yoda', 2),
(3, 'Primo post di Alessandra Marino', 'image3.jpeg', 'gatto cowboy che va sullo skateboard', 3),
(4, 'Immagine di un gatto', 'image4.jpg', 'immagine di un gatto', 3),
(5, 'Buongiorno a tutti', 'image5.jpg', 'battutona squallida', 3),
(6, 'Ciao sono Giulia Rizzo', 'image6.jfif', 'immagine divertentissima', 4);

/* -----------------------------------------------------
-- Insert into `sharehub`.`likeSave`
-- ---------------------------------------------------*/
INSERT INTO `likeSave` (`codUtente`, `codPost`, `like`, `save`) VALUES
(1, 1, TRUE, TRUE),
(1, 3, TRUE, FALSE),
(2, 3, FALSE, TRUE);

/* -----------------------------------------------------
-- Insert into `sharehub`.`commento`
-- ---------------------------------------------------*/
INSERT INTO `commento` (`idCommento`, `testo`, `dataCommento`, `codUtente`, `codPost`) VALUES
(1, 'Commento1', '2022-11-18', 1, 1),
(2, 'Commento2', '2022-11-18', 3, 1),
(3, 'Commento3', '2022-11-18', 1, 2),
(4, 'Commento4', '2022-11-18', 3, 2);

/* -----------------------------------------------------
-- Insert into `sharehub`.`impostazione`
-- ---------------------------------------------------*/
INSERT INTO `impostazione` (`idImpostazione`, `privato`, `tema`, `codUtente`) VALUES
(1, FALSE, FALSE, 1),
(2, FALSE, FALSE, 2);

/* -----------------------------------------------------
-- Insert into `sharehub`.`chat`
-- ---------------------------------------------------*/
INSERT INTO `chat` (`idChat`, `nomeChat`, `descrizioneChat`, `immagineGruppo`) VALUES
(1, '', '', ''),
(2, '', '', ''),
(3, '', '', '');

/* -----------------------------------------------------
-- Insert into `sharehub`.`partecipazione`
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
-- Insert into `sharehub`.`messaggio`
-- ---------------------------------------------------*/
INSERT INTO `messaggio` (`idMessaggio`, `testo`, `codChat`, `codUtente`) VALUES
(1, 'messaggio1', 1, 1),
(2, 'messaggio2', 1, 2),
(3, 'messaggio3', 1, 3),
(4, 'messaggio4', 2, 1)

INSERT INTO `utente` (`idUtente`, `nome`, `cognome`, `dataNascita`, `sesso`, `prefissoTelefonico`, `numeroTelefono`, `email`, `username`, `password`, `cookie`) VALUES
(1, 'pippo', 'cognomePippo', '1990-10-28', 'M', '+39','3347638900', 'pippo@gmail.com', 'pippoIlGrande', 'pippo1234', TRUE),
(2, 'topolino', 'cognomeTopolino', '1990-10-28', 'M', '+39','3347898910', 'topolino@gmail.com', 'topolinoIlGrande', 'topolino1234', TRUE),
(3, 'zio', 'paperone', '1960-10-28', 'M', '+39','3347148910', 'ziopaperone@gmail.com', 'zioPaperoneIlGrande', 'paperone1234', TRUE),
(4, 'pluto', 'cognomePluto', '1990-10-28', 'M', '+39','3347856710', 'pluto@gmail.com', 'plutoIlGrande', 'pluto1234', FALSE);

INSERT INTO `amicizia` (`codUtente`, `codUtente2`, `dataAmicizia`) VALUES
(1, 2, '2022-11-18'),
(1, 3, '2022-10-15'),
(2, 3, '2022-10-12');

INSERT INTO `post` (`idPost`, `testo`, `codUtente`) VALUES
(1, 'Primo post di Topolino', 2),
(2, 'Secondo post di topolino', 2),
(3, 'Primo post di ZioPaperone', 3);

INSERT INTO `LikeSave` (`codUtente`, `codPost`, `like`, `save`) VALUES
(1, 1, TRUE, TRUE),
(1, 3, TRUE, FALSE),
(2, 3, FALSE, TRUE);
/*Ricerca degli amici di ?*/
SELECT `utente`.`nome`, `utente`.`cognome`
FROM `utente`
WHERE `utente`.`idUtente` IN (SELECT `amicizia`.`codUtente2`
FROM `amicizia`, `utente`
WHERE `utente`.`idUtente` = `amicizia`.`codUtente`
AND `utente`.`nome` = "?");  

/*Ricerca delle persone che hanno messo like ad un post*/
SELECT `nome`, `cognome`
FROM  `likeSave`, `post`, `utente`
WHERE `likeSave`.`codPost` = `post`.`idPost` 
AND `likeSave`.`codUtente` = `utente`.`idUtente`
AND `likeSave`.`like` = TRUE
AND `post`.`idPost` = ?

/*Ricerca delle persone che hanno salvato un post*/
SELECT `nome`, `cognome`
FROM  `likeSave`, `post`, `utente`
WHERE `likeSave`.`codPost` = `post`.`idPost` 
AND `likeSave`.`codUtente` = `utente`.`idUtente`
AND `likeSave`.`save` = TRUE
AND `post`.`idPost` = ?

/*Ricerca delle persone che hanno messo sia like che salvato il post*/
SELECT `nome`, `cognome`
FROM  `likeSave`, `post`, `utente`
WHERE `likeSave`.`codPost` = `post`.`idPost` 
AND `likeSave`.`codUtente` = `utente`.`idUtente`
AND `likeSave`.`like` = TRUE
AND `likeSave`.`save` = TRUE
AND `post`.`idPost` = ?

/*Ricerca dei componenti di una determinata chat*/
SELECT `nome`, `cognome`
FROM `utente`, `partecipazione`
WHERE `utente`.`idUtente` = `partecipazione`.`codUtente`
AND `partecipazione`.`codChat` = ?

/*Ricerca della cronologia di tutti i messaggi inviati in una chat*/
SELECT `nome`, `cognome`, `testo`
FROM `messaggio`, `utente` 
WHERE `messaggio`.`codUtente` = `utente`.`idUtente`
AND `messaggio`.`codChat` = ?

/*Ricerca di tutti i commenti sotto un determinato post*/
SELECT `testo`, `dataCommento`, `nome`, `cognome`, `codPost`
FROM `commento`, `utente`
WHERE `commento`.`codUtente` = `utente`.`idUtente`
AND `commento`.`codPost` = ?

/*Ricerca di tutti i post pubblicati dai propri amici*/
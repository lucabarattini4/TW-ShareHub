/*Ricerca degli amici di pippo*/
SELECT `utente`.`nome`, `utente`.`cognome`
FROM `utente`
WHERE `utente`.`idUtente` IN (SELECT `amicizia`.`codUtente2`
FROM `amicizia`, `utente`
WHERE `utente`.`idUtente` = `amicizia`.`codUtente`
AND `utente`.`nome` = "pippo");  

/*Ricerca delle persone che hanno messo like ad un post*/

/*Ricerca delle persone che hanno salvato un post*/

/*Ricerca dei componenti di una determinata chat*/

/*Ricerca di tutti i post pubblicati dai propri amici*/


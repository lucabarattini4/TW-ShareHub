/*Ricerca degli amici di pippo*/
SELECT `utente`.`nome`, `utente`.`cognome`
FROM `utente`
WHERE `utente`.`idUtente` IN (SELECT `amicizia`.`codUtente2`
FROM `amicizia`, `utente`
WHERE `utente`.`idUtente` = `amicizia`.`codUtente`
AND `utente`.`nome` = "pippo");       
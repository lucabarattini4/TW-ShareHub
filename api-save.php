<?php
require_once 'bootstrap.php';

$dbh->setPostSaved($_SESSION["idUtente"], $_GET["idPost"]);
$result["saved"] = $dbh->isPostSaved($_SESSION["idUtente"], $_GET["idPost"]);
$username = $dbh->getUsernameFromId($_SESSION["idUtente"]);
$idDest = $dbh->getUserIdFromIdPost($_GET["idPost"]);

if($result["saved"]){
  $testo = $username." ha salvato il tuo post";
  $dbh->sendNotification($idDest, $testo, $_SESSION["idUtente"]);
}else{
  $testo = $username." ha tolto il save al tuo post";
  $dbh->sendNotification($idDest, $testo, $_SESSION["idUtente"]);
}

header('Content-Type: application/json');
echo json_encode($result);

?>
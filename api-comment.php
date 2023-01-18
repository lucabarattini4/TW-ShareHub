<?php
require_once 'bootstrap.php';

if(isset($_POST["idUtente"]) && isset($_POST["idPost"]) && isset($_POST["testo"])){
  $result["commentoInserito"] = $dbh->writeComment($_POST["idUtente"], $_POST["idPost"], htmlspecialchars($_POST["testo"]));

  $username = $dbh->getUsernameFromId($_SESSION["idUtente"]);
  $idDest = $dbh->getUserIdFromIdPost($_POST["idPost"]);
  $testo = $username." ha commentato il tuo post: ".htmlspecialchars($_POST["testo"]);
  $dbh->sendNotification($idDest, $testo, $_SESSION["idUtente"]);
}

$result["comments"] = $dbh->getComments($_GET["idPost"]);

if(count($result["comments"])){
  $result["empty"] = false;
} else {
  $result["empty"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);

?>
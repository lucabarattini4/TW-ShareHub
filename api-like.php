<?php
require_once 'bootstrap.php';

$dbh->setPostLiked($_SESSION["idUtente"], $_GET["idPost"]);

$result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"], $_GET["idPost"]);
$username = $dbh->getUsernameFromId($_SESSION["idUtente"]);
$idDest = $dbh->getUserIdFromIdPost($_GET["idPost"]);

if($result["liked"]){
  $testo = $username." ha messo like al tuo post";
  $dbh->sendNotification($idDest, $testo, $_SESSION["idUtente"]);
}else{
  $testo = $username." ha tolto il like al tuo post";
  $dbh->sendNotification($idDest, $testo, $_SESSION["idUtente"]);
}

header('Content-Type: application/json');
echo json_encode($result);

?>
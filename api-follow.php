<?php
require_once 'bootstrap.php';

$dbh->follow($_GET["user"], $_SESSION["username"]);

$result["followed"] = $dbh->isUserFollowed($_GET["user"], $_SESSION["username"]);
$idDest = $dbh->getIdFromUsername($_GET["user"]);


if($result["followed"]){
  $testo = $_SESSION["username"]." ha iniziato a seguirti";
  $dbh->sendNotification($idDest, $testo, $_SESSION["idUtente"]);
}

header('Content-Type: application/json');
echo json_encode($result);

?>
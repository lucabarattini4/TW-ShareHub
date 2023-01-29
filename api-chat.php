<?php
require_once "bootstrap.php";
if(isset($_POST['idUtente']) && isset($_POST['idChat'])&& isset($_POST['testo'])){
  $dbh->writeMessage($_POST["idUtente"], $_POST["idChat"], $_POST["testo"]);

  $idDest = $dbh->getIdOtherChatComponent($_POST["idChat"], $_POST['idUtente']);
  $testo = "hai ricevuto un nuovo messaggio";
  $dbh->sendNotification($idDest, $testo, $_SESSION["idUtente"]);
}



if (isset($_POST['chat']) && $_POST['chat']!="") {

  $result = $dbh->getMsg($_POST["chat"]);
  for($i = 0; $i < count($result); $i++){
      $result[$i]["sessionIdUtente"] = $_SESSION["idUtente"];
  }
  if (count($result) < 0) {
    $result = array("ERR");
  }

}else{
  $result = array("ERR");
}
header('Content-Type: application/json');
echo json_encode($result);
?>

<?php
require_once "bootstrap.php";

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
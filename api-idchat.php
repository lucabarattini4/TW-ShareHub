<?php
require_once "bootstrap.php";




if (isset($_POST['user']) && $_POST['user']!="" && isset($_POST['friend']) && $_POST['friend']!="") {

  $result = $dbh->getIdChatMessages(($_POST['user']),$_POST['friend']);
  
  if (count($result) < 0) {
    $result = array("ERR");
  }

}else{
  $result = array("ERR");
}
header('Content-Type: application/json');
echo json_encode($result);
?>

<?php
require_once "bootstrap.php";

if (isset($_POST['user']) && $_POST['user']!="") {
  $result = $dbh->getUserInfo($_POST["user"]);
  
  if (count($result) < 0) {
    $result = array("ERR");
  }

}else{
  $result = array("ERR");
}
header('Content-Type: application/json');
echo json_encode($result);
?>

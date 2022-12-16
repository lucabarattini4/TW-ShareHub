<?php
require_once "bootstrap.php";

if (isset($_POST['search']) && $_POST['search']!="") {
  $result = $dbh->searchUser($_POST["search"]);


  if (count($result) > 0) {
    for($i = 0; $i < count($result); $i++){
      $result[$i]["immagineProfilo"] = UPLOAD_DIR_PROFILE.$result[$i]["immagineProfilo"];

    }
  } else {
    $result = array("ERR");
  }


}else{
  $result = array("ERR");
}
header('Content-Type: application/json');
echo json_encode($result);
?>
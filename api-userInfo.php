<?php
require_once 'bootstrap.php';

if(isset($_GET["user"])){
  $user = $dbh->getUserInfo($_GET["user"]);

  for($i = 0; $i < count($user); $i++){
      $user[$i]["immagineProfilo"] = UPLOAD_DIR_PROFILE.$user[$i]["immagineProfilo"];
      if($user[$i]["idUtente"]==$_SESSION["idUtente"]){
        $user[$i]["isCurrentUser"] = true;
      }else{
        $user[$i]["isCurrentUser"] = false;
        $user[$i]["isFollowed"] = $dbh->isUserFollowed($user[$i]["username"], $_SESSION["username"]);
      }
      $user[$i]["followers"] = $dbh->countFollowers($user[$i]["idUtente"]);
      $user[$i]["followed"] = $dbh->countFollowed($user[$i]["idUtente"]);
      
  }

  header('Content-Type: application/json');
  echo json_encode($user);
}

?>
<?php
require_once 'bootstrap.php';

if(isset($_GET["idPost"]) && ($dbh->isUserProfilePublic($_GET["username"]) || $dbh->isUserFriend($_GET["username"]))){
    $posts = $dbh->getPostById($_GET["idPost"]);

    for($i = 0; $i < count($posts); $i++){
      $posts[$i]["immagine"] = UPLOAD_DIR_POST.$posts[$i]["immagine"];
      $posts[$i]["immagineProfilo"] = UPLOAD_DIR_PROFILE.$posts[$i]["immagineProfilo"];
      $posts[$i]["sessionIdUtente"] = $_SESSION["idUtente"];
      $posts[$i]["isLiked"] = $dbh->isPostLiked($_SESSION["idUtente"], $posts[$i]["idPost"]);
      $posts[$i]["isSaved"] = $dbh->isPostSaved($_SESSION["idUtente"], $posts[$i]["idPost"]);
  }
}else{
   $posts="PROFILO PRIVATO"; 
}


header('Content-Type: application/json');
echo json_encode($posts);
?>
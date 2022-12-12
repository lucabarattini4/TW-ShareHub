<?php
require_once 'bootstrap.php';

$posts = $dbh->getPosts();

for($i = 0; $i < count($posts); $i++){
    $posts[$i]["immagine"] = UPLOAD_DIR_POST.$posts[$i]["immagine"];
    $posts[$i]["immagineProfilo"] = UPLOAD_DIR_PROFILE.$posts[$i]["immagineProfilo"];
    $posts[$i]["sessionIdUtente"] = $_SESSION["idUtente"];
    $posts[$i]["isLiked"] = $dbh->isPostLiked($_SESSION["idUtente"], $posts[$i]["idPost"]);
    $posts[$i]["isSaved"] = $dbh->isPostSaved($_SESSION["idUtente"], $posts[$i]["idPost"]);
}

header('Content-Type: application/json');
echo json_encode($posts);
?>
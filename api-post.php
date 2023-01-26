<?php
require_once 'bootstrap.php';
//var_dump($_POST);
$arr = json_decode($_POST["arr"]);

if(isset($_POST["user"])){
    $posts = $dbh->getUserPosts($_POST["user"], $arr);
}else{
    $posts = $dbh->getPosts($arr, $_SESSION["idUtente"]);
}

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
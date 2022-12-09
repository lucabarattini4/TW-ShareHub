<?php
require_once 'bootstrap.php';

$dbh->setPostLiked($_SESSION["idUtente"], $_GET["idPost"]);
$result["liked"] = $dbh->isPostLiked($_SESSION["idUtente"], $_GET["idPost"]);

header('Content-Type: application/json');
echo json_encode($result);

?>
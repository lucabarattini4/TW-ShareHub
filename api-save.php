<?php
require_once 'bootstrap.php';

$dbh->setPostSaved($_SESSION["idUtente"], $_GET["idPost"]);
$result["saved"] = $dbh->isPostSaved($_SESSION["idUtente"], $_GET["idPost"]);

header('Content-Type: application/json');
echo json_encode($result);

?>
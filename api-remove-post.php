<?php
require_once 'bootstrap.php';

$result["delete"] = $dbh->deletePost($_POST["idPost"]);

header('Content-Type: application/json');
echo json_encode($result);

?>
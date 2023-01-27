<?php
require_once 'bootstrap.php';
echo $_SESSION["idUtente"];
$dbh->DeleteAccount($_SESSION["idUtente"]);


sec_session_destroy();

header("location: login-opt.php");
?>

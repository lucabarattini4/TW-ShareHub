<?php
  require_once 'bootstrap.php';
  if(isset($_POST["commento"]) && isset($_POST["idPost"]) ){
    $dbh->writeComment($_SESSION["idUtente"], $_POST["idPost"], $_POST["commento"]);
    unset($_POST["idPost"]);
    unset($_POST["commento"]);
    header("location: index.php");
  }
  header("location: index.php");
?>
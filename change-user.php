<?php

require_once 'bootstrap.php';

  $dbh->changeName($_SESSION["idUtente"],$_POST["user"]);
  $_SESSION["username"]=$_POST["user"];
  header("location: index.php");
?>

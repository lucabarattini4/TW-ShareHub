<?php

  $dbh->changeName($_SESSION["idUtente"],$_POST["user"]);
  header("location: index.php");
?>

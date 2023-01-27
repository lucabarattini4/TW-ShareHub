<?php

require_once 'bootstrap.php';
if(isset($_POST["user"])){
  $dbh->changeName($_SESSION["idUtente"],$_POST["user"]);
  $_SESSION["username"]=$_POST["user"];
  header("location: index.php");
}

?>

<div class="row">
  <form method="POST" action="#">
    <label for="username">Nuovo Username:</label>
    <input type="text" id="username" name="user"/>
    <input type="submit" name="invia" value="invia"/>
  </form>
</div>

<?php
  if(array_key_exists('logout', $_POST)) {
    sec_session_destroy();
  }
?>


  <div class="row">
    <a href="change-name.php">Cambia Username</a>
  </div>
  <hr>
  <div class="row">
    <a href="changing-password.php">Cambia Password</a>
  </div>
  <hr>
  <div class="row">
    <a href="delete-account.php">Elimina Profilo</a>
  </div>
  <hr>
  <div class="row">
    <form method="POST">
      <input type="submit" name="logout" value="LOGOUT"/>
    </form>
  </div>
  <hr>

<?php 
  if(array_key_exists('logout', $_POST)) {
    sec_session_destroy();
  }
?>

<ul>
  <li>Impostazione1</li>
  <li>Impostazione2</li>
  <form method="POST">
    <li><input type="submit" name="logout" value="LOGOUT"/></li>
  </form>
</ul>
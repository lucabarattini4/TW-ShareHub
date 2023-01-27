<?php

require_once 'bootstrap.php';
if(isset($_POST["psw1"]) AND isset($_POST["psw2"])){
  if($_POST["psw1"] == $_POST["psw2"]){
    $dbh->changePsw($_SESSION["idUtente"],$_POST["psw1"]);
    sec_session_destroy();
    header("location: login-opt.php");
  }
  else{
      $templateParams["errore"] = "ERRORE: Le password non coincidono";

  }
}


?>
<div class="row">
  <form method="POST" action="#">
    <label for="psw1">Password:</label>
    <input type="password" id="psw1" name="psw1" />
    <label for="psw2">Ripeti Password:</label>
    <input type="password" id="psw2" name="psw2" />
    <input type="submit" name="invia" value="invia"/>
    <?php if(isset($templateParams["errore"])){?>

      <p><?php echo $templateParams['errore'];?></p>
    <?php  }?>
  </form>
</div>

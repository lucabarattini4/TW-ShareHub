<?php require_once 'bootstrap.php'; ?>
<form action="#" method="POST">
  <?php

    if(isset($_POST["username"]) && isset($_POST["psw"])){
      $login_result = $dbh->checkLogin($_POST["username"], $_POST["psw"]);
      if(count($login_result)==0){
          //Login fallito
          $templateParams["errorelogin"] = "Errore! Controllare username o password!";
      }
      else{
          registerLoggedUser($login_result[0]);
      }
  }
  
  if(isUserLoggedIn()){
      $templateParams["nome"] = "index.php";
      header("location: index.php");
  }
  ?>

<h2 class="d-flex justify-content-center pt-5">Login</h2>
    <ul>
      <li class="d-flex justify-content-center pt-5">
        <label for="username">Username:</label>
        <input type="text" placeholder="username" id="username" name="username"/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="psw">Password:</label>
        <input type="password" placeholder="password" id="psw" name="psw"/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <input type="submit" name="submit" value="Invia"/>
      </li>
    </ul>
</form>
<?php require_once 'bootstrap.php'; ?>
<a class="d-flex justify-content-start align-items-center" href="login-opt.php"><img src="<?php echo UPLOAD_DIR_ICONS ?>back-arrow.svg" alt=""></a>
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
        <label for="username" hidden>Username:</label>
        <input class="text-center" type="text" placeholder="username" id="username" name="username" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="psw" hidden>Password:</label>
        <input class="text-center" type="password" placeholder="password" id="psw" name="psw" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <input type="submit" name="submit" value="Invia"/>
      </li>
    </ul>
</form>


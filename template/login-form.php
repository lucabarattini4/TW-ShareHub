<?php require_once 'bootstrap.php'; ?>

<?php
    if(isset($_POST["username"]) && isset($_POST["psw"])){

      if($dbh->checkUsernameExistence($_POST["username"])){
        $login_result = $dbh->checkLogin($_POST["username"], $_POST["psw"]);
        if(count($login_result)==0){
            //Login fallito
            $templateParams["erroreLogin"] = "ERRORE: password errata";
        }
        else{
            registerLoggedUser($login_result[0]);
        }
      }else{
        $templateParams["erroreLogin"] = "ERRORE: utente non esistente";
      }

  }

  if(isUserLoggedIn()){
      $templateParams["nome"] = "index.php";
      header("location: index.php");
  }
?>

<a class="d-flex justify-content-start align-items-center" href="login-opt.php"><img src="<?php echo UPLOAD_DIR_ICONS ?>back-arrow.svg" alt="torna indietro"></a>
<form action="#" method="POST">
<h2 class="d-flex justify-content-center pt-5">Login</h2>
    <ul>
      <li class="d-flex justify-content-center">
        <label for="username" hidden>Username:</label>
        <input class="text-center" type="text" placeholder="username" id="username" name="username" value="<?php echo (isset($_POST['username']))?$_POST['username']:'';?>" required/>
      </li>
      <li class="d-flex justify-content-center">
        <label for="psw" hidden>Password:</label>
        <input class="text-center" type="password" placeholder="password" id="psw" name="psw" required/>
      </li>
      <li class="d-flex justify-content-center">
        <input type="submit" name="submit" value="Invia"/>
      </li>
      <li>
        <p><?php if(isset($templateParams["erroreLogin"])){ echo $templateParams["erroreLogin"];}?></p>
      </li>
    </ul>
</form>

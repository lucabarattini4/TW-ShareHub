<?php require_once 'bootstrap.php'; ?>
<form action="#" method="POST" enctype="multipart/form-data">
  
  <?php
  
  if(isUserLoggedIn()){
      $templateParams["nome"] = "index.php";
      header("location: index.php");
  }

  if(isset($_POST["username"])){
    if($dbh->isUsernameUnique($_POST["username"]) && $dbh->isEmailUnique($_POST["email"]) && ($_POST["psw"] == $_POST["psw2"])){
  
      list($result, $msg) = uploadImage(UPLOAD_DIR_PROFILE, $_FILES["fileToUpload"]);
        if($result != 0){
          $imgPost = $msg;
          $id = $dbh->registerUser($_POST["nome"], $_POST["cognome"], $_POST["datanascita"], $_POST["sesso"], $_POST["prefix"], $_POST["numero"], $_POST["email"], $_POST["username"], $_POST["psw"], $imgPost);
          if($id!=false){
            header("location: login.php");
          }
          else{
            echo "Errore in inserimento!";
          }
        }
  }
  }


  ?>
  
<a href="login-opt.php"><img class="w-25" src="<?php echo UPLOAD_DIR_ICONS ?>back-arrow.svg" alt=""></a>
<h2 class="d-flex justify-content-center pt-5">Register</h2>
    <ul>
      <li class="d-flex justify-content-center pt-5">
        <label for="nome">Nome:</label>
        <input type="text" placeholder="nome" id="nome" name="nome" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="cognome">Cognome:</label>
        <input type="text" placeholder="cognome" id="cognome" name="cognome" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="datanascita">Data di nascita:</label>
        <input type="date" id="datanascita" name="datanascita" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="sesso">Sesso:</label>
        <input type="text" placeholder="sesso" id="sesso" name="sesso" maxlength=1 required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="prefix">Prefisso telefonico:</label>
        <input type="text" placeholder="prefix" id="prefix" name="prefix" minlength=3 maxlength=3 required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="numero">Numero di telefono:</label>
        <input type="text" placeholder="numero" id="numero" name="numero" minlength=10 maxlength=10 required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="email">Email:</label>
        <input type="text" placeholder="email" id="email" name="email" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="username">Username:</label>
        <input type="text" placeholder="username" id="username" name="username" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="psw">Password:</label>
        <input type="password" placeholder="password" id="psw" name="psw" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="psw2">Conferma password:</label>
        <input type="password" placeholder="conferma password" id="psw2" name="psw2" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="fileToUpload">Immagine del profilo:</label>
        <input type="file" id="fileToUpload" name="fileToUpload" required/>
      </li>
      <li>
        <button id="rmv" type="button">Remove file</button>
      </li>
      <li>
        <div id="img-preview" class="d-flex justify-content-center pt-5"></div>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <input type="submit" name="submit" value="Invia"/>
      </li>
    </ul>
</form>
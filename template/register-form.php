<?php require_once 'bootstrap.php'; ?>

  <?php

  if(isUserLoggedIn()){
      $templateParams["nome"] = "index.php";
      header("location: index.php");
  }

  if(isset($_POST["username"])){

    if($dbh->isUsernameUnique($_POST["username"])){

    if($dbh->isEmailUnique($_POST["email"])){

        if(isBirthDayCorrect($_POST["datanascita"])){

          if(isPrefixCorrect($_POST["prefix"])){

              if(isPhoneCorrect($_POST["numero"])){

                if($_POST["psw"] == $_POST["psw2"]){
                  list($result, $msg) = uploadImage(UPLOAD_DIR_PROFILE, $_FILES["fileToUpload"]);
                  if($result != 0){
                      $imgPost = $msg;
                      $id = $dbh->registerUser($_POST["nome"], $_POST["cognome"], $_POST["datanascita"], $_POST["sesso"], $_POST["prefix"], $_POST["numero"], $_POST["email"], $_POST["username"], $_POST["psw"], $imgPost);
                      if($id!=false){
                        header("location: login.php");
                      }

                  }
                  else{

                    $templateParams["erroreRegistrazione"] = "ERRORE:Errore in inserimento!";
                  }
                  /*






          else{
            echo "Errore in inserimento!";
                /*  $imgPost = end(explode('/', $_POST["profilepic"]));
                  $id = $dbh->registerUser($_POST["nome"], $_POST["cognome"], $_POST["datanascita"], $_POST["sesso"], "+".$_POST["prefix"], $_POST["numero"], $_POST["email"], $_POST["username"], $_POST["psw"], $_FILES["fileToUpload"]);
                */


                }else{
                  $templateParams["erroreRegistrazione"] = "ERRORE: Le password non coincidono";
                }


              }else{
                $templateParams["erroreRegistrazione"] = "ERRORE: Il numero di telefono non contiene solo cifre";
              }

          }else{
            $templateParams["erroreRegistrazione"] = "ERRORE: Prefisso telefonico errato: deve essere del formato 0000 senza alcun simbolo";
          }

        }else{
          $templateParams["erroreRegistrazione"] = "ERRORE: Data di nascita non esistente";
        }

    }else{
      $templateParams["erroreRegistrazione"] = "ERRORE: È già presente un account associato a questa mail";
    }
  }else{
    $templateParams["erroreRegistrazione"] = "ERRORE: È già presente un account con questo nome utente";
  }
  }

  ?>

<a class="d-flex justify-content-start align-items-left" href="login-opt.php"><img class="w-25" src="<?php echo UPLOAD_DIR_ICONS ?>back-arrow.svg" alt="torna indietro"></a>

<form action="#" method="POST" enctype="multipart/form-data">
  <h2 class="d-flex justify-content-center pt-5">Register</h2>
    <fieldset>
      <legend>Dati personali: </legend>
        <label for="nome">Nome:</label>
        <input type="text" placeholder="nome" id="nome" name="nome" value="<?php echo (isset($_POST['nome']))?$_POST['nome']:'';?>" required/>

        <label for="cognome">Cognome:</label>
        <input type="text" placeholder="cognome" id="cognome" name="cognome" value="<?php echo (isset($_POST['cognome']))?$_POST['cognome']:'';?>" required/>

        <br/>

        <label for="datanascita">Data di nascita:</label>
        <input type="date" id="datanascita" name="datanascita" value="<?php echo (isset($_POST['datanascita']))?$_POST['datanascita']:'';?>" required/>

        <label for="sesso">Sesso: </label>
        <select id="sesso" name="sesso">
          <label for="maschio" hidden></label>
          <option id="maschio" value="M" <?php if (isset($_POST['sesso']) && $_POST['sesso']=="M"){ echo "selected='true'"; }else{echo ""; } ;?>>M</option>

          <label for="femmina" hidden></label>
          <option id="femmina" value="F" <?php if (isset($_POST['sesso']) && $_POST['sesso']=="F"){ echo "selected='true'"; }else{echo ""; } ;?>>F</option>

          <label for="altro" hidden></label>
          <option id="altro" value="A" <?php if (isset($_POST['sesso']) && $_POST['sesso']=="A"){ echo "selected='true'"; }else{echo ""; } ;?>>A</option>
        </select>

        <br/>

        <label for="prefix">Prefisso telefonico:</label>
        <input type="text" placeholder="prefix" id="prefix" name="prefix" minlength=4 maxlength=4 value="<?php echo (isset($_POST['prefix']))?$_POST['prefix']:'';?>" required/>

        <label for="numero">Numero di telefono:</label>
        <input type="text" placeholder="numero" id="numero" name="numero" minlength=10 maxlength=10 value="<?php echo (isset($_POST['numero']))?$_POST['numero']:'';?>" required>

        <br/>

        <label for="email">Email:</label>
        <input type="email" placeholder="email" id="email" name="email" value="<?php echo (isset($_POST['email']))?$_POST['email']:'';?>" required/>
    </fieldset>

    <fieldset>
      <legend>Dati ShareHub: </legend>

        <label for="username">Username:</label>
        <input type="text" placeholder="username" id="username" name="username" value="<?php echo (isset($_POST['username']))?$_POST['username']:'';?>" required/>

        <br/>

        <label for="psw">Password:</label>
        <input type="password" placeholder="password" id="psw" name="psw" required/>

        <label for="psw2">Conferma password:</label>
        <input type="password" placeholder="conferma password" id="psw2" name="psw2" required/>

        <label for="fileToUpload">Immagine del profilo:</label>
        <input type="file" id="fileToUpload" name="fileToUpload" required/>


        <button id="rmv" type="button">Remove file</button>


        <div id="img-preview" class="d-flex justify-content-center pt-5"></div>
    </fieldset>

    <input type="submit" name="submit" value="Invia"/>
</form>
<p>
<?php
if(isset($templateParams["erroreRegistrazione"])){
  echo $templateParams["erroreRegistrazione"];
}
?>
</p>

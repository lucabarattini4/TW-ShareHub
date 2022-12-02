<?php require_once 'bootstrap.php'; ?>
<form action="#" method="POST">
  <?php
  
  if(isUserLoggedIn()){
      $templateParams["nome"] = "index.php";
      header("location: index.php");
  }
  ?>

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
        <input type="text" placeholder="sesso" id="sesso" name="sesso" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="prefix">Prefisso telefonico:</label>
        <input type="text" placeholder="prefix" id="prefix" name="prefix" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="numero">Numero di telefono:</label>
        <input type="text" placeholder="numero" id="numero" name="numero" required/>
      </li>
      <li class="d-flex justify-content-center pt-5">
        <label for="email">Email:</label>
        <input type="text" placeholder="email" id="email" name="email" required/>
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
<?php

function uploadImage($path, $image){
  $imageName = basename($image["name"]);
  $fullPath = $path.$imageName;
  
  $maxKB = 500;
  $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
  $result = 0;
  $msg = "";
  //Controllo se immagine è veramente un'immagine
  $imageSize = getimagesize($image["tmp_name"]);
  if($imageSize === false) {
      $msg .= "File caricato non è un'immagine! ";
  }
  //Controllo dimensione dell'immagine < 500KB
  if ($image["size"] > $maxKB * 1024) {
      $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
  }

  //Controllo estensione del file
  $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
  if(!in_array($imageFileType, $acceptedExtensions)){
      $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
  }

  //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
  if (file_exists($fullPath)) {
      $i = 1;
      do{
          $i++;
          $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
      }
      while(file_exists($path.$imageName));
      $fullPath = $path.$imageName;
  }

  //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
  if(strlen($msg)==0){
      if(!move_uploaded_file($image["tmp_name"], $fullPath)){
          $msg.= "Errore nel caricamento dell'immagine.";
      }
      else{
          $result = 1;
          $msg = $imageName;
      }
  }
  return array($result, $msg);
}

function registerLoggedUser($user){
    var_dump($user);
    $_SESSION["idUtente"] = $user["idUtente"];
    var_dump($_SESSION["idUtente"]);
    $_SESSION["username"] = $user["username"];
    $_SESSION["nome"] = $user["nome"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['idUtente']);
}

function isEmailCorrect($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function logOut(){
    session_destroy();
    header("location: login-opt.php");
} 

function isUsernameCorrect($username){
    $regex = preg_match('[@_!#$%^&*()<>?/|}{~:]', $username);
    if($regex){
        return true;
    } 
    return false;
}

/*function checkPrefix($prefix){
    if(strlen($prefix)==2){
        $prefix = stringInsert($prefix, "+", 0);
        $check += "prefix ok: " + $prefix;
    }else{
        $first = substr($prefix, 0, 1);
        if($first!="+"){
            $newStr = substr($prefix, 1);
            $newStr = stringInsert($prefix, "+", 0);
        }
    }
}*/

/**
 * Controlla se il numero di telefono è corretto
 */
function isPhoneCorrect($phone){
    if(is_numeric($phone)){
        return true;
    }
    return false;
}

/**
 * Controlla se la data di nascita inserita è precedente alla data di oggi
 */
function isBirthDayCorrect($date){
    if (strtotime($date) < mktime(0,0,0)){
        return true;
    }
    return false;
}

function isRegisterFormCorrect($username, $email, $prefix, $phone, $date){
    return isEmailCorrect($email) && isPhoneCorrect($prefix) && isBirthDayCorrect($date) /*&& isUsernameCorrect($username)*/;
}

?>
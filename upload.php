<?php
    require_once 'bootstrap.php';
    if(!isset($_SESSION["username"])){
        header("location: login-opt.php");
      }
    
    //Inserisco
    $testoPost = htmlspecialchars($_POST["testopost"]);
    $dataPost = date("Y-m-d");
    $utente = $_SESSION["idUtente"];
    //id utente da prendere dall'utente in sessione
    if($_FILES["fileToUpload"]["name"]!=""){
        $descrizioneImmagine = htmlspecialchars($_POST["descrizioneimmagine"]);
        list($result, $msg) = uploadImage(UPLOAD_DIR_POST, $_FILES["fileToUpload"]);
        if($result != 0){
            $imgPost = $msg;
            $id = $dbh->insertPostWithImg($testoPost, $imgPost, $descrizioneImmagine, $dataPost, $utente);
            if($id!=false){
                header("location: index.php");
            }
            else{
                echo "Errore in inserimento!";
            }
        
        }
        header("location: index.php");
    }else{
        $id = $dbh->insertPostSimple($testoPost, $dataPost, $utente);
        if($id!=false){
            header("location: index.php");
        }
        else{
            echo "Errore in inserimento!";
        }
        
    }
    

?>
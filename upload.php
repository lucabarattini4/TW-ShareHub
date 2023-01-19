<?php
    require_once 'bootstrap.php';
    if(!isset($_SESSION["username"])){
        header("location: login-opt.php");
      }
    
    //Inserisco
    $testoPost = htmlspecialchars($_POST["testopost"]);
    $utente = $_SESSION["idUtente"];
    //id utente da prendere dall'utente in sessione
    if($_FILES["fileToUpload"]["name"]!=""){
        $descrizioneImmagine = htmlspecialchars($_POST["descrizioneimmagine"]);
        list($result, $msg) = uploadImage(UPLOAD_DIR_POST, $_FILES["fileToUpload"]);

        if($result != 0){
            $imgPost = $msg;
            $id = $dbh->insertPostWithImg($testoPost, $imgPost, $descrizioneImmagine, $utente);
            if($id!=false){
                header("location: index.php");
            }
            else{

                $templateParams["errore"] = $msg;
                header("location: nuovo-post.php?msg=".$msg);

            }
        
        }else{
            $templateParams["errore"] = $msg;
            header("location: nuovo-post.php?msg=".$msg);
        }
        //header("location: index.php");
    }else{
        $id = $dbh->insertPostSimple($testoPost, $utente);
        if($id!=false){
            header("location: index.php");
        }
        else{
            $templateParams["errore"] = "Post non inserito";
            header("location: nuovo-post.php?msg=".$msg);
        }
        
    }
    

?>
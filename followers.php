<?php
require_once 'bootstrap.php';

if(isset($_GET["user"]) && isset($_GET["tipo"])){

  $idUser = $dbh->getIdFromUsername($_GET["user"]);

  if($_GET["tipo"] == "follower"){
    
    $templateParams["lista"] = $dbh->getFollowers($idUser);
    $templateParams["tipo"] = "FOLLOWERS";
  }
  if($_GET["tipo"] == "followed"){

    $templateParams["lista"] = $dbh->getFollowed($idUser);
    $templateParams["tipo"] = "FOLLOWED";

  }

$templateParams["nome"] = "follower.php";
$templateParams["css"] = array("css/style.css", "css/followers.css");
require 'template/base.php';
}

?>
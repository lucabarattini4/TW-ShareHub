<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "lista-chat.php";
$templateParams["single"] = $dbh->getUserSingleChat($_SESSION["idUtente"]);
$templateParams["css"] = array("css/style.css","css/chat.css");


require 'template/base.php';
?>

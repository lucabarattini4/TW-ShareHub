<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "lista-chat.php";
$templateParams["chat"] = $dbh->getUserChat();
$templateParams["css"] = array("css/style.css");


require 'template/base.php';
?>

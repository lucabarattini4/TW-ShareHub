<?php
require_once 'bootstrap.php';
if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}

$templateParams["nome"] = "inserisci-post.php";
$templateParams["js"] = array("script/anteprima-img.js");
$templateParams["css"] = array("css/style.css");

require 'template/base.php';
?>
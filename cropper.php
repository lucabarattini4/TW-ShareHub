<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "template\crop-photo.php";
$templateParams["css"] = array("css/style.css");


require 'template/base.php';
?>

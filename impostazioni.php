<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "lista-impostazioni.php";
$templateParams["css"] = array("css/style.css","css/setting.css");

require 'template/base.php';
?>

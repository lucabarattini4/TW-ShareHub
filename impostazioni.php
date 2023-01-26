<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
//$templateParams["nome"] = "lista-impostazioni.php";
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/notifications.js", "js/impostazioni.js");
$templateParams["css"] = array("css/style.css");
 
require 'template/base.php';
?>
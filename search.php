<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}

$templateParams["css"] = array("css/style.css", "css/search.css");
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/search.js");

require 'template/base.php';
?>
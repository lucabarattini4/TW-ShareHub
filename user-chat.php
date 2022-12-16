<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","js/chat.js");
$templateParams["css"] = array("css/style.css","css/chat.css");


require 'template/base.php';
?>

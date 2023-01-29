

<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "changing-name.php";
$templateParams["css"] = array("css/style.css", "css/setting.css");
$templateParams["js"] = array("js/notifications.js");

require 'template/base.php';
?>

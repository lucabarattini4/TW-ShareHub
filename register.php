<?php
require_once 'bootstrap.php';

$templateParams["nome"] = "register-form.php";
$templateParams["css"] = array("css/style.css", "css/form.css","css/login.css");
$templateParams["js"] = array("js/anteprima-img.js");

require 'template/base.php';
?>

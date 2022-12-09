<?php
require_once 'bootstrap.php';

$templateParams["nome"] = "register-form.php";
$templateParams["js"] = array("js/anteprima-img.js");
$templateParams["css"] = array("css/style.css", "css/form.css");

require 'template/base.php';
?>
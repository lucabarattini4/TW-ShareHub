<?php
require_once 'bootstrap.php';

$templateParams["nome"] = "vedi-profilo.php";
$templateParams["post"] =  $dbh->getUserPosts("zioPaperoneIlGrande");
$templateParams["info"] =  $dbh->getUserInfo("zioPaperoneIlGrande");
$templateParams["css"] = array("css/style.css", "css/profilo.css");
require 'template/base.php';
?>

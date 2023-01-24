<?php
require_once 'bootstrap.php';

//$templateParams["nome"] = "vedi-profilo.php";
$templateParams["css"] = array("css/style.css", "css/profilo.css");
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/index.js", "js/like.js", "js/save.js", "js/comment.js", "js/notifications.js", "js/follow.js");
require 'template/base.php';
?>

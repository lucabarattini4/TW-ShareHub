<?php
require_once 'bootstrap.php';

$templateParams["nome"] = "lista-post.php";
$templateParams["post"] = $dbh->getPosts(5);

require 'template/base.php';
?>
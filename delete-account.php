<?php
require_once 'bootstrap.php';

$dbh->DeleteAccount($_SESSION["idUtente"]);

require 'template/base.php';
?>

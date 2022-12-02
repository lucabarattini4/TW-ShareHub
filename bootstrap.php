<?php
session_start();
define("UPLOAD_DIR_POST", "./upload/post/");
define("UPLOAD_DIR_PROFILE", "./upload/profile/");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "sharehub");
?>
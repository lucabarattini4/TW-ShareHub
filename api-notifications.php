<?php
require_once 'bootstrap.php';

$result["notifications"] = $dbh->getNotifications($_SESSION["idUtente"]);
$result["newNotificationsNumber"] = $dbh->getNewNotificationsNumber($_SESSION["idUtente"]);

header('Content-Type: application/json');
echo json_encode($result);
?>
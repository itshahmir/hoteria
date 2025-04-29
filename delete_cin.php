<?php
include 'include/classes/session.php';
$id = $_GET['id'];
$q = "DELETE FROM checkin WHERE id = '$id'";
$database->query($q);
$q = "DELETE FROM receiving WHERE checkin_id = '$id'";
$database->query($q);
$q = "DELETE FROM `booked_dates` WHERE `checkin_id` = '$id'";
$database->query($q);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>
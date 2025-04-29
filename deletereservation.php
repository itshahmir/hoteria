<?php
if($_GET['index'] == "reservation"){
include 'include/classes/session.php';
$id = $_GET['id'];

$q = "SELECT `reservation_rooms_id` FROM reservations WHERE res_id = '$id'";
$ry = $database->query($q);

$rooms_id_ry = mysqli_fetch_row($ry);
var_dump($rooms_id_ry);
$rooms_id = $rooms_id_ry[0];

$q = "DELETE FROM `reservation_rooms` WHERE `rooms_id` = '$rooms_id'";
$database->query($q);

$q = "DELETE FROM `reservations` WHERE `res_id` = '$id'";
$database->query($q);

$q = "DELETE FROM `reserved_dates` WHERE `reservation_id` = '$id'";
$database->query($q);

header("Location: viewreservation.php");
}

?>
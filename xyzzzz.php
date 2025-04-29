<?php
include 'include/classes/session.php';
// echo $database->get_rooms_new("3bed", "2022-05-19", "2");


$query = "SELECT * FROM checkin WHERE id = '66062899' AND rep_id = 0 order BY id ASC LIMIT 1";
$checkinResult = $database->query($query);
$checkinRow = mysqli_fetch_row($checkinResult);
var_dump($checkinRow);

echo "<br>";


$id = $checkinRow[0];
echo "<br>";
$roomsId = $checkinRow[6];
echo $roomsId;

echo "<br>";
echo "<br>";
$query = "SELECT * FROM booked_dates WHERE checkin_id = '$id'";
$bookedDatesResult = $database->query($query);
$bookedDatesArray = mysqli_fetch_all($bookedDatesResult);

foreach ($bookedDatesArray as $key => $value) {
    var_dump($value);
    echo "<br>";

}
echo "<br>";

$query = "SELECT * FROM `room` WHERE rooms_id = '$roomsId'";
$roomsResult = $database->query($query);
$roomsArray = mysqli_fetch_all($roomsResult);


foreach ($roomsArray as $key => $value) {
    var_dump($value);
    echo "<br>";

}





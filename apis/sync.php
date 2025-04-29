<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

include '../include/classes/session.php';



$query = "SELECT * FROM checkin WHERE rep_id = 0 order BY id ASC LIMIT 1";
$checkinResult = $database->query($query);
$checkinRow = mysqli_fetch_row($checkinResult);
// var_dump($checkinRow);

$id = $checkinRow[0];


if($id ==  ""){
    echo "Everything Exported !";
} else{

include 'remotedb.php';

$remoteDb->query("INSERT INTO `checkin`(`id`, `name`, `cnic`, `city`, `date_in`, `date_out`, `rooms_id`, `rate`, `discount`, `total`, `name_on_bill`, `number`, `advance`, `checkout_status`, `user`, `cin_time`, `cout_time`, `rep_id`) VALUES ('$checkinRow[0]','$checkinRow[1]','$checkinRow[2]','$checkinRow[3]','$checkinRow[4]','$checkinRow[5]','$checkinRow[6]','$checkinRow[7]','$checkinRow[8]','$checkinRow[9]','$checkinRow[10]','$checkinRow[11]','$checkinRow[12]','$checkinRow[13]','$checkinRow[14]','$checkinRow[15]','$checkinRow[16]','$checkinRow[17]')");




$roomsId = $checkinRow[6];

$query = "SELECT * FROM booked_dates WHERE checkin_id = '$id'";
$bookedDatesResult = $database->query($query);
$bookedDatesArray = mysqli_fetch_all($bookedDatesResult);

foreach ($bookedDatesArray as $key => $value) {
    
    $remoteDb->query("INSERT INTO `booked_dates`(`id`, `checkin_id`, `date_n`) VALUES ('$value[0]','$value[1]','$value[2]')");


}


$query = "SELECT * FROM `room` WHERE rooms_id = '$roomsId'";
$roomsResult = $database->query($query);
$roomsArray = mysqli_fetch_all($roomsResult);


foreach ($roomsArray as $key => $value) {
    // var_dump($value);
    $remoteDb->query("INSERT INTO `room`(`id`, `rooms_id`, `room_category`, `room_number`, `name_on_bill`) VALUES ('$value[0]','$value[1]','$value[2]','$value[3]','$value[4]')");
    

}
$database->query("UPDATE `checkin` SET rep_id = '1' WHERE id = '$id'");

echo "Replication Log (Data id: ".$id." )";



} 
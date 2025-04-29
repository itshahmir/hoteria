<?php
 include 'include/classes/session.php';
$checkin_id = $_POST['checkin'];
$amount = $_POST['amount'];
$rooms_id = $_POST['rooms_id'];
$room_number = $_POST['room_number'];
$recieved = $_POST['recieved'];
$db_rec = $database->update_bill_resturant($rooms_id, $room_number, $amount, $recieved);
if ($db_rec != $recieved) {
    echo "entry done". $db_rec." =/ ".$recieved;

    $new_rec = $recieved - $db_rec;
    $database->add_recieving($checkin_id, "Resturant", $new_rec);
} else {
    echo "not done". $db_rec." == ".$recieved;
}

?>
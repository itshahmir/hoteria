<?php
include 'include/classes/session.php';
$id = $_GET['id'];
$timestamp = strtotime(date());
$date = date('Y-m-d');


    $leave = "";
    $array_leave = $database->get_leave_details($id);
    $leave = ($array_leave[0]); 

if($leave != "")
{
    $q = "DELETE FROM `attendance` WHERE `id` = '$leave'";
    $database->query($q);
    header("Location: view_employees.php");
}
else{
    header("Location: view_employees.php?id=".$leave);
}

?>
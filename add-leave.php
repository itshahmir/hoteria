<?php
include 'include/classes/session.php';
$id = $_GET['id'];
$timestamp = strtotime(date('Y-m-d'));
$date = date('Y-m-d');


    $leave = "";
    $array_leave = $database->get_leave_details($row[0]);
    $leave = ($array_leave[0]); 

if($leave == "")
{
    $q = "INSERT INTO `attendance`(`emp_id`, `timestamp`, `date`) VALUES ('$id','$timestamp','$date')";
    $database->query($q);
    header("Location: view_employees.php");
}
else{
    header("Location: view_employees.php");
}

?>
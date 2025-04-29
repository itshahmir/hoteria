<?php 
include 'include/classes/session.php';
$date = $_GET['date'];
$details = $_GET['details'];
$amount = $_GET['amount'];
$q = "INSERT INTO `expenses`(`id`, `details`, `date`, `amount`) VALUES ('','$details','$date','$amount')";
$database->query($q);
header("Location: expensesheet.php");
 ?>
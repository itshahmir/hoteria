<?php 
include 'include/classes/session.php';
$id = $_POST['sr'];
$date = date('d-m-Y');
$qty = $_POST['qty'];
$total = $_POST['total'];
$database->add_cavity($id,$date,$qty,$total);
?>
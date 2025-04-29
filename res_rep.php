<?php 
include 'include/classes/session.php';
$id = $_GET['sr'];
$date = date('Y-m-d');
$rooms = $_GET['rooms'];
$total = $_GET['total'];
$user = $session->username;
$database->add_res_rep($id,$rooms, $date, $total);
?>
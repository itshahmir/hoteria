<?php
include 'include/classes/session.php';
$id = $_GET['id'];

$array = $database->get_employees_details($_GET['id']);
$id = ($array[0]);

$emp_pic = ($array[7]);
$agreement = ($array[8]);

unlink('employee/images/'.$emp_pic);
unlink('employee/agreements/'.$agreement);

$q = "DELETE from `add_employees`  WHERE `id` = $id";

$database->query($q);
header("Location: view_employees.php");
?>
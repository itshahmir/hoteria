<?php 
include 'include/classes/session.php';
$date=$_POST['date'];
$leave=$_POST['leave'];
	$bonus=$_POST['bonus'];
	$advance=$_POST['advance'];
	$id=$_POST['id'];

    $sql1 = "select * from employee_date_details where emp_id =  '$id' AND date = '$date'";
   $result = $database->query($sql1);
   $row = mysqli_fetch_assoc($result);
  
   if(mysqli_num_rows($result)>0){
   
   $sql2="UPDATE `employee_date_details` SET `emp_id`='$id',`date`='$date',`leave_emp`='$leave',`bonus`='$bonus',`advance`='$advance' WHERE emp_id =  '$id' AND date = '$date'"; 
   $database->query($sql2);   
}else{

    $sql = "INSERT INTO `employee_date_details`( `emp_id`,`date`, `leave_emp`, `bonus`, `advance`) 
	VALUES ('$id','$date','$leave','$bonus','$advance')";
    
   $database->query($sql);
   }

	
	
	


 ?>
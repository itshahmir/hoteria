<?php 
include 'include/classes/session.php';
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

?>
<table id="tb1" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>Rooms</th>
            <th>Name</th>
            <th>Date</th>
            <th>CNIC</th>
            <th>Number</th>
            <th>Total <span id="total"></span> </th>
            <th>Received <span id="total_e"></span> </th>
             <th>User</th>
     <th>Action</th>
        </tr>
    </thead>
    <tbody id="myTable"><?php
$database->groupdata('checkins_reports_all',$date1,$date2,'',''); ?>
    </tbody>
      <tfoot>
      
            <tr>
            <th>Rooms</th>
            <th>Name</th>
            <th>Date</th>
            <th>CNIC</th>
            <th>Number</th>
            <th>Total <span id="total1"></span> </th>
            <th>Received <span id="total1_e"></span> </th>
             <th>User</th>
         <th>Action</th>
        </tr>
        
    </tfoot>
</table>




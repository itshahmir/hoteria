<?php 
include 'include/classes/session.php';
$date = $_POST['date'];

?>
<table id="tb1" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>Rooms</th>
            <th>Name</th>
            <th>Checkin Date</th>
            <th>CNIC</th>
            <th>Number</th>
            <th>Total</th>
            <th>Received <span id="total_e"></span> </th>
             <th>Checkinn by</th>
             <th>Checkout by</th>
             <th>Action</th>
             
        </tr>
    </thead>
    <tbody id="myTable"><?php
$database->report_booking($date); ?>
    </tbody>
      <tfoot>
      
            <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Total <span id="total1"></span> <a href="expensesheet.php" class="btn btn-primary">View</a></th>
            <th>Received <span id="total1_e"></span> </th>
             <th></th>
             <th></th>
             <th></th>
        </tr>
        
    </tfoot>
</table>

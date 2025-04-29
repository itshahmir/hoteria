<?php 
include 'include/classes/session.php';
$date = $_POST['date'];?>


<table id="tb1" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>Sr</th>
            <th>Rooms</th>
            <th>Date</th>
            <th>Total <span id="total1"></span></th>
            <th>User</th>
          
        </tr>
    </thead>
    <tbody id="myTable"><?php
$database->groupdata('resturants_reports',$date,'','','');
?>
    </tbody>
      <tfoot>
      <tr>
           <th>Sr</th>
            <th>Rooms</th>
            <th>Date</th>
            <th>Total <span id="total"></span></th>
            <th>User</th>
        </tr>
    </tfoot>
</table>
<?php 
include 'include/classes/session.php';
$date = $_POST['date'];?>
<table id="tb1" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>Rooms</th>
            <th>Name</th>
            <th>Date</th>
           
        
            <th>CNIC</th>
            <th>Number</th>
            <th>City</th>
             <th>User</th>
             <th>Action</th>
        </tr>
    </thead>
    <tbody id="myTable">
<?php
$database->groupdata('checkins_reports_police',$date,'','','');
?>
    </tbody>
      <tfoot>
      
            <tr>
            <th>Rooms</th>
            <th>Name</th>
            <th>Date</th>
           
         
            <th>CNIC</th>
            <th>Number</th>
            <th>City</th>
             <th>User</th>
             <th>Action</th>
        </tr>
        
    </tfoot>
</table>
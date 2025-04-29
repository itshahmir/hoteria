<?php 
include 'include/classes/session.php';
$date = $_POST['date'];

?>

<table id="tb1" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th style="max-width:85px !important;">Serial Id</th>
            <th>Details</th>
          
            <th style="max-width:55px !important;">Amount <span id="total"></span> </th>
             <th style="max-width:85px !important;">Action</th>
        </tr>
    </thead>
    <tbody id="myTable"><?php
$database->expenses($date); ?>
    </tbody>
      <tfoot>
      
            <tr>
            <th style="max-width:85px !important;">Serial Id</th>
            <th>Details</th>
            <th>Amount <span id="total1"></span> </th>
             <th style="max-width:85px !important;">Action</th>
        </tr>
        
    </tfoot>
</table>

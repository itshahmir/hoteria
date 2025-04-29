<?php 
include 'include/classes/session.php';
$date = $_POST['date'];
$id = $_POST['id'];
$pay = $_POST['pay'];


?>
  <table id="tb1" class="table table-striped table-bordered" style="font-size: 12px;">
               <thead>
                  <tr>
                     <th>D-M-Y</th>
                     <th>Daily Amount</th>
                     <th>Leave()</th>
                     <th>Bonus()</th>
                     <th>Advance()</th>
                     <th>Total Remaining</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody id="myTable"><?php
                  $database->employees_dateDetails($date,$id,$pay); ?>
               </tbody>
               <tfoot>
                  <tr>
                     <th>D-M-Y</th>
                     <th>Daily Amount</th>
                     <th>Leave</th>
                     <th>Bonus</th>
                     <th>Advance</th>
                     <th>Total Remaining</th>
                     <th>Action</th>
                  </tr>
               </tfoot>
            </table>
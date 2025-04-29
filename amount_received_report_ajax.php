       <?php 
include 'include/classes/session.php';
$date = $_POST['date'];
$user = $_POST['user'];
?>
        <table id="tb1" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>Rooms</th>
            <th>User Name</th>
            <th>Type</th>
           
        </tr>
    </thead>
    <tbody id="myTable"><?php
$database->report_amount($date); ?>
    </tbody>
      <tfoot>
      
         
        </tr>
        
    </tfoot>
</table>
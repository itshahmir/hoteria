<!DOCTYPE html>
<html>
    <style>
        @media only screen and (max-width: 575px){
    #fdb{
      overflow-x: scroll;
    }
  }
    </style>
<?php include 'head.php'; ?>    
<body style="background-color: #a3a3a347;">
<?php include 'head_menu.php'; ?> 

  <div class="col text-center mt-5">
                <h1>Orders</h1>
              </div>
<div class="container">
    <div class="fdb-block" id="fdb">

<table id="tb2" class="table table-striped table-bordered" >

    <thead>
        <tr>
            <th>Room No</th>
            <th>Date</th>
            <th>Order No</th>
            <th>Order</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php $database->groupdata("get_orders_delivered","","","",""); ?> 
    </tbody>
      <tfoot>
        <tr>
            <th>Room No</th>
            <th>Date</th>
            <th>Order No</th>
            <th>Order</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table></div></div>

<?php include 'foot.php'; ?>


<script type="text/javascript">

var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date( data[4] );
  
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'MMMM Do YYYY'
     });
     maxDate = new DateTime($('#max'), {
         format: 'MMMM Do YYYY'
     });
  
     // DataTables initialisation
     var table = $('#tb1').DataTable({
    paging: false
});
  
     // Refilter the table
     $('#min, #max').on('change', function () {
         table.draw();
     });
 });

</script>    
    <script type="text/javascript">
     $('#tb2').dataTable({
    paging: false
});
    </script>


</body>
</html>

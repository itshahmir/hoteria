<!DOCTYPE html>
<html>
    <style>
        @media (max-width:775px){
            #fdb{
                overflow-x: scroll;
            }
        }
    </style>
<?php

include 'head.php'; ?>

<body style="background-color: #a3a3a347;">
    <?php include 'head_menu.php';
   
    ?>
    <div class="col text-center mt-5">
        <h1>Reservations</h1>
    </div>
    <div class="container mt-5">
        <div class="fdb-block">
            <div id="fdb">
            <table id="tableee" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Room Numbers</th>
                        <th>Name</th>
                        <th>Checkin Date</th>
                        <th>CheckOut Date</th>
                        <th>Mobile Number</th>
                        <th>Total Bill</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php $database->groupdata("reservation", "", "", "", ""); ?>
                </tbody>

            </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        var table =  $('#tableee').DataTable();

        $('div.dataTables_filter input', table.table().container()).focus();
    });
    </script>


    <?php include 'foot.php'; ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tb1').DataTable();
    });
    </script>
</body>

</html>
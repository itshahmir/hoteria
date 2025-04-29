<!DOCTYPE html>
<html>
<?php include 'head.php'; 
$err = 0;
    if($_GET['variable'] == 1)
    {
        $err = "Error: CuttingMoreThanBasicSallery";
    }
    else{
        $err ="";
    }
    
?>

<body style="background-color: #a3a3a347;">
    <?php include 'head_menu.php'; ?>
    
    <div class="col text-center mt-5">
        <h1>Employees</h1>
    </div>
    <div class="container mt-5">
        <center>
            <?php 
                echo $err;
            ?>
        </center>
        <div class="fdb-block" style="overflow-x: scroll;">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Cnic</th>
                        <th>Phone No</th>
                        <th>Base Salary</th>
                        <th style="min-width: 80px;">Hiring Date</th>
                        <th style="min-width: 80px;">Pay Date</th>
                        <th>Image</th>
                        <th>Agreement File</th>
                        <th>Sallery Month Status</th>
                        <th>Leaves</th>
                        <th style="min-width: 170px;">Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php $database->groupdata("employees", "", "", "", ""); ?>
                </tbody>

            </table>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tableee').DataTable();
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
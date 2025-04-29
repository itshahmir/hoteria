<!DOCTYPE html>
<html>
    <style>
        @media only screen and (max-width: 775px){
    #fdb{
      overflow-x: scroll;
    }
  }
    </style>
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
        <h1>Rooms</h1>
    </div>
    <div class="container mt-5">
        <center>
            <?php 
                 echo $err;
            ?>
        </center>
        <div class="fdb-block" id="fdb">
            <table id="tableee" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Seriel</th>
                         <th>Restaurant Name</th>
                        <th>Category</th>
                        <th>Rome Number</th>
                        <th>Rent</th>
                        
                        <th style="min-width: 170px;">Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php $database->groupdata("rooms", "", "", "", ""); ?>
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
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else{
    $id = "";
}

$result = $database->get_employees_details($id);
$name = $result[1];
   
?>

<body style="background-color: #a3a3a347;">
    <?php include 'head_menu.php'; ?>
    <?php if($id != ""){ ?>
    <div class="col text-center mt-5">
        <h1><?php echo $name; ?> Paid Details</h1>
    </div>
    <div class="container mt-5">
        <div class="fdb-block" style="overflow-x: scroll;">
            <table id="tableee" class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th>Pay Month</th>
                        <th>Basic Salary</th>
                        <th>Bonus</th>
                        <th>Advance</th>
                        <th>Paid After</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php $database->groupdata("employees_salary_detail", $id, "", "", ""); ?>
                </tbody>

            </table>
        </div>
    </div>

    <?php }
    else{
        echo "Your cannnot view this page your id is missing";
    }?>
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
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<body style="background-color: #a3a3a347;">
    <?php include 'head_menu.php'; ?>
    <div class="col text-center mt-5">
        <h1>Employees Paid Overall</h1>
    </div>
    <div class="container">
        <div class="fdb-block" style="overflow-x: scroll;">
            <table id="tableee" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>currupt page delete this over all page</th>
                      
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php $database->groupdata("employees_salary", "", "", "", ""); ?>
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
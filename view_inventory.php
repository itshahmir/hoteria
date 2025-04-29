<!DOCTYPE html>
<html>
    <style>
        @media (max-width:456px){
            #taaa{
                overflow-x: scroll;
            }
        }
    </style>
<?php include 'head.php'; ?>

<body style="background-color: #a3a3a347;">
    <?php include 'head_menu.php'; ?>

    <div class="col text-center mt-5">
        <h1>Checkins</h1>
        <p class="lead">View Checkins <select id="filterText" onchange='filterText()'>
                <option value="<?php echo date("d-m-Y"); ?>">Today</option>
                <option value="all">All</option>
            </select></p>
    </div>
    <div class="m-5">
        <div class="fdb-block" id ="ta"style="max-width: 1000px !important; margin-left: auto !important; margin-right: auto !important; ">
        <div id="taaa">
            <table id="tableee" class="table table-striped table-bordered" style="overflow-x: scroll;">

                <thead>
                    <tr style="background-color: #c5c5c5 !important;">
                        <th>Serial</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $database->groupdata("view_inventory", "", "", "", ""); ?>
                </tbody>

            </table>
        </div>

        </div>
    </div>
    <?php include 'foot.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tableee').DataTable();
        });
    </script>
</body>

</html>
<?php
include 'include/classes/session.php';
$month = $_POST['month']; ?>
<table id="tb1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Sr Number</th>
            <th>Date</th>
            <th>Qty <span id="total_1"></th>
            <th>Total <span id="total"></span>
            </th>
            <th>Month</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        $database->groupdata('cavity_report', $month, '', '', '');
        ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Sr Number</th>
            <th>Date</th>
            <th>Qty <span id="total1_1"></th>
            <th>Total <span id="total1"></span>
            </th>
            <th>Month</th>
            <th>User</th>
        </tr>
    </tfoot>
</table>
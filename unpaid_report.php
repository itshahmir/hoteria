<!DOCTYPE html>
<html>
<style>
        @media only screen and (max-width: 675px){
    #fdb{
      overflow-x: scroll;
    }
  }
    </style>
<?php include 'head.php'; ?>

<body onload="show_month()" style="background-color: #a3a3a347;">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
    <?php include 'head_menu.php'; ?>
<br>
    <div class="row">
        <div class="container" id="fdb">
            <table id="tb11" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Rooms</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Total Received <span id="total_e__1"></span> </th>
                        <th>Total Remaining <span id="total__1"></span> </th>
                        

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="myTable"><?php
                
                                    $database->report_resturant_unpaid(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Rooms</th>
                        <th>Name</th>
                        <th>Date</th>
                         <th>Total Received <span id="total_e__1"></span> </th>
                        <th>Total Remaining <span id="total__1"></span> </th>
                       
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function() {
            html2canvas($('#tb1')[0], {
                onrendered: function(canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
    </script>
    <?php include 'foot.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tb1').DataTable({
                paging: false
            });
            $('#tb11').DataTable({
                paging: false
            });
            var tds = document.getElementById('tb1').getElementsByTagName('td');

            var sum = 0;
            for (var i = 0; i < tds.length; i++) {
                if (tds[i].className == 'count-me') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total').innerHTML = 'PKR ' + sum;
            document.getElementById('total1').innerHTML = 'PKR ' + sum;


            var tds = document.getElementById('tb1').getElementsByTagName('td');

            var sum = 0;
            for (var i = 0; i < tds.length; i++) {
                if (tds[i].className == 'count-me1') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total_e').innerHTML = 'PKR ' + sum;
            document.getElementById('total1_e').innerHTML = 'PKR ' + sum;


            var tds = document.getElementById('tb11').getElementsByTagName('td');

            var sum = 0;
            for (var i = 0; i < tds.length; i++) {
                if (tds[i].className == 'count-me__1') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total__1').innerHTML = 'PKR ' + sum;
            document.getElementById('total1__1').innerHTML = 'PKR ' + sum;


            var tds = document.getElementById('tb11').getElementsByTagName('td');

            var sum = 0;
            for (var i = 0; i < tds.length; i++) {
                if (tds[i].className == 'count-me1__1') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total_e__1').innerHTML = 'PKR ' + sum;
            document.getElementById('total1_e__1').innerHTML = 'PKR ' + sum;

        });
    </script>
</body>

</html>
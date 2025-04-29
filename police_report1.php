<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>    
<body onload="show_month()" style="background-color: #a3a3a347;">
<?php include 'head_menu.php'; ?> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>

  <div class="col text-center mt-5">
                <h1><?php echo date('F'); ?></h1>
                <p class="lead">View</p>



    <div class="row m-4 p-4 justify-content-sm-center text-center">
  <div class="col-2"><h5>FROM</h5></div>
 <div class="col-4"><input type="date" id="min" name="min" class="form-control" style="width: 400px"></div>
 <div class="col-2"><h5>TO</h5></div>
 <div class="col-4"><input type="date" id="max" name="max" class="form-control" style="width: 400px"></div>
</div>
      <button id="btnGo" type="button">Go</button>
    <input type="button" id="btnExport" value="Export" />
              </div>

              
<div class="m-5">
    <div class="fdb-block" id="datata">


        <table id="tb1" class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th>Rooms</th>
            <th>Name</th>
            <th>Date</th>
            <th>CNIC</th>
            <th>Number</th>
            <th>Total <span id="total"></span> </th>
            <th>Received <span id="total_e"></span> </th>
             <th>User</th>
    <th>Actuion</th>
        </tr>
    </thead>
    <tbody id="myTable"><?php
$database->groupdata('checkins_reports_all','','','',''); ?>
    </tbody>
      <tfoot>
      
            <tr>
            <th>Rooms</th>
            <th>Name</th>
            <th>Date</th>
            <th>CNIC</th>
            <th>Number</th>
            <th>Total <span id="total1"></span> </th>
            <th>Received <span id="total1_e"></span> </th>
             <th>User</th>
        <th>User</th>
        </tr>
        
    </tfoot>
</table>
    </div></div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tb1')[0], {
                onrendered: function (canvas) {
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
    function show_month(){
  


    $.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {

          
        var valid = true;
        var min = moment($("#min").val());
        if (!min.isValid()) { min = null; }

        var max = moment($("#max").val());
        if (!max.isValid()) { max = null; }

        if (min === null && max === null) {
            // no filter applied or no date columns
            valid = true;
        }
        else {

            $.each(settings.aoColumns, function (i, col) {
              
                if (col.type == "date") {
                    var cDate = moment(data[i]);
                
                    if (cDate.isValid()) {
                        if (max !== null && max.isBefore(cDate)) {
                            valid = false;
                        }
                        if (min !== null && cDate.isBefore(min)) {
                            valid = false;
                        }
                    }
                    else {
                        valid = false;
                    }
                }
            });
        }
        return valid;
});

$(document).ready( function () {
    $("#btnGo").click(function () {
        $('#tb1').DataTable().draw();
       
    });
    var table = $('#tb1').DataTable(
      {columns:[{name:"Rooms"},
                {name:"Name"},
                 {name:"Date", type:"date"},
                {name:"CNIC"},
                {name:"Number"},
                {name:"Total"},
                {name:"Received"},
                {name:"User"}],
                paging:false}
    );
} );
$("#btnGo").click(function () {
        
       setTimeout(function(){
        var tds = document.getElementById('tb1').getElementsByTagName('td');
      
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total').innerHTML = 'PKR ' + sum;
            document.getElementById('total1').innerHTML = 'PKR ' + sum;


        var tds = document.getElementById('tb1').getElementsByTagName('td');
      
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me1') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total_e').innerHTML = 'PKR ' + sum;
            document.getElementById('total1_e').innerHTML = 'PKR ' + sum;
        }, 200);
      
    });
       setTimeout(function(){
        var tds = document.getElementById('tb1').getElementsByTagName('td');
      
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total').innerHTML = 'PKR ' + sum;
            document.getElementById('total1').innerHTML = 'PKR ' + sum;


        var tds = document.getElementById('tb1').getElementsByTagName('td');
      
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me1') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total_e').innerHTML = 'PKR ' + sum;
            document.getElementById('total1_e').innerHTML = 'PKR ' + sum;
        }, 200);
      }

</script> 




</body>
</html>

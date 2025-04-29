<!DOCTYPE html>
<html>
    <style>
        @media only screen and (max-width: 460px){
    #datata{
      overflow-x: scroll;
    }
  }
    </style>
<?php include 'head.php'; ?>    
<body onload="show_month()" onkeydown="if(event.keyCode == 107){add_row()}" style="background-color: #a3a3a347;">
<?php include 'head_menu.php'; ?> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
<script>
$(function(){
  $('#gMonth2').change(function(){
    var month = $(this).val();
    $('#gMonth1').val(month);
  });
 });
 </script>
  <div class="col text-center mt-5">
                <h1><?php echo date('F'); ?></h1>
             <br><br>

<div id="container"></div>
<input type="date" id='gMonth1' onchange="show_month()" data-date-format="DD MMMM YYYY" value="">
   
    <button class="btn btn-warning" onclick="add_row()">Add row</button>
    
              </div>
<div class="m-5">
    <script type="text/javascript">
  
       var sr = "<?php echo $database->getExpenseNum(); ?>";
    function add_row(){
    
        sr++;
         var table = document.getElementById("myTable");
  var row = table.insertRow(0);
  var serial = row.insertCell(0);
  var details = row.insertCell(1);

  var amount = row.insertCell(2);
  var action = row.insertCell(3);

  serial.innerHTML = sr;
  amount.innerHTML = '<input type="text" placeholder="Amount" class="form-control" id="amount_'+sr+'">';
  details.innerHTML = '<input type="text" placeholder="Details" class="form-control" id="details_'+sr+'">';
  action.innerHTML = '<button class="btn btn-primary" id="btn_'+sr+'">Save</button>';


var fs = [];
fs[sr] = new Function('amount', 'details', 'date', 'var xhttp = new XMLHttpRequest(); xhttp.open("GET", "add_expense_ajax.php?date="+date+"&details="+details+"&amount="+amount+"", true);xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");xhttp.send();');

document.getElementById('btn_'+sr+'').addEventListener('click' , function(){
    v_amt = document.getElementById('amount_'+sr+'').value;
    v_details = document.getElementById('details_'+sr+'').value;
    v_date = document.getElementById('gMonth1').value;
    fs[sr](v_amt, v_details, v_date);
    location.reload();
}) ; 


    }



</script>

    <div class="fdb-block container" id="datata"></div></div>

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
		var month2 = $('#gMonth1').val();
        
    
            var month = month2;
       
          
		$.post("expensesheet_ajax.php",
  {
    date:month
  },
  function(data, status){
    $("#datata").html(data);
     $('#tb1').dataTable({
    paging: false
});
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


  
      
    
        }, 200);
      }

</script>  
</body>
</html>

<!DOCTYPE html>
<html>
<style>
        @media only screen and (max-width: 975px){
    #datata{
      overflow-x: scroll;
    }
  }
    </style>
<?php include 'head.php'; ?>    
<body onload="show_month()" style="background-color: #a3a3a347;">
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
<input type="hidden" value="0" id="ajax_total_hidden">

<input type="date" id='gMonth1' onchange="show_month()" data-date-format="DD MMMM YYYY" value="">
    
              </div>

              
<div class="m-5">
    <div id="datata" class="container"></div></div>

    

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
    var month = $('#gMonth1').val();
    
    $.post("police_report_ajax.php",
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
                   var monthly = $.ajax({type: "GET", url: "date_ajax.php", data:{date:month,expense:0} , async: false}).responseText;

                 
           
           document.getElementById("ajax_total_hidden").value = sum;
            var ledger = sum - monthly;
            document.getElementById('total1').innerHTML = 'PKR ' + sum + ' - ' + monthly +' = '+ ledger;



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

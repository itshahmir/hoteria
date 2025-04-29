<!DOCTYPE html>
<html>
<style>
        @media only screen and (max-width: 550px){
    #datata{
      overflow-x: scroll;
    }
  }
    </style>
<?php include 'head.php'; ?>    
<body style="background-color: #a3a3a347;">
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
               
                <p class="lead">View</p>
<input type="date" id='gMonth1' onchange="show_month()" data-date-format="DD MMMM YYYY" value="<?php echo date("Y-m-d") ?>"><br>


              </div>
<div class="m-5">
    <div class="fdb-block container" id="datata">


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
        var month = $('#gMonth1').val();
         var user = $( "#users option:selected" ).text();
        $.post("amount_received_report_ajax.php",
  {
    date:month, user:user
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
     


        var tds = document.getElementById('tb1').getElementsByTagName('td');
      
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me1') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total_1').innerHTML = 'PKR ' + sum;

        }, 200);
      }
 function show_month_user(){
        var month = $('#gMonth1').val();
        

        $.post("amount_received_report_ajax.php",
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
     



      
          

        }, 200);
      }
</script>  
</body>
</html>

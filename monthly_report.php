<!DOCTYPE html>
<html>
<style>
        @media only screen and (max-width: 1050px){
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
        $(function() {
            $('#gMonth2').change(function() {
                var month = $(this).val();
                $('#gMonth1').val(month);
            });
        });
    </script>

   
    <div class="row m-4 p-4 justify-content-sm-center text-center">
  <div class="col-2"><h5>FROM</h5></div>
 <div class="col-4"><input type="date" id="min" name="min" class="form-control" style="width: 400px"></div>
 <div class="col-2"><h5>TO</h5></div>
 <div class="col-4"><input type="date" id="max" name="max" class="form-control" style="width: 400px"></div>
</div>
<div class="row m-4 p-4 justify-content-sm-center text-center">
  <div class="col-2"><button id="btnGo" onclick="show_month()" type="button">Go</button>
    <input type="button" id="btnExport" value="Export" /></div>
 
</div>
      
              </div>

    <div class="m-5">
        <div id="datata" class="container"></div>
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
        function show_month() {
            var month1 = $('#min').val();
            var month2 = $('#max').val();
            $.post("monthly_report_ajax.php", {
                    date1: month1,
                    date2: month2
                },
                function(data, status) {
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
      
    };
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
      

</script> 




</body>
</html
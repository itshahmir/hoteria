<!DOCTYPE html>
<html>
<style>
        @media only screen and (max-width: 650px){
    #saf{
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
    <div class="col text-center mt-5">
        <h1><?php echo date('F'); ?></h1>
        <p class="lead">View</p>




        <select id='gMonth2' onchange="show_month()">
            <option value='<?php echo date('M'); ?>'><?php echo date('F'); ?></option>
            <option value='Jan'>Janaury</option>
            <option value='Feb'>February</option>
            <option value='Mar'>March</option>
            <option value='Apr'>April</option>
            <option value='May'>May</option>
            <option value='Jun'>June</option>
            <option value='Jul'>July</option>
            <option value='Aug'>August</option>
            <option value='Sept'>September</option>
            <option value='Oct'>October</option>
            <option value='Nov'>November</option>
            <option value='Dec'>December</option>
        </select>
        <input type="button" id="btnExport" value="Export" />
    </div>
    <div class="m-5">
        <div class="fdb-block container" id="saf"></div>
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
            var month = $('#gMonth2').val();
            $.post("cavity_view_ajax.php", {
                    month: month
                },
                function(data, status) {
                    $("#saf").html(data);
                    $('#tb1').dataTable({
                        paging: false
                    });
                });


            setTimeout(function() {
                var tds = document.getElementById('tb1').getElementsByTagName('td');

                var sum = 0;
                for (var i = 0; i < tds.length; i++) {
                    if (tds[i].className == 'count-me') {
                        sum += parseInt(tds[i].innerHTML);

                    }
                }
                document.getElementById('total').innerHTML = 'PKR' + sum;
                document.getElementById('total1').innerHTML = 'PKR' + sum;

                var tds = document.getElementById('tb1').getElementsByTagName('td');

                var sum = 0;
                for (var i = 0; i < tds.length; i++) {
                    if (tds[i].className == 'count-me1') {
                        sum += parseInt(tds[i].innerHTML);

                    }
                }
                document.getElementById('total_1').innerHTML = ' ' + sum;
                document.getElementById('total1_1').innerHTML = ' ' + sum;



            }, 200);
        }
    </script>
</body>

</html>
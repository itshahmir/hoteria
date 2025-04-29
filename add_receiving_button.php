<!-- <!DOCTYPE html>
<html>
<?php //include 'head.php'; ?>

<body>
     <?php //include 'head_menu.php'; ?>
<div class="container">
    <h1 class="text-center mt-2" style="color: green;">Total: <span id="total-all">0</span> PKR</h1>
    <div class="row"> 
        
    <div class="col-6">
        <div class="col text-center mt-5">
        <h3 style="
    margin-bottom: -34px;
    margin-right: 94px;
">Rooms</h3>

    </div>
        <div class="fdb-block" style="max-width: 1000px !important;
    margin-left: auto !important;
    margin-right: auto !important;">
            <table id="tableee" class="table table-striped table-bordered">

                <thead>
                    <tr style="background-color: #c5c5c5 !important;">
                        <th>Room(s)</th>
                        <th>UserName</th>
          
                        <th id="total">Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //$database->rec_amount('Room'); ?>
                </tbody>

            </table>

        </div>
    </div>
     <div class="col-6">
        <div class="col text-center mt-5">
        <h3 style="
    margin-bottom: -34px;
    margin-right: 94px;
">Resturant</h3>

    </div>
        <div class="fdb-block" style="max-width: 1000px !important;
    margin-left: auto !important;
    margin-right: auto !important;">
            <table id="tableee1" class="table table-striped table-bordered">

                <thead>
                    <tr style="background-color: #c5c5c5 !important;">
                        <th>Room(s)</th>
                        <th>UserName</th>
                        <th id="total1">Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //$database->rec_amount('Resturant'); ?>
                </tbody>

            </table>

        </div>
    </div></div></div>
    <?php //include 'foot.php'; ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#tableee').DataTable();
    });
    </script>
     <script type="text/javascript">
    $(document).ready(function() {
        $('#tableee1').DataTable();
        total();
    });
    function total() {
                var tds = document.getElementById('tableee').getElementsByTagName('td');
      
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me') {
                    sum += parseInt(tds[i].innerHTML);

                }
            }
            document.getElementById('total').innerHTML = 'PKR ' + sum;



        var tds = document.getElementById('tableee1').getElementsByTagName('td');
      
            var sum1 = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == 'count-me') {
                    sum1 += parseInt(tds[i].innerHTML);

                }
            }
    
            document.getElementById('total1').innerHTML = 'PKR ' + sum1;
            document.getElementById('total-all').innerHTML = (sum1+sum);
        }
    
    </script>
</body>

</html>
</div>
  
 -->

 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <?php include 'head.php'; ?>

      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="author" content="Eagle computers" />
      <meta name="company" content="Microsoft Corporation" />
    <style type="text/css">
      html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style2 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:20pt; background-color:#DAEEF3 }
      th.style2 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:20pt; background-color:#DAEEF3 }
      td.style3 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style3 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style4 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style4 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style5 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:20pt; background-color:#DAEEF3 }
      th.style5 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:20pt; background-color:#DAEEF3 }
      td.style6 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style6 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style7 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      th.style7 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      td.style8 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:18pt; background-color:#DAEEF3 }
      th.style8 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:18pt; background-color:#DAEEF3 }
      td.style9 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      th.style9 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      td.style10 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      th.style10 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      td.style11 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style11 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style12 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      th.style12 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      td.style13 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style13 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style14 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style14 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style15 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      th.style15 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      td.style16 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:#92CDDC }
      th.style16 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:8pt; background-color:#92CDDC }
      td.style17 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style17 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style18 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style18 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style19 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style19 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style20 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style20 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style21 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style21 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style22 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style22 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style23 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style23 { vertical-align:bottom; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style24 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      th.style24 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#DAEEF3 }
      td.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      th.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      td.style26 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      th.style26 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:#FFFFFF }
      table.sheet0 col.col0 { width:107.76666543pt }
      table.sheet0 col.col1 { width:76.58888801pt }
      table.sheet0 col.col2 { width:89.46666564pt }
      table.sheet0 col.col3 { width:43.37777728pt }
      table.sheet0 tr { height:15pt }
      table.sheet0 tr.row2 { height:23.25pt }
      table.sheet0 tr.row15 { height:15.75pt }
    </style>
  </head>

  <body style="background-color: #a3a3a347;">
         <?php include 'head_menu.php'; ?>
<style>
table { margin-left: 0.1in; margin-right: 0in; margin-top: 0.75in; margin-bottom: 0.75in; }
</style>

         <div class="row g-0">
          <?php 
$q = "SELECT * FROM users WHERE userlevel = 1";
$res = $database->query($q);
$users = mysqli_fetch_all($res);


for ($i=0; $i < count($users); $i++) { 


    echo ' 
    <div class="col-3">
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <tbody>
    <tr class="row0">
            <td class="column0 style1 null style4" rowspan="2"></td>
            <td class="column1 style2 s style5" rowspan="2">'.$users[$i][0].'</td>
            <td class="column2 style3 null style6" rowspan="2"><a href="recieve_amount_all.php?user='.$users[$i][0].'" class="btn p-3" style="background-color:crimson;color:white;">Recieve All</a></td>

          </tr>
          <tr class="row1">
          </tr>
          <tr class="row2">
            <td class="column0 style7 s">ROOM</td>
            <td class="column1 style8 s">Amount</td>
            <td class="column2 style8 s"><span id="total'.$users[$i][1].'"></span></td>
          </tr>
          <tr class="row3">
            <td class="column0 style10 null"></td>
            <td class="column1 style11 null"></td>
            <td class="column2 style25 null"></td>
          </tr>';

   $rsio = $database->recAmountCollective($users[$i][0]);

    $new_ary = array();

    for ($i1=0; $i1 < count($rsio); $i1++) { 

        $ide = $database->rm_from_checkin($rsio[$i1][1]);
   if($ide == ""){
            
            $ide = $rsio[$i1][1];
        }


 echo '<tr class="row4">
            <td class="column0 style12 n">';

            $database->groupdata("get_rooms_list", $ide, "", "", "");


            echo '</td>
            <td class="column1 style13 null"></td>
            <td class="column2 style26 null"></td>
          </tr>';
        


        

        $listOfRecievables = $database->recAmountCollectiveExtended($rsio[$i1][1]);

    foreach ($listOfRecievables as $key => $value) {
        

        if($value[2] != $users[$i][0]){
            
        
            \array_splice($listOfRecievables, $key, 1);
        }
    }



        array_push($new_ary, $listOfRecievables);

        for ($keyi=0; $keyi < count($listOfRecievables); $keyi++) { 
            if ($listOfRecievables[$keyi][3] == "Room") {
            $type = "Room bill receiving";
         } else {
            $type = "Restaurant bill receiving";
         }
    
            $date = date('Y-m-d'); 
            echo '<tr class="row5">
            <td class="column0 style14 s">'.$type.'</td>
            <td class="column1 style15 n"><b>'.date("d-m-Y", strtotime($listOfRecievables[$keyi][5])).'</b><br><span id="subtotal'.$users[$i][1].'">'.$listOfRecievables[$keyi][4].'</span></td>

            <td class="column2 style16 s"><a href="rec_amt_ajx.php?id=' . $listOfRecievables[$keyi][0] . '&date=' . $date . '" class="btn" style="background-color:crimson;color:white;">Recieve</a></td>
          </tr>';


        }

    }

    echo ' <tr class="row11">
            <td class="column0 style17 null style19" colspan="3"></td>
          </tr>
        </tbody>
    </table></div>
<script type="text/javascript">
    var sum'.$users[$i][1].'=0;

$("[id^=subtotal'.$users[$i][1].']").each(function(){      
 sum'.$users[$i][1].'=sum'.$users[$i][1].'+(parseInt(this.innerHTML,10));
});

document.getElementById("total'.$users[$i][1].'").innerHTML = sum'.$users[$i][1].';

</script>


    ';
}
           ?>
         
</div>
<div>
   
</div>
<script type="text/javascript">
    var sum=0;

$("[id^=subtotal]").each(function(){      
 sum=sum+(parseInt(this.innerHTML,10));
});

console.log(sum);
</script>
  </body>
</html>

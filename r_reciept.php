<?php @ob_start();
error_reporting(0);
$date_in = $_GET['date_in'];
$date_out = $_GET['date_out'];  ?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <meta name="author" content="topdocuments.com" />
    <meta name="company" content="Microsoft Corporation" />
    <style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
    </style>
    <style type="text/css">
    html {
        font-family: Calibri, Arial, Helvetica, sans-serif;
        font-size: 10pt;
        background-color: white
    }

    a.comment-indicator:hover+div.comment {
        background: #ffd;
        position: absolute;
        display: block;
        border: 1px solid black;
        padding: 0.5em
    }

    a.comment-indicator {
        background: red;
        display: inline-block;
        border: 1px solid black;
        width: 0.5em;
        height: 0.5em
    }

    div.comment {
        display: none
    }

    table {
        border-collapse: collapse;
        page-break-after: always
    }

    .gridlines td {
        border: 1px dotted black
    }

    .gridlines th {
        border: 1px dotted black
    }

    .b {
        text-align: center
    }

    .e {
        text-align: center
    }

    .f {
        text-align: right
    }

    .inlineStr {
        text-align: left
    }

    .n {
        text-align: right
    }

    .s {
        text-align: left
    }

    td.style0 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Calibri';
        font-size: 11pt;
        background-color: white
    }

    th.style0 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Calibri';
        font-size: 11pt;
        background-color: white
    }

    td.style1 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style1 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style2 {
        vertical-align: bottom;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style2 {
        vertical-align: bottom;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style3 {
        vertical-align: middle;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style3 {
        vertical-align: middle;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style4 {
        vertical-align: bottom;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style4 {
        vertical-align: bottom;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style5 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style5 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style6 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style6 {
        vertical-align: bottom;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style7 {
        vertical-align: middle;
        text-align: left;
        padding-left: 0px;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style7 {
        vertical-align: middle;
        text-align: left;
        padding-left: 0px;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style8 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style8 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style9 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style9 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style10 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: none #000000;
        border-right: 1px solid #000000 !important;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style10 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: 1px solid #000000 !important;
        border-top: none #000000;
        border-left: none #000000;
        border-right: 1px solid #000000 !important;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style11 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style11 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style12 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style12 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style13 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style13 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style14 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style14 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: none #000000;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style15 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: 1px solid #000000 !important;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style15 {
        vertical-align: bottom;
        text-align: center;
        border-bottom: none #000000;
        border-top: none #000000;
        border-left: none #000000;
        border-right: 1px solid #000000 !important;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style16 {
        vertical-align: middle;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style16 {
        vertical-align: middle;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: none #000000;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    td.style17 {
        vertical-align: middle;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    th.style17 {
        vertical-align: middle;
        border-bottom: 1px solid #000000 !important;
        border-top: 1px solid #000000 !important;
        border-left: 1px solid #000000 !important;
        border-right: 1px solid #000000 !important;
        font-weight: bold;
        color: #000000;
        font-family: 'Abadi MT Std';
        font-size: 12pt;
        background-color: white
    }

    table.sheet0 col.col0 {
        width: 43.37777728pt
    }

    table.sheet0 col.col1 {
        width: 35.24444404pt
    }

    table.sheet0 col.col2 {
        width: 120.64444306pt
    }

    table.sheet0 col.col3 {
        width: 39.31111066pt
    }

    table.sheet0 col.col4 {
        width: 67.09999923pt
    }

    table.sheet0 col.col5 {
        width: 63.71111038pt
    }

    table.sheet0 col.col6 {
        width: 43.37777728pt
    }

    table.sheet0 tr {
        height: 1pt
    }

    table.sheet0 tr.row1 {
        height: 15pt
    }

    table.sheet0 tr.row2 {
        height: 15pt
    }

    table.sheet0 tr.row3 {
        height: 15pt
    }

    table.sheet0 tr.row5 {
        height: 15pt
    }

    table.sheet0 tr.row7 {
        height: 15pt
    }

    table.sheet0 tr.row8 {
        height: 15pt
    }

    table.sheet0 tr.row9 {
        height: 15pt
    }

    table.sheet0 tr.row10 {
        height: 15pt
    }

    table.sheet0 tr.row11 {
        height: 15pt
    }

    table.sheet0 tr.row12 {
        height: 15pt
    }

    table.sheet0 tr.row13 {
        height: 15pt
    }

    table.sheet0 tr.row14 {
        height: 15pt
    }

    table.sheet0 tr.row15 {
        height: 15pt
    }

    table.sheet0 tr.row16 {
        height: 15pt
    }

    table.sheet0 tr.row17 {
        height: 15pt
    }

    table.sheet0 tr.row18 {
        height: 14.4pt
    }

    table.sheet0 tr.row19 {
        height: 15pt
    }

    table.sheet0 tr.row20 {
        height: 15pt
    }
    </style>
</head>

<body onafterprint="rte()" style="background-color: #a3a3a347;">



    <?php
    include 'include/classes/session.php';
    $random_id = $database->checkin_id_from_rm($_GET['rm']);
    
    $array_rooms = $database->rm_rooms($_GET['rm']);
   
    $array_data = array();
    $room_numbers = array();
    foreach ($array_rooms as $key => $value) {
        $number = $value[3];
        array_push($room_numbers, $number);
    }
 
    $x = "8";
    $f_total = "0";


    foreach ($room_numbers as $numbers => $number) {
        $name = $array_rooms[0][4];


        $e = $database->get_n_orders_room($number, $name, $_GET['date_in'], $_GET['date_out']);
    

       $date_in=$e[0][5];
        if (!empty($e)) {

            echo '

<div id="div_print_' . $numbers . '">
      <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0">
  <col class="col0">
  <col class="col1">
  <col class="col2">
  <col class="col3">
  <col class="col4">
  <col class="col5">
  <col class="col6">
  <tbody>
    <tr class="row0">
      <td class="column0">&nbsp;</td>
      <td class="column1">&nbsp;</td>
      <td class="column2">&nbsp;</td>
      <td class="column3">&nbsp;</td>
      <td class="column4">&nbsp;</td>
      <td class="column5">&nbsp;</td>
      <td class="column6">&nbsp;</td>
    </tr>
    <tr class="row1">
      <td class="column0">&nbsp;</td>
      <td class="column1 style11 s style11" colspan="5">Almas <img src="imgs/thermal.png" height="80px"> Hotel</td>
      <td class="column6">&nbsp;</td>
    </tr>
    <tr class="row2">
      <td class="column0">&nbsp;</td>
      <td class="column1 style11 s style11" colspan="5">&nbsp;Opposite Fizagat Park, Mingora, Swat</td>
      <td class="column6">&nbsp;</td>
    </tr>
    <tr class="row3">
      <td class="column0">&nbsp;</td>
      <td class="column1 style12 s style12" colspan="5">Ph: 03419250161</td>
      <td class="column6">&nbsp;</td>
    </tr>
    <tr class="row4">
      <td class="column0">&nbsp;</td>
      <td class="column1 style12 s style12" colspan="5">Rooms: <span id="rooms">' . $number . '</span></td>
<input type="hidden" id="room_number_' . $numbers . '" value="' . $number . '">
<input type="hidden" id="rooms_id_' . $numbers . '" value="' . $_GET['rm'] . '">

      <td class="column6">&nbsp;</td>
    </tr>
   <tr class="row4">
      <td class="column0">&nbsp;</td>
      <td class="column1 style12 s style12" colspan="5">Name: <span id="rooms">' . $_GET['name'] . '</span></td>
      <td class="column6">&nbsp;</td>
    </tr>
    <tr class="row5">


<style type="text/css">
td {
  width: 6px !important;
}
</style>
      <td class="column0">&nbsp;</td>
      <td class="column1 style2 s">Bill No:</td>
      <td class="column2 style2 null"> <span id="id">' . rand(00000, 11111) . '</span></td>
      <td class="column3 style2 null"></td>
      <td class="column4 style2 s">Date:</td>
      <td class="column5 style2 null"> <span id="date">' . $date_in . '</span></td>
      <td class="column6">&nbsp;</td>
    </tr>
    <tr class="row6">
      <td class="column0">&nbsp;</td>
      <td class="column1">&nbsp;</td>
      <td class="column2">&nbsp;</td>
      <td class="column3">&nbsp;</td>
      <td class="column4">&nbsp;</td>
      <td class="column5">&nbsp;</td>
      <td class="column6">&nbsp;</td>
    </tr>
    <tr class="row7">
      <td class="column0">&nbsp;</td>
      <td class="column1 style3 s">Sr#</td>
      <td class="column2 style3 s">Product</td>
      <td class="column4 style3 s">Price</td>
      <td class="column3 style3 s">Qty</td>
      <td class="column5 style3 s">Amount</td>
      <td class="column6">&nbsp;</td>
    </tr><hr>';

            $total = "0";
            $ind = "0";
            $orders_id = array();
            $extra=0;
            foreach ($e as $ide => $value) {
                $idww = $value[1];
                $extra += $value[7];
                array_push($orders_id, $idww);
            }

            $order_items = array();
            foreach ($orders_id as $key => $value) {
                $var =  $database->get_n_menu($value);
                array_push($order_items, $var);
            }


            $array_orders = array();
            foreach ($order_items as $key => $value) {
                array_push($array_orders, $value);
            }


            for ($i = 0; $i < count($array_orders); $i++) {
                foreach ($array_orders[$i] as $key => $value) {

                    $name = $value[2];

                    $price = $value[3];

                    $qty = $value[4];

                    $amount = $qty * $price;

                    $x++;
                    $ind++;
                    echo '     
        <tr class="row' . $x . '">
            <td class="column0">&nbsp;</td>
            <td class="column1 style4 null">' . $ind . '</td>
            <td class="column2 style4 null">' . $name . '</td>
            <td class="column3 style4 null">' . $price . '</td>
            <td class="column4 style4 null">' . $qty . '</td>
            <td class="column5 style4 null">';
                    echo $amount;
                    $total = $total + $amount;
                    echo '</td>
            <td class="column6">&nbsp;</td>
          </tr>
';
                }

                $f_total = $f_total + $total;
                $new = $total - $extra;
               
            }
            $sdsdsd_old =(0.15) * $new + $new;
            $sdsdsd = $sdsdsd_old+$extra;
            $sdsdsd = round($sdsdsd, 0);
            echo $_GET['rm']."  ".$number;

            $recieved_bill_amt = $database->fetch_recieved_bill($_GET['rm'], $number);
          
            echo '<tr class="row14">
<td class="column0">&nbsp;</td>
<td class="column1 style4 null"></td>
<td class="column2 style4 null"></td>
<td class="column3 style4 null"></td>
<td class="column4 style4 null"></td>
<td class="column5 style4 null"></td>
<td class="column6">&nbsp;</td>
</tr>
<tr class="row15">
<td class="column0">&nbsp;</td>
<td class="column1 style5 null"></td>
<td class="column2 style6 null"></td>
<td class="column3 style6 null"></td>
<td class="column4 style7 s">Total</td>
<td class="column5 style4 null">' . $total . '</td>
<td class="column6">&nbsp;</td>
</tr>
<tr class="row16">
<td class="column0">&nbsp;</td>
<td class="column1 style5 null"></td>
<td class="column2 style6 null"></td>
<td class="column3 style6 null"></td>
<td class="column4 style16 s">Service Charges</td>
<td class="column5 style17 null">' . $new * (0.15) . '</td>
<td class="column6">&nbsp;</td>
</tr>
<tr class="row17">
<td class="column0">&nbsp;</td>
<td class="column1 style5 null"></td>
<td class="column2 style6 null"></td>
<td class="column3 style6 null"></td>
<td class="column4 style7 s">Payment</td>
<td class="column5 style4 null"><span id="total">' . $sdsdsd . '</span></td>
<input type="hidden" id="total_' . $numbers . '" value="' . $sdsdsd . '">
<td class="column6">&nbsp;</td>
</tr>
<tr class="row18">
<td class="column0">&nbsp;</td>
<td class="column1 style5 null"></td>
<td class="column2 style6 null"></td>
<td class="column3 style6 null"></td>
<td class="column4 style7 null">Recieved</td>
<td class="column5 style4 null"><input style="border:none" type="number" min="' . $recieved_bill_amt . '" max="' . $sdsdsd . '" id="recieved_' . $numbers . '" value="' . $recieved_bill_amt . '"><span id="recieved_' . $numbers . '_span"></span></td>
<td class="column6">&nbsp;</td>
</tr>
<tr class="row18">
<td class="column0">&nbsp;</td>
<td class="column1 style5 null"></td>
<td class="column2 style6 null"></td>
<td class="column3 style6 null"></td>
<td class="column4 style7 null">Ledger</td>
<td class="column5 style4 null"><span id="ledger_' . $numbers . '_span">' . ($sdsdsd - $recieved_bill_amt) . ' <button type="button" onclick="fullpay_' . $numbers . '()" class="no-print">Full</button></span></td>
<script>
function fullpay_' . $numbers . '(){
    var total = document.getElementById("total_' . $numbers . '").value;
    document.getElementById("recieved_' . $numbers . '").value = total;
    document.getElementById("ledger_' . $numbers . '_span").innerHTML = 0;
    console.log(total);
}
</script>
<td class="column6">&nbsp;</td>
</tr>
<tr class="row19">
<td class="column0">&nbsp;</td>
<td class="column1 style13 s style15" colspan="5">Note: Prices are inclusive of all Govt. taxes</td>
<td class="column6">&nbsp;</td>
</tr>
<tr class="row20">
<td class="column0">&nbsp;</td>
<td class="column1 style8 s style10" colspan="5">Thank You, Please do come again, POS By Hoteria</td>
<td class="column6">&nbsp;</td>
</tr>

</tbody>
</table>

</div>
    <button class="no-print" onclick="printdiv_' . $numbers . '(';

            echo "'div_print_" . $numbers . "',";
            echo "'" . $sdsdsd . "','" . $random_id . "'";

            echo ')">Print</button>

 

    <button class="no-print" onclick="printss_' . $numbers . '(';

            echo "'div_print_" . $numbers . "'";

            echo ')">Only Print</button>

         <script language="javascript">
         function rec_' . $numbers . '(printpage,total,checkin_id){
            var rooms_id = document.getElementById("rooms_id_' . $numbers . '").value;
            var room_number = document.getElementById("room_number_' . $numbers . '").value;
            var recieved = document.getElementById("recieved_' . $numbers . '").value;
if(recieved == 0){
    document.getElementById("recieved_' . $numbers . '").value = total;
    document.getElementById("ledger_' . $numbers . '_span").innerHTML = "0";
               recieved = total;

            }
            else {
                var led = total - recieved;
                document.getElementById("ledger_' . $numbers . '_span").innerHTML = led;
            }
            $.ajax({
            type : "POST",  //type of method
            url  : "add_rec_bill.php",  //your page
            data : { checkin : checkin_id, amount : total, rooms_id: rooms_id, room_number: room_number, recieved: recieved},// passing the values
            success: function(res){  
                   location.reload();
 
                    }
        });

         }
        function printdiv_' . $numbers . '(printpage,total,checkin_id) {

            var rooms_id = document.getElementById("rooms_id_' . $numbers . '").value;
            var room_number = document.getElementById("room_number_' . $numbers . '").value;
            var recieved = document.getElementById("recieved_' . $numbers . '").value;
         
            if(recieved == 0){
                document.getElementById("recieved_' . $numbers . '").value = total;
                 document.getElementById("ledger_' . $numbers . '_span").innerHTML = "0";
               recieved = total;

            }
 else {
                var led = total - recieved;
                document.getElementById("ledger_' . $numbers . '_span").innerHTML = led;
            }
             $.ajax({
            type : "POST",  //type of method
            url  : "add_rec_bill.php",  //your page
            data : { checkin : checkin_id, amount : total, rooms_id: rooms_id, room_number: room_number, recieved: recieved},// passing the values
            success: function(res){  
                         
                        document.getElementById("recieved_' . $numbers . '").type = "hidden";
                          document.getElementById("recieved_' . $numbers . '_span").innerHTML = recieved;     
                           printss_' . $numbers . '(printpage);     
                    }
        });

         
        }


        function printss_' . $numbers . '(printpage){
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body>";
            var newstr = document.all.item(printpage).innerHTML;

            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();

            document.body.innerHTML = oldstr;
              document.getElementById("recieved_' . $numbers . '_span").innerHTML = ""; 
            document.getElementById("recieved_' . $numbers . '").type = "number";
        
            return false;
       }   
    </script>';
        }
    }


    ?>




    <script type="text/javascript">
    function print_e() {
        var id = document.getElementById("id").innerHTML;
        var rooms = document.getElementById("rooms").innerHTML;
        var total = document.getElementById("total").innerHTML;

        var str = "sr=" + id + "&rooms=" + rooms + "&total=" + total;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "res_rep.php?" + str, true);
        xmlhttp.send();

        print();
    }
    </script>
</body>

</html>
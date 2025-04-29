<!DOCTYPE HTML>

<?php
include 'include/classes/session.php';
$cookie_rooms = substr($_GET['rooms'], 0, 3);
setcookie("room", $cookie_rooms);

$array = $database->get_checkins_details($_GET['id']);

$resturant_rec = $database->report_resturant_unpaid_with_id($_GET['id']);

if (!isset($resturant_rec)) {
    $resturant_rec = 0;
}
$earlier = new DateTime($array[4]);
$later = new DateTime($array[5]);

$abs_diff = $later->diff($earlier)->format("%a");
$abs_diff = $abs_diff + 1;

$room_ary = $database->get_checkedin($_GET['id']);

$rate = $array[7];
$price = $array[9];
$room_d = $array[6];

$date_out = date('Y-m-d', strtotime($array[5] . ' + 1 day'));
$date_out1111 = $array[5];
$percentChange = (1 - $price / $rate) * 100;
$rooms = "";

$name = $array[1];
foreach ($room_ary as $key => $value) {

    $room = $database->get_room_category($value);

    $price = $database->get_room_price($value);
$rest_name = $database->get_room_rest_name($value);

    $selling = $price[3] - ($price[3] * ($percentChange / 100));
    $selling = round($selling);




    $rooms .= '<tr>
        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="32" align="left" valign=bottom><b><font color="#000000">ROOMS</font></b></td>
        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><font color="#000000">' . $room . '</font></td>
        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="3" sdnum="1033;"><font color="#000000">' . $value . '</font></td>
        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2" sdnum="1033;"><font color="#000000">' . $abs_diff . '</font></td>
        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom sdval="3500" sdnum="1033;"><font color="#000000">' . $selling . '</font></td>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom sdval="10500" sdnum="1033;"><font color="#000000">' . $selling . '</font></td>
    </tr>
    ';
}



?>
<?php
$date_in = $array[4];
$order = $database->get_n_orders($_GET['id'], $date_in, $date_out1111);


?>
<?php $x = "8";
$ind = "0";
$total = "0";
$orders_id = array();
$extra=0;
foreach ($order as $key => $value) {
    foreach ($value as $id => $val) {
        $extra += $val[7]; 

        array_push($orders_id, $val[1]);
    }
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

        $total = $total + $amount;
       
    }
}









?>

<html>

<head>

    <title></title>
    <style type="text/css">
    @media print {

        .no-print,
        .no-print * {
            visibility: hidden !important;
        }
    }
    </style>
    <style type="text/css">
    body,
    div,
    table,
    thead,
    tbody,
    tfoot,
    tr,
    th,
    td,
    p {
        font-family: "Calibri";
        font-size: x-small
    }



    a.comment-indicator:hover+comment {
        background: #ffd;
        position: absolute;
        display: block;
        border: 1px solid black;
        padding: 0.5em;
    }

    a.comment-indicator {
        background: red;
        display: inline-block;
        border: 1px solid black;
        width: 0.5em;
        height: 0.5em;
    }

    comment {
        display: none;
    }
    .print-first{
        width: 33.3%; 
    }
     @media print {

    .print-first{
        width: 100%;
    } }
    </style>

</head>

<body onload="onload_r()" onbeforeunload="HandleBackFunctionality()" onafterprint="rte()" onbeforeprint="bte()" style="background-color: #a3a3a347;">


      <script type="text/javascript">
        function rte() {
            window.location = "viewcheckin.php";
        }
         function bte() {
            document.getElementById('second-c').style.display = "none";
            document.getElementById('third-c').style.display = "none";

        }
    </script>

  
    <input type="hidden" value="<?php echo $resturant_rec; ?>" id="res_rec">
    <script type="text/javascript">
    function onload_r() {
        var advance = document.getElementById('adv').innerHTML;
        var total = document.getElementById('total_e').innerHTML;
        var res_rec = document.getElementById('res_rec').value;


        var asdasd = total - advance;
        var asdasd = asdasd - res_rec;

        $e=document.getElementById('ledger').innerHTML = asdasd;

    }
    </script>
    <div style="display:flex;">
        <div class="print-first">
            <table cellspacing="0" border="0">
                <colgroup width="100"></colgroup>
                <colgroup width="150"></colgroup>
                <colgroup width="100"></colgroup>
                <colgroup width="110"></colgroup>
                <colgroup width="80"></colgroup>
                <colgroup width="90"></colgroup>
                <tr>
                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        height="20" align="left" valign=bottom><b>
                            <font color="#000000">INVOICE </font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=bottom
                        bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left"
                        valign=bottom bgcolor="#FFFFFF">
                        <font color="#000000"><br></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" height="47" align="left"
                        valign=bottom><b>
                            <font color="#000000"><br></font>
                        </b></td>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=5 align="center" valign=bottom>
                        <font face="comic" size=5 color="#000000"><b><?php echo $rest_name; ?></b><span style="font-size:12px;">
                                OPP: FIZAGAT PARK SWAT</span></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        height="30" align="left" valign=bottom><b>
                            <font color="#000000">INVOICE NO:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=2 align="center" valign=bottom sdval="1067" sdnum="1033;">
                        <font color="#000000"><?php echo rand(1111, 9999); ?></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom><b>
                            <font size=1 color="#000000">CHECK INN:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=2 align="center" valign=bottom sdval="44508" sdnum="1033;0;M/D/YYYY">
                        <font color="#000000"><?php echo 
                    date('d-m-Y', strtotime($array[4]));
                ?></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        height="30" align="left" valign=bottom><b>
                            <font color="#000000"><br></font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=2 align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom><b>
                            <font size=1 color="#000000">CHECK OUT:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=2 align="center" valign=bottom sdnum="1033;0;M/D/YYYY">
                        <font color="#000000"><?php 
                        echo date('d-m-Y', strtotime($date_out));
                       
                         ?></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        height="30" align="left" valign=bottom><b>
                            <font color="#000000">NAME:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000" colspan=3 align="center" valign=bottom>
                        <font color="#000000"><?php 

$mystring = $array[1];
$findme   = 'jpg';
if($session->contains($mystring, $findme)){
    $name = '<img src="../img/'.$array[1].'" width="170px">';
} else {
    $name = $array[1];
}


echo $name; ?></font>
                    </td>
                    <td style="border-top: 3px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=2 rowspan=4 align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 3px solid #000000; border-bottom: 3px solid #000000; border-left: 3px solid #000000; border-right: 3px solid #000000"
                        height="30" align="left" valign=bottom><b>
                            <font color="#000000">COMPANY:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" colspan=3 align="center"
                        valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        rowspan=2 height="41" align="center" valign=bottom><b>
                            <font color="#000000"><br></font>
                        </b></td>
                    <td style="border-top: 1px solid #000000" colspan=3 rowspan=2 align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        height="30" align="left" valign=bottom><b>
                            <font color="#000000">DETAIL:</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom><b>
                            <font size=1 color="#000000">PARTICULAR</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom><b>
                            <font size=1 color="#000000"> &nbsp;&nbsp;Room Number</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom><b>
                            <font size=1 color="#000000">NIGHTS</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom><b>
                            <font size=1 color="#000000">ROOM PRICE</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom><b>
                            <font size=1 color="#000000">TOTAL AMOUNT</font>
                        </b></td>
                </tr>
                <?php echo $rooms; 


                ?>

                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        height="30" align="left" valign=bottom><b>
                            <font color="#000000"><br></font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center"
                        valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom sdnum="1033;0;_(* #,##0_);_(* \(#,##0\);_(* -??_);_(@_)">
                        <font color="#000000"><?php echo $array[9]; ?><br></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" height="30" align="left"
                        valign=bottom><b>
                            <font color="#000000"><br></font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle>
                        <font color="#000000"><br></font>
                    </td>
                    <td align="left" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom sdval="0"
                        sdnum="1033;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* -??_);_(@_)">
                        <font color="#000000"> - </font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                        height="24" align="left" valign=bottom><b>
                            <font color="#000000">FOOD</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=middle>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center"
                        valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom sdval="3690" sdnum="1033;">
                        <font color="#000000"><?php
                        
                        $new = $total -$extra ;
                        $per = (15 / 100) * $new + $new;
                        $f_per = $per+$extra;
                        echo $f_per;
                         ?> /
                            <?php echo $resturant_rec; ?></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        height="30" align="left" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td colspan=3 align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom sdval="0"
                        sdnum="1033;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* -??_);_(@_)">
                        <font color="#000000"> - </font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=4 height="30" align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="left"
                        valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=4 rowspan=4 height="123" align="left" valign=middle><b>
                            <font color="#000000">MANAGER SIGN
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;s
                                . GUEST SIGN .</font>
                        </b></td>
                    <td align="left" valign=bottom><b>
                            <font size=1 color="#000000">SUB TOTAL</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom sdval="24690" sdnum="1033;">
                        <font color="#000000"><?php echo $array[9]; ?></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom><b>
                            <font color="#000000">S/C 0%</font>
                        </b></td>
                    <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center"
                        valign=bottom>
                        <font color="#000000">0<br></font>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign=bottom><b>
                            <font size=1 color="#000000">TOTAL</font> 
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom>
                        <font color="#000000"><span
                                id="total_e"><?php  echo $f_per + $array[9]; ?></span></font>
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="left" valign=bottom><b>
                            <font size=1 color="#000000">ADVANCE</font>
                        </b></td>
                    <td style="border-left: 1px solid #000000; border-right: 1px solid #000000" align="center"
                        valign=bottom sdval="24690" sdnum="1033;"><b>
                            <font color="#000000"><span id="adv"><?php echo $array[12]; ?></span></font>
                        </b></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=4 height="26" align="center" valign=bottom>
                        <font color="#000000"><br></font>
                    </td>
                    <td align="left" valign=bottom><b>
                            <font size=2 color="#000000">LEDGER</font>
                        </b></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        align="center" valign=bottom><b>
                            <font color="#000000" style="font-size:15px !important;"><span id="ledger"></span><br></font>
                        </b></td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        colspan=6 height="52" align="left" valign=bottom><b>
                            <font color="#000000">CONTACT NO: +92 341 9250161 
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Powered By Hoteria from Quicktech</font>
                        </b></td>
                </tr>
            </table>
              <button onclick="window.location.reload()" class="no-print">Reload</button>
        </div>
        <div style="width: 33.3%;" id="second-c" class="no-print">
            <iframe id="myIFrame"
                src="r_reciept.php?rm=<?php echo $_GET['id1'] ?>&name=<?php echo $_GET['name'] ?>&date_in=<?php echo $_GET['date_in'] ?>&date_out=<?php echo $_GET['date_out'] ?>&id=<?php echo $_GET['id'] ?>&rooms=<?php echo $_GET['rooms'] ?>"
                width="500" height="1000" frameBorder="0">Browser
                not compatible.</iframe>

        </div>
         <button onclick="window.location.reload()" class="no-print">Reload</button>
        <div style="width: 33.3%;" id="third-c" class="no-print">
            <iframe id="myIFrame1"
                src="add_recieving.php?id1=<?php echo $_GET['id1']; ?>&total=<?php echo $_GET['total']; ?>&advance=<?php echo $_GET['advance']; ?>"
                width="500" height="850" frameBorder="0" style="left: 0px !important;"></iframe>
         

        </div>
        <a href="total_recieving.php?id=<?php echo $_GET['id'] ?>&$rm_id=<?php echo $_GET['id1'] ?>&name=<?php echo $_GET['name'] ?>&total=<?php echo $_GET['total'] ?>&date_in=<?php echo $_GET['date_in'] ?>&date_out=<?php echo $_GET['date_out'] ?>&id=<?php echo $_GET['id'] ?>&rooms=<?php echo $_GET['rooms'] ?>"><button class="no-print">Recieve All Bills</button></a>
    </div>
  <script type="text/javascript">       
function hii(){



var remaining = window.frames[1].document.querySelector("#remainingb").value;
window.frames[1].document.querySelector("#received").value = remaining;
window.frames[1].document.querySelector("#clickmetotr").click();
var htmlcollection =  window.frames.myIFrame.contentWindow.document.getElementsByClassName("recieve")
var arr = Array.prototype.slice.call( htmlcollection )

for (var i = arr.length - 1; i >= 0; i--) {
   arr[i].click()
}

window.location.replace('viewcheckin.php');

}


    window.addEventListener("keyup", function(e){ if(e.keyCode == 27) history.back(); }, false);
</script>
    <!-- ************************************************************************** -->
    <!-- ************************************************************************** -->
</body>

</html>
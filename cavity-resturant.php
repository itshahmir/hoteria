<?php include 'include/classes/session.php'; ?>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="author" content="topdocuments.com" />
      <meta name="company" content="Microsoft Corporation" />
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

        <style type="text/css">@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}</style>
    <style type="text/css">
      html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:10pt; background-color:white }
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
      td.style1 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style1 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style2 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style2 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style3 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style3 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style4 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style4 { vertical-align:bottom; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style5 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style5 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style6 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style6 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style7 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style7 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style8 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style8 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style9 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style9 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style10 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style10 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style11 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style11 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style12 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style12 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style13 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style13 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style14 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style14 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style15 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style15 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style16 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style16 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      td.style17 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      th.style17 { vertical-align:middle; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Abadi MT Std'; font-size:12pt; background-color:white }
      table.sheet0 col.col0 { width:43.37777728pt }
      table.sheet0 col.col1 { width:35.24444404pt }
      table.sheet0 col.col2 { width:120.64444306pt }
      table.sheet0 col.col3 { width:39.31111066pt }
      table.sheet0 col.col4 { width:67.09999923pt }
      table.sheet0 col.col5 { width:63.71111038pt }
      table.sheet0 col.col6 { width:43.37777728pt }
      table.sheet0 tr { height:1pt }
      table.sheet0 tr.row1 { height:15pt }
      table.sheet0 tr.row2 { height:15pt }
      table.sheet0 tr.row3 { height:15pt }
      table.sheet0 tr.row5 { height:15pt }
      table.sheet0 tr.row7 { height:15pt }
      table.sheet0 tr.row8 { height:15pt }
      table.sheet0 tr.row9 { height:15pt }
      table.sheet0 tr.row10 { height:15pt }
      table.sheet0 tr.row11 { height:15pt }
      table.sheet0 tr.row12 { height:15pt }
      table.sheet0 tr.row13 { height:15pt }
      table.sheet0 tr.row14 { height:15pt }
      table.sheet0 tr.row15 { height:15pt }
      table.sheet0 tr.row16 { height:15pt }
      table.sheet0 tr.row17 { height:15pt }
      table.sheet0 tr.row18 { height:14.4pt }
      table.sheet0 tr.row19 { height:15pt }
      table.sheet0 tr.row20 { height:15pt }
    </style>
  </head>

  <body onafterprint="rte()"  style="background-color: #a3a3a347;padding:5px;">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

    <script type="text/javascript">
      window.onafterprint = function(){
        window.history.go(-1); 
      }
 

   
</script>
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
            <td class="column1">&nbsp;</td>
            <td class="column2">&nbsp;</td>
            <td class="column3">&nbsp;</td>
            <td class="column4">&nbsp;</td>
            <td class="column5">&nbsp;</td>
            <td class="column6">&nbsp;</td>
          </tr>
          <tr class="row1">
            <td class="column1 style11 s style11" colspan="3"><h3>Almas Hotel</h3></td>
            <td class="column6">&nbsp;</td>
          </tr>
         
          <tr class="row5">



<style type="text/css">
  td {
        width: 6px !important;
  }
</style>
            <td class="column1 style2 s">Bill No:</td>
            <td class="column2 style2 null" id="sr"><?php echo rand(00000,11111); ?></td>
      
            <td class="column4 style2 s" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: <?php echo date('d-m-Y'); ?></td>
            <td class="column5 style2 s" ></td>
            <td class="column6">&nbsp;</td>
          </tr>
          <tr class="row6">

            <td class="column1">&nbsp;</td>
            <td class="column2">&nbsp;</td>
            <td class="column3">&nbsp;</td>
  
            <td class="column5">&nbsp;</td>
            <td class="column6">&nbsp;</td>
          </tr>
         <tr class="row7">
  
            <td class="column1 style3 s">Room#</td>
            <td class="column2 style3 s">Item</td>
            <td class="column3 style3 s">Price</td>
            <td class="column5 style3 s">Date</td>
            
            <td class="column6">&nbsp;</td>
          </tr>
          
         <?php 
$database->groupdata("get_order_cavity", $_GET['order_id'] , "","" ,"");



?>
    
          <tr class="row20">
            <td class="column1 style8 s style10" colspan="4">POS By Hoteria, User : <?php echo $session->username; ?></td>
            <td class="column6">&nbsp;</td>
          </tr>
         
        </tbody>
    </table>
    <button class="no-print"onclick="print()">Print</button>
   
  </body>
</html>

   
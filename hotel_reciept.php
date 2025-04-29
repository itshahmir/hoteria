<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Receipt</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A5 landscape }</style>
  <style type="text/css">@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}</style>
  <!-- Custom styles for this document -->
  <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel='stylesheet' type='text/css'>
  <style>
    body   { font-family: 'Roboto' }
    h1     { font-family: 'Roboto', cursive; font-size: 40pt; line-height: 18mm}
    h2, h3 { font-family: 'Roboto', cursive; font-size: 24pt; line-height: 7mm }
    h4     { font-size: 32pt; line-height: 14mm }
    h2 + p { font-size: 18pt; line-height: 7mm }
    h3 + p { font-size: 14pt; line-height: 7mm }
    li     { font-size: 11pt; line-height: 5mm }

    h1      { margin: 0 }
    h1 + ul { margin: 2mm 0 5mm }
    h2, h3  { margin: 0 3mm 3mm 0; float: left }
    h2 + p,
    h3 + p  { margin: 0 0 3mm 50mm }
    h4      { margin: 2mm 0 0 50mm; border-bottom: 2px solid black }
    h4 + ul { margin: 5mm 0 0 50mm }
    article { border: 4px double black; padding: 5mm 10mm; border-radius: 3mm }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4" onafterprint="rte()" style="background-color: #a3a3a347;">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-20mm">

    <h1><img src="imgs/logo.png" width="50px"></h1>
    <ul>
      <li>OPPOSITE FIZAGAT PARK, MINGORA, SWAT</li>
      <li>TEL: +923068251916</li>
      <li>https://hotel-almas.com/</li>
    </ul>

    <article>
      <h2>Name:</h2>
      <p> <input type="text" value="<?php echo $_GET['name_on_bill'] ?>"></p>

      <h3>Room(s):</h3>
      <p><?php echo $_GET['rooms'] ?></p>

      <h4>PKR. <?php echo $_GET['total'] ?>-</h4>
      <ul>
        <li>Tax: included</li>
        <li>Paid by: cash</li>
        <li>No. <?php echo $_GET['id'] ?></li>
        <li><?php echo $_GET['date'] ?></li>
      </ul>

    </article>
    <button onclick="print()" class="no-print">Print</button>
        <p>Hotel Management by Hoteria &copy;</p>
  </section>
<script type="text/javascript">
	function rte(){
	 window.location.href = "viewcheckin.php";	
	}
</script>

</body>

</html>
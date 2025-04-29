<html lang="en-us">
   <?php include 'head.php'; ?>
   <?php

$array = $database->get_checkins_details($_GET['id']);

$earlier = new DateTime($array[4]);
$later = new DateTime($array[5]);

$abs_diff = $later->diff($earlier)->format("%a");
$abs_diff = $abs_diff + 1;
?>  
   <script src="../Scan.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

   <body onload="setrate()" onkeydown = "if (event.keyCode == 16) document.getElementById('scn').click()" style="background-color: #a3a3a347;">

      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
   <script src="../Scan.js"></script>
      <?php include 'head_menu.php'; ?>
      <section class="fdb-block mt-5">
         <div class="container">
            <div class="row justify-content-center">

               <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                  <form action="process.php" method="POST" id="inputform">
                  <div class="row">
                     <div class="col text-center">
                        <h1>Checkin</h1>
                        <p class="lead">Check In/ Booking</p>
                     </div>
                  </div>
                  <img src="../img/sample.jpg" id="img" style="width: 550px;margin-left: auto;margin-right: auto;display: block;"><br>
                  <button class="btn btn-primary" id="scn" style="margin-left: auto;margin-right: auto;display: block;" type="button" onclick="FastDownload()">SCAN</button>
                  <p id="demo"></p>
                  <div class="row align-items-center">
                     <div class="col mt-4">
                        <input type="text" class="form-control" placeholder="Name" name="name" id="nam" value="<?php echo $array[1]; ?>" />
                     </div>
                  </div>
                  <div class="row align-items-center mt-4">
                     <div class="col">
                        <input type="text" class="form-control" placeholder="CNIC" name="cnic" id="cnc" value="<?php echo $array[2]; ?>"/>
                     </div>
                  </div>
                   <div class="row align-items-center mt-4">
                     <div class="col">
                        <input type="text" class="form-control" placeholder="Number" name="numbere" id="numd" tabindex="1" value="<?php echo $array[11]; ?>"/>
                     </div>
                     <div class="col">
                        <input id="Location"  oninput="trackLocation()"  placeholder="City" name="city"  class="form-control" value="<?php echo $array[3]; ?>">
 <p id="error" style="color:red;display: none;"></p>
    <p id="warn" style="color:yellow;display: none;"></p>
    <p id="Location" style="color:#13d913;display: none;">Residence: </p>
    <p id="Gender" style="color:#23f9d0;display: none;">Gender:</p>
                     </div>
                  </div>
                  <div class="row align-items-center mt-4">
                     <div class="col">
                        <label for="uid">CheckIn Date</label>
                        <input type="date" class="form-control" id="uid" placeholder="Date" name="date" data-date-format="DD MMMM YYYY" value="<?php echo $array[4]; ?>" tabindex="2" />
                     </div>
                     <div class="col">
                        <label for="t_days">Total Days</label>
                        <input type="number" class="form-control" placeholder="Days of Stay" onchange="changevaluesondayschange()" value="<?php echo $abs_diff; ?>" id="t_days" name="t_days" tabindex="3"   <?php if($session->userlevel == 1){?>
                           
                            min="<?php echo $abs_diff; ?>"
                            <?php
                        } ?>/>
                        <input type="hidden" id="t_days_old" value="<?php echo $abs_diff; ?>" 
                      > 
                     </div>
                  </div>
                  <div id="field_wrapper">
                  <div class="row mt-4"  id="texter">
                     


                  </div></div>
                  <div class="row align-items-center mt-4">
        
                    <div class="col">    
                        <label for="t_rate">Sub Total</label>
                        <input type="text" class="form-control" placeholder="Rate" value="<?php echo $array[7]; ?>" id="t_rate" name="rate" tabindex="4" readonly/>
                     </div>

                      <div class="col">
                        <label for="t_price">To Give</label> 
                        <input type="number" class="form-control" placeholder="Total" id="t_price" name="price" tabindex="5"  <?php   if($session->userlevel != 8){ echo "readonly"; }
                            ?>  value="<?php echo $array[9]; ?>" 
                        <?php if($session->userlevel == 1){
                            ?>
                            min="<?php echo $array[9]; ?>"
                            
                            <?php
                        } ?>
                        />
                     </div>
                       <div class="col">
                        <label for="discount">Advance BLOCK</label>
                        <input type="text" class="form-control" placeholder="Advance" id="advance" name="advance" value="<?php echo $array[12]; ?>"  tabindex="6" <?php if($session->userlevel == 1){
                            ?>
                            min="<?php echo $array[12]; ?>"
                            readonly
                            <?php
                        } ?> />
                     </div>
                     <div class="col">
                        <label for="discount">Discount</label>
         <input type="text" class="form-control" placeholder="Discount" id="discount" name="discount" value="<?php echo $array[8]; ?>" tabindex="7" readonly/>
                     </div>
                  </div>
                  <div class="row mt-4">
                  
                     <div class="col">
                        <input type="hidden" name="c_id" value="<?php echo $_GET['id']; ?>">
                        <input type="submit" onclick="show_loader()" value="Checkin" class="btn btn-primary mt-4" name="edit_checkin">
                     </div>

                  </div>

             </form>  </div>
            </div>
         </div>
      </section>
      <script>



var input = document.getElementById("t_rate");

input.addEventListener("keyup", function(event) {if (event.keyCode == 39) {
   event.preventDefault();
   document.getElementById("t_price").focus();
}});

var input2 = document.getElementById("t_price");

input2.addEventListener("keyup", function(event) {if (event.keyCode == 39) {document.getElementById("advance").focus();}});

var input3 = document.getElementById("advance");

input3.addEventListener("keyup", function(event) {if (event.keyCode == 39) {document.getElementById("discount").focus();}});



</script>
     <script type="text/javascript">


var t_days_old = document.getElementById("t_days_old");
var t_days = document.getElementById("t_days");
var t_rate = document.getElementById("t_rate");
var t_price = document.getElementById("t_price");

         var CONFIG = (function() {
     var private = {
         'one_day_rate': parseInt(t_rate.value) / parseInt(t_days.value),
         'one_day_price': parseInt(t_price.value) / parseInt(t_days.value),
     };

     return {
        get: function(name) { return private[name]; }
    };
})();


        function changevaluesondayschange() {
var t_days_old = document.getElementById("t_days_old");
var t_days = document.getElementById("t_days");
var t_rate = document.getElementById("t_rate");
var t_price = document.getElementById("t_price");


CONFIG.get('one_day_rate');  // 1
CONFIG.get('one_day_price');  // 1

t_rate.value = CONFIG.get('one_day_rate')*t_days.value;
t_price.value = CONFIG.get('one_day_price')*t_days.value;
        }
     </script>
      <script type="text/javascript">
 $('#inputform').on('keydown', 'input', function (event) {
  if (event.which == 16) {
    event.preventDefault();
    var $this = $(event.target);
    var index = parseFloat($this.attr('data-index'));
    $('[data-index="' + (index + 1).toString() + '"]').focus();
 } });
         $("#t_days").change(function(){

            var days = document.getElementById("t_days").value;
            var date_in = document.getElementById("uid").value;
            

             $.ajax({ type: "GET", url: "room_ajx_edit.php",data: {date_in : date_in, days: days, id : <?php echo $array[0]; ?>},success : function(data) { $("#texter").html(data);}});


   // var days = document.getElementById("t_days").value;
   //              var rate = document.getElementById("t_rate").value;
   //              var sub = rate * days;
   //              document.getElementById("t_rate").value = sub;
});

          $("#uid").change(function(){

            var days = document.getElementById("t_days").value;
            var date_in = document.getElementById("uid").value;
            

 $.ajax({ type: "GET", url: "room_ajx_edit.php",data: {date_in : date_in, days: days, id : <?php echo $array[0]; ?>},success : function(data) { $("#texter").html(data);}});

   // var days = document.getElementById("t_days").value;
   //              var rate = document.getElementById("t_rate").value;
   //              var sub = rate * days;
   //              document.getElementById("t_rate").value = sub;
});

            $( document ).ready(function() {

            var days = document.getElementById("t_days").value;
            var date_in = document.getElementById("uid").value;
            

 $.ajax({ type: "GET", url: "room_ajx_edit.php",data: {date_in : date_in, days: days, id : <?php echo $array[0]; ?>},success : function(data) { $("#texter").html(data);}});

   // var days = document.getElementById("t_days").value;
   //              var rate = document.getElementById("t_rate").value;
   //              var sub = rate * days;
   //              document.getElementById("t_rate").value = sub;
});
          
         $("#t_price").change(function(){


                var to_give = document.getElementById("t_price").value;
                var stotal = document.getElementById("t_rate").value;
                var sub = stotal - to_give;
                document.getElementById("discount").value = sub;
});
      </script>
      <?php include 'foot.php'; ?>

      <script>
        var checkCookie = function() {

var lastCookie = document.cookie; // 'static' memory between function calls

return function() {

    var currentCookie = document.cookie;

    if (currentCookie != lastCookie) {

        
        ecds = getCookie("image");
       var image = document.getElementById("img");
         image.src = '../img/loading.gif';
         document.getElementById("numd").focus();

        loadDoc(ecds);
       
        lastCookie = currentCookie; // store latest cookie

    }
};
}();
document.getElementById("scn")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 32) {
        document.getElementById("scn").click();
    }
});

window.setInterval(checkCookie, 100); // run every 100 ms

function loadDoc(ss) {
  const xhttp = new XMLHttpRequest();
  const xhttpd = new XMLHttpRequest();
  xhttp.onload = function() {
  
    const obj = JSON.parse(this.responseText);
    name = obj.cnic.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
    document.getElementById("nam").value = obj.Name;
    document.getElementById("cnc").value = name;
    var image = document.getElementById("img");
         image.src = '../img/'+ss;
         setTimeout(function(){
             xhttpd.open("POST", "../delete_ajax.php?img=" + ss);
  xhttpd.send();
}, 1000)

   }
  xhttp.open("POST", "../py_ajx.php?img=" + ss + "&type=eng");
  xhttp.send();
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
    </script>
   </body>
</html>
<?php

if (isset($_GET['name'])) {
   $name = $_GET['name'];
   $cnic = $_GET['cnic'];
   $mobile = $_GET['number'];
} else {
   $name = "";
   $cnic = "";
   $mobile = "";
}

?>
<html lang="en-us">
<?php include 'head.php'; ?>
<script src="../Scan.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<body onload="" onkeydown="if (event.keyCode == 16) document.getElementById('scn').click()" style="background-color: #a3a3a347;">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
   <script type="text/javascript" src="codes.js"></script>
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
                  <div>
                     <img src="../img/sample.jpg" id="img" class="img-fluid" style="margin-left: auto;margin-right: auto;"><br>
                     <!-- <img src="imgs/car.jpg" id="img" class="img-fluid" style="margin-left: auto;margin-right: auto;"><br> -->
                  </div>
                  
                  <div class="row align-items-center" style="margin-left: auto;margin-right: auto;display: block; max-width: 290px;">
                     <button class="btn btn-primary col m-1 hover-zoom toggle-btn_1" id="scn" style="max-width:90px;" type="button" onclick="FastDownload()">SCAN</button>
                     <button class="btn btn-primary col m-1 hover-zoom toggle-btn_1" style="max-width:90px;" id="fhjkgsd" type="button">Breakfast</button>
                     <button class="btn btn-primary col m-1 hover-zoom toggle-btn_1" style="max-width:90px;" id="lang_type" type="button" onclick="change_lang(this)">Eng</button>
                  </div>


                  <script type="text/javascript">
                     function change_lang(lang) {
                        if (lang.innerHTML == "Urdu") {
                           lang.innerHTML = "Eng";
                        } else {
                           lang.innerHTML = "Urdu";
                        }
                     }
                  </script>


                  <p id="demo"></p>
                  <script type="text/javascript">
                     document.getElementById("fhjkgsd").addEventListener('click', function() {
                        var text = document.getElementById('nam');
                        text.value += ' (With Breakfast)';
                     });
                  </script>
                  <div class="row align-items-center">
                     <div class="col mt-4">

                        <input type="text" class="form-control" placeholder="Name" name="name" id="nam" value="<?php echo $name; ?>" />
                     </div>
                  </div>
                  <div class="row align-items-center mt-4">
                     <div class="col">
                        <input type="text" class="form-control" placeholder="CNIC" name="cnic" id="cnc" value="<?php echo $cnic; ?>" oninput="trackLocation()" />
                     </div>
                  </div>
                  <div class="row align-items-center mt-4">
                     <div class="col">
                        <input type="text" class="form-control" placeholder="Number" name="numbere" id="numd" tabindex="1" value="<?php echo $mobile; ?>" />
                     </div>
                     <div class="col">

                        <input id="Location" oninput="trackLocation()" placeholder="City" name="city" class="form-control">
                        <p id="error" style="color:red;display: none;"></p>
                        <p id="warn" style="color:yellow;display: none;"></p>
                        <p id="Location" style="color:#13d913;display: none;">Residence: </p>
                        <p id="Gender" style="color:#23f9d0;display: none;">Gender:</p>


                     </div>
                  </div>
                  <div class="row align-items-center mt-4">
                     <div class="col">
                        <label for="uid">CheckIn Date</label>
                        <input type="date" class="form-control" id="uid" placeholder="Date" name="date" data-date-format="DD MMMM YYYY" value="<?php echo date("Y-m-d") ?>" tabindex="2" />
                     </div>
                     <div class="col">
                        <label for="t_days">Total Days</label>
                        <input type="number" class="form-control" placeholder="Days of Stay" value="1" id="t_days" name="t_days" tabindex="3" />
                     </div>
                  </div>
                  <div id="field_wrapper">
                     <div class="row mt-4" id="texter">
 <div class="d-flex align-items-center">
                  <div class="spinner-border" role="status">
  <span class="sr-only">Loading...</span>
</div>
      </div>


                     </div>
                  </div>
                  <div class="row align-items-center mt-4">

                     <div class="col">
                        <label for="t_rate">Sub Total</label>
                        <input type="text" class="form-control" placeholder="Rate" value="0" id="t_rate" name="rate" tabindex="4" />
                     </div>

                     <div class="col">
                        <label for="t_price">To Give</label>
                        <input type="text" class="form-control" placeholder="Total" id="t_price" name="price" tabindex="5" />
                     </div>
                     <div class="col">
                        <label for="discount">Advance</label>
                        <input type="text" class="form-control" placeholder="Advance" id="advance" name="advance" value="0" onfocus="this.value=''" tabindex="6" />
                     </div>
                     <div class="col">
                        <!--                         <label for="discount">Discount</label> --> <input type="text" class="form-control" placeholder="Discount" id="discount" name="discount" value="0" tabindex="7" style="display: none;" />
                        <input type="submit" onclick="show_loader()" value="Checkin" class="btn btn-primary mt-4 m-1 hover-zoom toggle-btn_1" name="add_checkin">
                     </div>



                  </div>
                  <div class="row mt-4">

                     <div class="col">
                        <br><br><br><br><br>
                     </div>

                  </div>

               </form>
            </div>
         </div>
      </div>
   </section>
   <script type="text/javascript">

   </script>
   <script>
      var input = document.getElementById("t_rate");

      input.addEventListener("keyup", function(event) {
         if (event.keyCode == 39) {
            event.preventDefault();
            document.getElementById("t_price").focus();
         }
      });

      var input2 = document.getElementById("t_price");

      input2.addEventListener("keyup", function(event) {
         if (event.keyCode == 39) {
            document.getElementById("advance").focus();
         }
      });
   </script>
   <script type="text/javascript">
      $(document).ready(function() {
         //change selectboxes to selectize mode to be searchable
         $("#select-state").select2();
      });

      $('#inputform').on('keydown', 'input', function(event) {
         if (event.which == 16) {
            event.preventDefault();
            var $this = $(event.target);
            var index = parseFloat($this.attr('data-index'));
            $('[data-index="' + (index + 1).toString() + '"]').focus();
         }
      });
      $("#t_days").change(function() {

         var days = document.getElementById("t_days").value;
         var date_in = document.getElementById("uid").value;


         $.ajax({
            type: "GET",
            url: "room_ajx.php",
            data: {
               date_in: date_in,
               days: days
            },
            success: function(data) {
               $("#texter").html(data);
            }
         });


         // var days = document.getElementById("t_days").value;
         //              var rate = document.getElementById("t_rate").value;
         //              var sub = rate * days;
         //              document.getElementById("t_rate").value = sub;
      });

      $("#uid").change(function() {

         var days = document.getElementById("t_days").value;
         var date_in = document.getElementById("uid").value;


         $.ajax({
            type: "GET",
            url: "room_ajx.php",
            data: {
               date_in: date_in,
               days: days
            },
            success: function(data) {
               $("#texter").html(data);
            }
         });


         // var days = document.getElementById("t_days").value;
         //              var rate = document.getElementById("t_rate").value;
         //              var sub = rate * days;
         //              document.getElementById("t_rate").value = sub;
      });

      $(document).ready(function() {

         var days = document.getElementById("t_days").value;
         var date_in = document.getElementById("uid").value;


         $.ajax({
            type: "GET",
            url: "room_ajx.php",
            data: {
               date_in: date_in,
               days: days
            },
            success: function(data) {
               $("#texter").html(data);
            }
         });


         // var days = document.getElementById("t_days").value;
         //              var rate = document.getElementById("t_rate").value;
         //              var sub = rate * days;
         //              document.getElementById("t_rate").value = sub;
      });

      $("#t_price").change(function() {


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
            if (event.keyCode === 16) {
               document.getElementById("scn").click();
            }
         });

      window.setInterval(checkCookie, 100); // run every 100 ms

      function loadDoc(ss) {
         var lang_type = document.getElementById("lang_type").innerHTML;
         const xhttp = new XMLHttpRequest();
         const xhttpd = new XMLHttpRequest();
         xhttp.onload = function() {

            const obj = JSON.parse(this.responseText);
            name = obj.cnic;
            name = name.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
            if (lang_type == "Urdu") {
               name = name.substring(1);
            }

            document.getElementById("nam").value = obj.Name;
            document.getElementById("cnc").value = name;
            var image = document.getElementById("img");
            image.src = '../img/' + ss;
            setTimeout(function() {
               xhttpd.open("POST", "../delete_ajax.php?img=" + ss);
               xhttpd.send();
            }, 1000)
            trackLocation();
         }

         xhttp.open("POST", "../py_ajx.php?img=" + ss + "&type=" + lang_type + "");
         xhttp.send();
      }

      function getCookie(cname) {
         let name = cname + "=";
         let decodedCookie = decodeURIComponent(document.cookie);
         let ca = decodedCookie.split(';');
         for (let i = 0; i < ca.length; i++) {
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
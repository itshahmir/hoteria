<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<script src="../Scan.js"></script>

<body onkeydown="if (event.keyCode == 16) document.getElementById('scn').click()" style="background-color: #a3a3a347;">
  <!--  -->
  <?php include 'head_menu.php'; ?>

  <section class="fdb-block mt-5">
    <div class="container" style="max-width: 1330px;">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-6">
          <h1>Reservations</h1>
          <p class="lead">Add Manual Reservation</p>
          <?php if (isset($_GET['index']) && $_GET['index'] == "sucess") { ?>
            <div class="alert alert-success" role="alert">
              Room Reserved <a href="viewreservation.php">View</a>
            </div><br><?php }
                      ?>
          <form action="process.php" method="POST">
            <div class="row align-items-center">
              <div class="col mt-4">
                <input type="text" class="form-control" placeholder="Name" name="name" id="nam">
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-6 mt-4">
                <input type="text" class="form-control" placeholder="Cnic" name="cnic" id="cnc">
              </div>
              <div class="col-6 mt-4">
                <button class="btn btn-primary m-1 hover-zoom toggle-btn_1" id="scn" type="button" onclick="FastDownload()">Scan</button>
              </div>
            </div>
            <div class="row align-items-center mt-4">
              <div class="col">
                <input type="phone" class="form-control" placeholder="Phone" name="number_n" id="numd">
              </div>
              <div class="col">
                <input list="browsers" name="city" class="form-control" placeholder="City">
                <datalist id="browsers">
                  <?php $database->groupdata("get_all_cities", "", "", "", ""); ?>
                </datalist>
              </div>
            </div>
            <div class="row align-items-center mt-4">
              <div class="col">
                <label for="uid">CheckIn Date</label>
                <input type="date" class="form-control" id="uid" placeholder="Date" name="date" data-date-format="DD MMMM YYYY" value="<?php echo date("Y-m-d") ?>" />
              </div>
              <div class="col">
                <label for="t_days">Total Days</label>
                <input type="number" class="form-control" placeholder="Days of Stay" value="1" id="t_days" name="t_days" />
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
                <input type="text" class="form-control" placeholder="Rate" value="0" id="t_rate" name="rate" />
              </div>

              <div class="col">
                <label for="t_price">To Give</label>
                <input type="text" class="form-control" placeholder="Total" id="t_price" name="price" />
              </div>
              <div class="col">
                <label for="discount">Advance</label>
                <input type="text" class="form-control" placeholder="Advance" id="advance" name="advance" value="0" onfocus="this.value=''" />
              </div>
              <div class="col">
                <label for="discount">Discount</label>
                <input type="text" class="form-control" placeholder="Discount" id="discount" name="discount" value="0" />
              </div>
            </div>
            <div class="row justify-content-start mt-4">
              <div class="col">
                <input type="submit" name="add_reservation" onclick="show_loader()" class="btn btn-primary mt-4 m-1 hover-zoom toggle-btn_1" value="Add">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    $("#t_days").change(function() {

      var days = document.getElementById("t_days").value;
      var date_in = document.getElementById("uid").value;


      $.ajax({
        type: "GET",
        async: true,
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
        async: true,
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
        async: true,
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


  <script>
    var checkCookie = function() {

      var lastCookie = document.cookie; // 'static' memory between function calls

      return function() {

        var currentCookie = document.cookie;

        if (currentCookie != lastCookie) {


          ecds = getCookie("image");

          loadDoc(ecds);
          document.getElementById("numd").focus();
          lastCookie = currentCookie; // store latest cookie

        }
      };
    }();
    // document.getElementById("scn")
    //     .addEventListener("keyup", function(event) {
    //     event.preventDefault();
    //     if (event.keyCode === 32) {
    //         document.getElementById("scn").click();
    //     }
    // });

    window.setInterval(checkCookie, 100); // run every 100 ms

    function loadDoc(ss) {
      const xhttp = new XMLHttpRequest();
      const xhttpd = new XMLHttpRequest();
      xhttp.onload = function() {

        const obj = JSON.parse(this.responseText);
        name = obj.cnic.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
        document.getElementById("nam").value = obj.Name;
        document.getElementById("cnc").value = name;

        setTimeout(function() {
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

    var input3 = document.getElementById("advance");

    input3.addEventListener("keyup", function(event) {
      if (event.keyCode == 39) {
        document.getElementById("discount").focus();
      }
    });
  </script>
  <?php include 'foot.php'; ?>
</body>

</html>
<!DOCTYPE html>
<html>
<?php

include 'head.php'; ?>  
<?php

$array = $database->get_reservation_details($_GET['id']);

$earlier = new DateTime($array[6]);
$later = new DateTime($array[7]);

$abs_diff = $later->diff($earlier)->format("%a");
$abs_diff = $abs_diff + 1;
?>  
   <script src="../Scan.js"></script>
<body style="background-color: #a3a3a347;">
<?php include 'head_menu.php'; ?> 

      <section class="fdb-block mt-5">
      <div class="container" style="    max-width: 1330px;">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6">
            <div class="row">
              <div class="col text-center">
                <h1>Reservations</h1>
     
                <p class="lead">Add Manual Reservation</p>
                <?php if(isset($_GET['index']) && $_GET['index'] == "sucess"){?>
                <div class="alert alert-success" role="alert">
  Room Reserved <a href="viewreservation.php">View</a>
</div><br><?php } ?>
              </div>
            </div>
            <form action="process.php" method="POST">
           
                <input type="hidden" class="form-control" placeholder="Name" name="name" id="nam" value="<?php echo $array[1]; ?>">
                <input type="hidden" class="form-control" placeholder="Cnic" name="cnic" id="cnc" value="<?php echo $array[4]; ?>">
                <input type="hidden" class="form-control" placeholder="Phone" name="number_n" value="<?php echo $array[2]; ?>">
             
            
           
                              <div class="row align-items-center mt-4">
                     <div class="col">
                        <label for="uid">CheckIn Date</label>
              <input type="date" class="form-control" id="uid" placeholder="Date" name="date" data-date-format="DD MMMM YYYY" value="<?php echo $array[6]; ?>"  />
                     </div>
                     <div class="col">
                        <label for="t_days">Total Days</label>
                        <input type="number" class="form-control" placeholder="Days of Stay" value="<?php echo $abs_diff; ?>" id="t_days" name="t_days"/>
                     </div>
                  </div>
<div id="field_wrapper">
                  <div class="row mt-4"  id="texter">
                     


                  </div></div>

                                  
                      <!--   <label for="t_rate">Sub Total</label>
                        <input type="text" class="form-control" placeholder="Rate" value="<?php echo $array[8]; ?>" id="t_rate" name="rate"/>
                        <input type="text" class="form-control" placeholder="Discount" id="discount" name="discount" value="<?php echo $array[9]; ?>" />
                        <input type="text" class="form-control" placeholder="Total" id="t_price" name="price" value="<?php echo $array[10]; ?>" />
                        <input type="text" class="form-control" placeholder="Advance" id="advance" name="advance" value="<?php echo $array[11]; ?>" />
                     -->

                       <div class="row align-items-center mt-4">
                           
                     <div class="col">
                        <label for="t_rate">Sub Total</label>
                        <input type="text" class="form-control" placeholder="Rate" value="<?php echo $array[8]; ?>" id="t_rate" name="rate"/>
                     </div>

                      <div class="col">
                        <label for="t_price">To Give</label>
                        <input type="text" class="form-control" placeholder="Total" id="t_price" name="price" value="<?php echo $array[10]; ?>" />
                     </div>
                       <div class="col">
                        <label for="discount">Advance</label>
                        <input type="text" class="form-control" placeholder="Advance" id="advance" name="advance" value="<?php echo $array[11]; ?>" />
                     </div>
                     <div class="col">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" placeholder="Discount" id="discount" name="discount" value="<?php echo $array[9]; ?>" />
                     </div>
                    
                    

                  </div>
                    
            <div class="row justify-content-start mt-4">
              <div class="col">
                <input type="hidden" name="res_id" value="<?php echo $_GET['id']; ?>">
                <input type="submit" onclick="show_loader()" name="edit_reservation" class="btn btn-primary mt-4" value="Add">
                              </div>
            </div> </form>
          </div>
        </div>
      </div>
    </section>
          <script type="text/javascript">
         // function multiply_dates(){
              
         //      var days = document.getElementById('t_days').value;
         //      var sub_total = document.getElementById('t_rate').value;
         //      var sub_total
         // }
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

     
            <script>
        var checkCookie = function() {

var lastCookie = document.cookie; // 'static' memory between function calls

return function() {

    var currentCookie = document.cookie;

    if (currentCookie != lastCookie) {

        
        ecds = getCookie("image");
      
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
<?php include 'foot.php'; ?>    
</body>
</html>

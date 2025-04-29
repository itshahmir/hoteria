<!DOCTYPE html>
<html>
<?php include 'head.php'; 

if(isset($_GET['order_id']))
{
    $order_id = $_GET["order_id"];
}

if(isset($_GET['room_no']))
{
    $room_no = $_GET["room_no"];
}

?>
 <style>
        .quantity {
  position: relative;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button
{
  -webkit-appearance: none;
  margin: 0;
}

input[type=number]
{
  -moz-appearance: textfield;
}

.quantity input {
  width: 45px;
  height: 42px;
  line-height: 1.65;
  float: left;
  display: block;
  padding: 0;
  margin: 0;
  padding-left: 20px;
  border: 1px solid #eee;
}

.quantity input:focus {
  outline: 0;
}

.quantity-nav {
  float: left;
  position: relative;
  height: 42px;
}

.quantity-button {
  position: relative;
  cursor: pointer;
  border-left: 1px solid #eee;
  width: 20px;
  text-align: center;
  color: #333;
  font-size: 13px;
  font-family: "Trebuchet MS", Helvetica, sans-serif !important;
  line-height: 1.7;
  -webkit-transform: translateX(-100%);
  transform: translateX(-100%);
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}

.quantity-button.quantity-up {
  position: absolute;
  height: 50%;
  top: 0;
  border-bottom: 1px solid #eee;
}

.quantity-button.quantity-down {
  position: absolute;
  bottom: -1px;
  height: 50%;
}
    </style>    
<body style="background-color: #a3a3a347;">
<?php include 'head_menu.php'; ?> 
  <section class="fdb-block mt-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6">
            <div class="row">
              <form action="process.php" method="POST" enctype="multipart/form-data" >
              <div class="col text-center">
                <h1>Resturant</h1>
                <p class="lead">Add Manual Order</p>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col mt-4">
                <select class="form-control" name="roomno" id="validationDefault04" required>
                  <option selected disabled value="">Room Number</option>
                  <?php
                    $database->groupdata("get_room_edit", $room_no,'','',"");
                    ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row mt-5">  
          <?php
           $database->groupdata("get_food_categories_edit", $order_id,'','',"");
          ?>
        </div>
      </div>
      <div class="row justify-content-start m-4">
        <div class="col">
          <div class="form-check">

            <input type="hidden" name= "order_id" value="<?php echo $order_id; ?>" >
            <input type="submit" onclick="show_loader()" class="btn btn-warning" name="edit_order" value="Update" id="submit" style="width:200px;">
          </div>
</form>
        </div>
      </div>
    </div>
       
    </section><br><br><br>
    <?php include 'foot.php'; ?> 
<script type="text/javascript">
	
var txts = document.getElementsByTagName('input');
      
            for(var i = 0; i < txts.length; i ++) {
                if(txts[i].value > 0) {
                    txts[i].style.background = "lightgreen";

                }
            }

  jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
                        
</script>
   
</body>
</html>
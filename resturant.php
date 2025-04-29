<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
  <style>
  .quantity {
    position: relative;
  }
  
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  input[type=number] {
    -moz-appearance: textfield;
  }
  
  .quantity input {
    width: 45px;
    height: 30px;
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
    height: 30px;
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
  
  .accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    text-align: center;
    border: none;
    outline: none;
    transition: 0.4s;
    font-size: 22px;
    font-family: 'Literata', serif !important;
  }
  /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
  
  .active,
  .accordion:hover {
    background-color: #ccc;
  }
  /* Style the accordion panel. Note: hidden by default */
  
  .panel {
    padding: 0 18px;
    background-color: white;
    overflow: hidden;
  }
  </style>

  <body style="background-color: #a3a3a347;">
    <?php include 'head_menu.php'; ?>
      <section class="fdb-block mt-5">
        <div class="container">
          <form action="process.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col text-center">
                <h1>Resturant</h1>
                <p class="lead">Add Manual Order</p>
              </div>
            </div>
            <div class="row justify-content-center">
             
                <div class="col-6">
                  <?php
                              $database->groupdata("food_cat_button", '','','',"");
                              ?>
                            
                    <?php
                                 $database->groupdata("get_food_categories_breakfast", '','','',"");
                                 ?>
                                 <?php
                              $database->groupdata("get_food_categories", '','','',"");
                              ?>
                                  <div id="table_custom" style="width: 500px; margin-left:10px; margin-top:20px; display:none;">
                   
                        <div class="row">
                            <div class="col text-center">
                       

                                <input type="hidden" value="<?php echo rand(00000000, 99999999); ?>" name="order_id">


                            </div>
                        </div>
                    
                       
                   
                  </div>
                      
                  </div>
                  <div class="col-6 mt-4">
                    <script>
                    $(document).ready(function() {
                      $('#validationDefault0411').attr("size", 22);
                    });
                    </script>
                    <select class="form-control" name="roomno" id="validationDefault0411" required>
                      <option selected disabled value="">Room Number</option>
                      <?php
                                 $database->orders_option(date('Y-m-d'));
                                 ?>
                    </select>
                  </div>
                </div>
                <div class="row justify-content-start m-4">
                  <div class="col">
                    <div class="form-check">
                      <input type="submit" class="btn btn-warning m-1 hover-zoom toggle-btn_1" onclick="show_loader()" name="add_order" value="Submit" id="submit" style="width:150px;"> </div>
                  </div>
                </div>
          </form>
          </div>
      </section>
      <br>
      <br>
      <br>
<script type="text/javascript">
  function minus_service() {
    // var t_price = document.getElementById("tprice");
    // var total_service_charges = (0.10) * t_price.value;
    // var final = t_price.value - total_service_charges;
    // t_price.value = final;    

  }
</script>
      <?php include 'foot.php'; ?>
      <script>
                function togglebtn_custom(){

               var state = $('#table_custom').css('display');
               var total_tables = 10;
total_tables++;


               if(state === 'block'){
                  $('#table_custom').css('display','none');
               } else {
                   $('#table_custom').css('display','block');


                   for (let i = 0; i < total_tables; i++) {
                  $('#table_'+i).css('display','none');
}

$('#table_custom').css('display','block');

               }
         
    }


    </script>
        <script type="text/javascript">

        var acc = document.getElementsByClassName("accordion");
        var i;
        for(i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            /* Toggle between adding and removing the "active" class,
            to highlight the button that controls the panel */
            this.classList.toggle("active");
            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if(panel.style.display === "contents") {
              panel.style.display = "none";
            } else {
              panel.style.display = "contents";
            }
          });
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
            if(oldValue >= max) {
              var newVal = oldValue;
            } else {
              var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
          });
          btnDown.click(function() {
            var oldValue = parseFloat(input.val());
            if(oldValue <= min) {
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
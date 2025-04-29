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
             
                <div class="col-12">
                 
                             
                                  <div id="table_custom" style="width: 500px; margin-left:10px; margin-top:20px;">
                   
                        <div class="row">
                            <div class="col text-center">
                       

                                <input type="hidden" value="<?php echo $_GET['order_id']; ?>" name="order_id">
                                <input type="hidden" value="<?php echo $_GET['room_no']; ?>" name="room_no">
                                <input type="hidden" value="<?php echo $_GET['total']; ?>" name="total">


                            </div>
                        </div>
                    
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label for="qty">Item</label>
                                <input type="text" class="form-control" placeholder="item" name="name1" />
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label for="qty">Quantity</label>
                                <input type="text" class="form-control" placeholder="Quantity" name="item" id="qty" />
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label for="total">Total</label>
                                <input type="hidden" name="type" value="full" />
                                <input type="text" class="form-control" placeholder="Price" name="price" id="tprice"/>
                            </div>
                        </div>
                   
                  </div>
                      
                  </div>
               
                </div>
                <div class="row justify-content-start m-4">
                  <div class="col">
                    <div class="form-check">
                      <input type="submit" class="btn btn-warning" name="add_order_extra_new" value="Submit_extra" id="submit_extra" style="width:200px;"> </div>
                  </div>
                </div>
          </form>
          </div>
      </section>
      <br>
      <br>
      <br>

      <?php include 'foot.php'; ?>
    
  </body>

</html>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>    
<body style="background-color: #a3a3a347;">
<?php include 'head_menu.php'; ?> 

      <section class="fdb-block mt-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-8 col-xl-6">
            <div class="row">
              <div class="col text-center">
                <h1>Reservations</h1>
                <p class="lead">Checkin Reservation</p>
                <?php if(isset($_GET['index']) && $_GET['index'] == "sucess"){?>
                <div class="alert alert-success" role="alert">
  Room Reserved <a href="viewreservation.php">View</a>
</div><br><?php } ?>
              </div>
            </div>
            <form action="process.php" method="POST">
            <div class="row align-items-center">
              <div class="col mt-4">
                <input type="text" class="form-control" placeholder="Name" name="name" value="<?php $_GET['name'] ?>">
              </div>
            </div>
            <div class="row align-items-center mt-4">
              <div class="col">
                <input type="phone" class="form-control" placeholder="CNIC" name="cnic">
              </div>
            </div>
            <div class="row align-items-center mt-4">
              <div class="col">
                
                <select class="form-control" name="room_category">
                
                              <option value="<?php $_GET['type'] ?>"><?php $_GET['type'] ?></option>
                    
                           </select>            
              </div>
              <div class="col" >
              
                 <select class="form-control" name="room_number">
                              <option value="<?php $_GET['room'] ?>" id="loading"><?php $_GET['room'] ?></option>
                           </select>
              </div>
            </div>
                 <div class="row align-items-center mt-4">
              <div class="col">
                <input type="date" class="form-control" placeholder="Date" name="date">
              </div>
            </div>
      
            <div class="row justify-content-start mt-4">
              <div class="col">
                <div class="form-check">
                  <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="confirm">
                      Confirm Booking
                    </label>
                </div>
    
                <input type="submit" name="add_reservation" class="btn btn-primary mt-4" value="Add">
                              </div>
            </div> </form>
          </div>
        </div>
      </div>
    </section>
<script>
           function call(value) {
             var x = value.value;
             
    
             removeOptions(document.getElementById('car_models'));
                 //Make an Ajax request to a PHP script called car-models.php
         //This will return the data that we can add to our Select element.
         $.ajax({
             url: 'select_data.php',
             type: 'get',
             data: {name : x},
             success: function(data){
         
                 //Log the data to the console so that
                 //you can get a better view of what the script is returning.
                 console.log(data);
                     
                  
                                        $.each(data, function(key, modelName){
                     //Use the Option() constructor to create a new HTMLOptionElement.
                     var option = new Option(modelName, modelName);
                     //Convert the HTMLOptionElement into a JQuery object that can be used with the append method.
                     $(option).html(modelName);
                     //Append the option to our Select element.
                     $("#car_models").append(option);
                    
         
         
                    
         
         
         
         
                 });
         
         
                 //Change the text of the default "loading" option.
                 
         
             }
         });
         
         }

              function removeOptions(selectElement) {
         var i, L = selectElement.options.length - 1;
         for(i = L; i >= 0; i--) {
         selectElement.remove(i);
         }
         }
</script>
<?php include 'foot.php'; ?>    
</body>
</html>

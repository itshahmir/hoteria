
<html lang="en-us">
   <?php include 'head.php'; ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

   <body onload="" onkeydown = "if (event.keyCode == 16) document.getElementById('scn').click()" style="background-color: #a3a3a347;">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
                        <h1>Inventory</h1>
                      
                     </div>
                  </div>
                                <div class="row align-items-center mt-4">
                     <div class="col">
                        <select class="form-control" name="item"/>
                        <option selected=""><?php echo $_GET['item']; ?></option>
                        <option>Blankets Single</option>
                        <option>Blankets Double</option>
                        <option>Towels Small</option>
                        <option>Towels Large</option>
                        <option>Pillow covers</option>
                        <option>Cups</option>
                        <option>Kettel</option>
                        <option>Chairs</option>
                        <option>Glasses</option>
                        <option>Plates</option>
                        <option>Beds double</option>
                        <option>Beds single</option>

                     </div>
                  </div>
                  <div class="row align-items-center mt-4">
                     <div class="col mt-4">
                        <input type="text" class="form-control" placeholder="Quantity" name="qty" id="qty" value="<?php echo $_GET['qty']; ?>"/>
                     </div>
                  </div>

                   <div class="row align-items-center mt-4">
                     <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                     <div class="col">
                        <input type="submit" value="Edit Items" onclick="show_loader()" class="btn btn-primary" name="edit_in">
                     </div>
                  </div>
                    

             
              
                  



             </form>  </div>
            </div>
         </div>
      </section>
     <script type="text/javascript">
        
     </script>
      <?php include 'foot.php'; ?>
   </body>
</html>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>    
<style>
body{
  background-color: #a3a3a347;
 }

</style>
   <script src="../Scan.js"></script>
<body onkeydown = "if (event.keyCode == 16) document.getElementById('scn').click()">
  <!--  -->
<?php include 'head_menu.php'; ?> 

    <section class="fdb-block mt-5">
        <div class="container" style="    max-width: 1330px;">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                    <div class="row">
                        <div class="col text-center">
                            <h1>Employees</h1>
                            <p class="lead">Add New Employees</p>
                            <?php if(isset($_GET['index']) && $_GET['index'] == "sucess"){?>
                             <div class="alert alert-success" role="alert">
                                Employees Added <a href="view_employees.php">View</a>
                            </div><br><?php } ?>
                        </div>
                    </div>
                    <form action="process.php" method="POST"    enctype="multipart/form-data">
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="nam">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 mt-4">
                            <input type="text" class="form-control" placeholder="Cnic" name="cnic" id="cnc">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="phone" class="form-control" placeholder="Phone" name="number_n" id="numd">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Base Salary" name="base_salary" id="salary">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <label for="h_date">Hiring Date:</label>
                            <input type="date" class="form-control" name="hiring_date" id="h_date">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                        <label for="p_date">Pay Date:</label>
                            <input type="date" class="form-control" name="pay_date" id="p_date">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <label for="e_pic">Employee Picture:</label>
                            <input type="file" class="form-control" name="emp_pic" id="e_pic" accept="image/*">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                        <label for="agreemen">Agreement:</label>
                            <input type="file" class="form-control" name="agreement" id="agreemen" accept = "application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4 ml-4">
                        <input type="submit" name="add_employees" class="btn btn-primary m-1 hover-zoom toggle-btn_1" value="Add">
                    </div>
                </div>
                
                    </form>
            </div>
        </div>
</section>
          
<?php include 'foot.php'; ?>    
</body>
</html>

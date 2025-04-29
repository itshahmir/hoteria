<html lang="en-us">
<?php include 'head.php';

 ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<body onload="changeremainingb()" style="background-color: #a3a3a347;">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script src="../Scan.js"></script>

    <section class="fdb-block">
        <div class="container-fluid" id="form-if-0">
            <div class="row justify-content-center">

                <div class="col-12"
                    style="border:1px solid transparent; border-radius:10px;padding: 25px; background-color: #00336a2e;box-shadow: #d3d3d3a3 -1px 7px 15px 7px;">
                    <form action="process.php" method="POST" id="inputform">
                        <div class="row">
                            <div class="col text-center">
                                <h1>Room Amount</h1>

                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label>Total</label>
                                <input type="text" class="form-control" placeholder="Total" name="total" readonly=""
                                    id="total" value="<?php echo $_GET['total']; ?>" />
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label>Advance</label>
                                <input type="text" class="form-control" placeholder="Advance" name="advance" readonly=""
                                    id="advance" value="<?php echo $_GET['advance']; ?>" />
                            </div>
                        </div>

                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label>Remaining</label>
                                <input type="text" class="form-control" placeholder="remainingb" name="remainingb"
                                    id="remainingb" readonly="" />
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label>Receiving</label>
                                <?php if ($session->username == 8) {
                                ?>
                                <input type="number" class="form-control" placeholder="Receiving" name="received"
                                    id="received" onchange="onchangeval()" />

                                <?php
                                } else { ?>
                                <input type="number" class="form-control" placeholder="Receiving" min="0"
                                    max="100000000000" name="received" id="received" onchange="onchangeval()" />
                                <?php } ?>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label>Remaining after Receiving</label>
                                <input type="text" class="form-control" placeholder="Remaining after Receiving"
                                    id="remaininga" readonly="" />
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <input type="hidden" name="rom_id" value="<?php echo $_GET['id1']; ?>">
                            <div class="col">
                                <input type="submit" onclick="show_loader()" value="Add Amount" class="btn btn-primary m-1 hover-zoom toggle-btn_1"
                                    name="add_receiving">
                            </div>
                        </div>






                        <script>

                            

                        function onchangeval() {
                            var total = document.getElementById("total").value;
                            var advance = document.getElementById("advance").value;

                            var to_give = total - advance;


                            var received = document.getElementById("received").value;

                            var after = to_give - received;


                            document.getElementById("remaininga").value = after;
                        }


                        function changeremainingb() {



                            var total = document.getElementById("total").value;
                            var advance = document.getElementById("advance").value;

                            var to_give = total - advance;

                            document.getElementById("remainingb").value = to_give;

                            if (to_give > 0) {
                                
                               document.getElementById("remainingb").style.color = "red";
                            }

                        }
                        </script>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">

    </script>
</body>

</html>
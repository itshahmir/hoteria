<html lang="en-us">
<?php include 'head.php'; ?>
<style>
    body{
  background-color: #a3a3a347;
 }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<body onload="" onkeydown="if (event.keyCode == 16) document.getElementById('scn').click()">
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
                                <h1>Add Extra Item</h1>

                                <input type="hidden" value="<?php echo rand(00000000, 99999999); ?>" name="order_id">


                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label for="qty">Room Number</label>

                                <select class="form-control" name="roomno">
                                    <?php $array_rooms = $database->rm_rooms($_GET['rm']);
                                    foreach ($array_rooms as $key => $value) {
                                        $number = $value[3];
                                        echo '<option>' . $number . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label for="qty">Item</label>
                                <input type="text" class="form-control" placeholder="item" name="item" />
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label for="qty">Quantity</label>
                                <input type="text" class="form-control" placeholder="Quantity" name="qty" id="qty" />
                            </div>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col mt-4">
                                <label for="qty">Total</label>
                                <input type="text" class="form-control" placeholder="Total" name="total" />
                            </div>
                        </div>

                        <div class="row align-items-center mt-4">

                            <div class="col">
                                <input type="submit"  onclick="show_loader()" value="Add Items" class="btn btn-primary m-1 hover-zoom toggle-btn_1" name="add_order_extra">
                            </div>
                        </div>








                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">

    </script>
    <?php include 'foot.php'; ?>
</body>

</html>
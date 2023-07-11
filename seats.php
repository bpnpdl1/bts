<?php

require_once "./db.php";
auth();
require_once "./controllers/./seatscontroller.php";
$title = "Seats";
require_once "./components/header.php";

require_once "./components/nav.php";

?>


<div id="seatsdialog" class="p-6 m-6" style="margin: 20px;">
    <div class="container" style="margin: 90px;">


        <?php
        get_error();

        ?>
        <form action="./checkout.php" method="post">



            <legend>Book Seats</legend>
            <small>Bus Number</small>
            <hr>

            <div class="row">
                <div class="col">
                    <div class="row">
                        <?php

                        $totalseats = where('seat', 'bus_id', '=', $_POST['bus_id']);

                        // dd($trips);

                        $reserved = query("SELECT * from seat where  is_reserved='reserved' and bus_id=" . $_POST['bus_id'] . " and trip_id=" . $trips[0]['id']);




                        for ($i = 1; $i <= $maxseat; $i++) {

                            $reserved_seat = query("SELECT * from seat where is_reserved='reserved' and seat_number=" . $i . " and bus_id=" . $_POST['bus_id'] . " and trip_id=" . $trips[0]['id']);



                            if (isset($reserved_seat[0])) {


                        ?>

                                <div class="col-sm-3  text-danger ">
                                    <label for="" class="form-label    "><?php echo 'S-' . $i  ?></label>
                                    <input type="checkbox" disabled name="seats[<?php echo $i ?>]" class="form-check-input bg-danger">

                                </div>
                            <?php
                            } else {
                            ?>

                                <div class="col-sm-3">
                                    <label for="" class="form-label   "><?php echo 'S-' . $i  ?></label>
                                    <input type="checkbox" name="seats[<?php echo $i ?>]" class="form-check-input">

                                </div>

                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-4">


                    <div>
                        <p> Available Seats: <?php echo $maxseat - count($reserved); ?></p>
                        <p>Reserved Seats: <?php echo count($reserved) ?></p>
                        <p>Total Seats: <?php echo $maxseat ?></p>
                    </div>
                </div>
            </div>

            <div class="mb-2">

                <?php
                if ($maxseat != count($reserved)) {
                ?>
                    <button type="submit" class="btn btn-secondary">Book Seat</button>

                <?php
                } else {
                ?>

                    <p class="h5  p-2 text-danger bg-light">All Seat are booked</p>
                <?php
                }
                ?>
            </div>

        </form>

    </div>
</div>




<?php
require_once "./components/footer.php";
?>
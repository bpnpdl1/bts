<?php

require_once "./db.php";
auth();
require_once "./controllers/./seatscontroller.php";
$title = "Seats";
require_once "./components/header.php";

require_once "./components/nav.php";

?>


<div id="seatsdialog" class="p-3 m-3">
    <div class="container">

        <?php get_error(); ?>

        <form action="./checkout.php" method="post">
            <legend class="h4">Book Seats</legend>
            <hr>

            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        <?php
                        $totalseats = query("SELECT * FROM seat  where bus_id=" . request('bus_id') . " and trip_id=" . request('trip_id') . "");
                        $reserved = query("SELECT * from seat where  is_reserved='reserved' and bus_id=" . $_POST['bus_id'] . " and trip_id=" . request('trip_id') . "");


                        for ($i = 1; $i <= $maxseat; $i++) {
                            $reserved_seat = query("SELECT * from seat where is_reserved='reserved' and seat_number=" . $i . " and bus_id=" . $_POST['bus_id'] . " and trip_id=" . request('trip_id') . "");
                            // print_r($reserved_seat);
                            ?>

                            <div class="col-6 col-sm-3 mt-3 <?php if (isset($reserved_seat[0])) echo "bg-danger"; ?>">
                                <label for="seat_<?php echo $i ?>" class="form-label"><?php echo 'S-' . $i  ?></label>
                                <input class="bg-danger" type="checkbox" id="seat_<?php echo $i ?>" name="seats[<?php echo $i ?>]" class="form-check-input" <?php if (isset($reserved_seat[0])) echo "disabled"; ?>>
                            </div>

                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="mt-4">
                        <p class="mb-1">Available Seats: <?php echo $maxseat - count($reserved); ?></p>
                        <p class="mb-1">Reserved Seats: <?php echo count($reserved) ?></p>
                        <p class="mb-1">Total Seats: <?php echo $maxseat ?></p>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <?php if ($maxseat != count($reserved)) { ?>
                    <button type="submit" class="btn btn-primary">Book Seat</button>
                <?php } else { ?>
                    <p class="h5 mt-2 text-danger bg-light p-2">All Seats are booked</p>
                <?php } ?>
            </div>
        </form>
    </div>
</div>





<?php
require_once "./components/footer.php";
?>
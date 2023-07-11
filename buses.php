<?php

require_once "./db.php";
auth();
$title = "Buses";

require_once "./controllers/./tripcontroller.php";
require_once "./components/header.php";

require_once "./components/nav.php";


?>

<div class="mx-5 my-2  ">


    <div>
        <p class="h2">Available Buses</p>
        <p class="h6">Route : <?php echo $source_place . " - " . $destination_place ?></p>
        <?php if (isset($route)) { ?>
            <p class="h6">Fare : Rs. <?php echo $route['fare'] ?></p>

        <?php } ?>
        <p class="text-small">Date: <?php echo $_POST['date'] ?></p>
    </div>



    <div class="my-1 container">


        <div class="row " style="min-height: 400px;">


            <?php
            if (isset($buses)) {
                foreach ($buses as $bus) {

            ?>

                    <div class="card m-3" style="width: 18rem;">
                        <img src="<?php echo $bus['image'] ?>" class="card-img-center center" alt="..." style="width:17rem;height: 10rem; object-fit:  cover;">
                        <div class="card-body">
                            <h5 class="card-title">Bus Type: <?php echo $bus['type'] ?></h5>
                            <small class="card-text">Bus Number: <?php echo $bus['number_plate'] ?></small>
                            <br>
                            <small class="card-text">Total Seats: <?php echo $bus['seats'] ?></small>
                            <form action="./seats.php" method="post">
                                <input type="hidden" name="bus_id" value="<?php echo $bus['id'] ?>">
                                <input type="hidden" name="route_id" value="<?php echo $route_id ?>">
                                <input type="hidden" name="date" value="<?php echo $_POST['date'] ?>">

                                <button type="submit" class="btn btn-primary my-1 " style="width: 100%;">Book Seats</button>

                            </form>

                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='h3 text-center'>No Buses Available</p>";
            }
            ?>
        </div>


    </div>
</div>

<script>
    const seatdialog = document.getElementById("seatsdialog");



    function seats(busid) {
        seatdialog.showModal();




    }
</script>


<?php
require_once "./components/footer.php";
?>
<?php

require_once "./db.php";
auth();
$title = "Checkout Details";

require_once "./controllers/./tickets.php";
require_once "./components/header.php";

require_once "./components/nav.php";

?>


<div class="container">
    <div class="m-3">
        <p class="h2">Checkout Details</p>
    </div>

    <div class="m-3 d-flex justify-content-center">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Bus Number: <?php echo $bus['number_plate'] ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Route: <?php echo $source_place['place'] . " - " . $destination_place['place'] ?></h6>
                <p class="card-text">Date: <?php echo $trips['date'] ?></p>
                <p class="card-text">Time: <?php echo date('H:i', strtotime($trips['time'])); ?></p>
                <p class="card-text">Total Seats: <?php echo count($_POST['seats']) ?></p>
                <p class="card-text">Price: Rs. <?php echo $route['fare'] ?></p>
                <p class="card-text">Total Price: Rs. <?php echo $route['fare'] * count($_POST['seats']) ?></p>
                <div class="mt-3">
                    <button class="btn btn-primary" onclick="bookbus()" style="width: 100%;">Book</button>
                </div>
               
            </div>
        </div>
    </div>

    <script>
        function bookbus() {
            if (confirm("Are you sure you want to book this bus?")) {
                window.location.href = "./controllers/bookbus.php?seat_number=<?php echo count($_POST['seats']) ?>";
            }
        }
    </script>
</div>



<?php
require_once "./components/footer.php";
?>
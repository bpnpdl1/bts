<?php require_once "./db.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Bus Ticketing System</title>
</head>

<body>
    <?php require_once "./components/nav.php"; ?>

    <?php get_success(); ?>

    <div class="d-flex">

        <div style="width: 60%;">
            <img src="./images/./cover.jpg" alt="" style="width: 100%; height: 500px;object-fit: contain;">
        </div>
        <div class="bg-light" style="width: 30%;">
            <form action="./buses.php" method="post" class="d-flex flex-column py-5 px-4 justify-items-center align-content-center">
                <legend class="mb-3 text-center">Search the Buses</legend>


                <?php
                $places = all("places");
                get_error();
                ?>
                <div class="mb-3">
                    <label for="source">Select Source Place</label>
                    <select class="form-select" name="source_id" aria-label="Select Source">
                        <option>Select the Source</option>
                        <?php foreach ($places as $place) { ?>
                            <option value="<?php echo $place['id']  ?>"><?php echo $place['place']   ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="destination">Select Destination Place</label>
                    <select class="form-select" name="destination_id" aria-label="Select Source">

                        <option>Select the Destination</option>
                        <?php foreach ($places as $place) { ?>
                            <option value="<?php echo $place['id']  ?>"><?php echo $place['place']   ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="source">Select Source Place</label>
                    <input type="date" name="date" class="form-control" id="date" min="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary w-100">Search Buses</button>
                </div>

            </form>
        </div>

    </div>
    <hr>

    <div class="container">
        <p class="h3 text-center my-2">Our Buses</p>

        <div class="d-flex flex-wrap justify-content-center">
            <?php
            $buses = query("SELECT * FROM buses LIMIT 3");
            if (count($buses) > 0) {

                foreach ($buses as $bus) {
            ?>

                    <div class="card m-3" style="width: 18rem;">
                        <img src="<?php echo $bus['image'] ?>" class="card-img-center center" alt="..." style="width:17rem;height: 10rem; object-fit:  cover;">
                        <div class="card-body">
                            <h5 class="card-title">Bus Type: <?php echo $bus['type'] ?></h5>
                            <small class="card-text">Bus Number: <?php echo $bus['number_plate'] ?></small>
                            <br>
                            <small class="card-text">Total Seats: <?php echo $bus['seats'] ?></small>

                        </div>

                    </div>
            <?php }
            }
            ?>
        </div>


    </div>

    <hr class="my-2">


    <div class="container">




        <div class="d-flex justify-content-center">
            <div class="m-2 card p-2">
                <p class="h4">Our Bus Stations </p>

                <ul class="list-group">
                    <?php
                    $places = all("places");

                    foreach ($places as $place) {
                    ?>
                        <li class="list-group-item"><?php echo $place['place']; ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="m-2 card p-2">
                <p class="h4">Our Latest Trips </p>

                <ul class="list-group p-2">
                    <?php
                    $trips = query("SELECT * FROM trips where date>=date('Y-m-d') GROUP BY route_id");

                    foreach ($trips as $trip) {
                    ?>
                        <li class="list-group-item"><?php

                                                    $route = find("routes", $trip['route_id']);
                                                    $source = find("places", $route['source_place_id']);
                                                    $destination = find("places", $route['destination_place_id']);

                                                    echo $source['place'] . " to " . $destination['place'];
                                                    echo " on " . $trip['date'];

                                                    ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>







    <?php require_once "./components/footer.php"; ?>
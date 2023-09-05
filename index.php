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

    <div class="row">
    <div class="col-md-8">
        <img src="./images/cover.jpg" alt="" class="img-fluid">
    </div>
    <div class="col-md-4 bg-light">
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
                        <option value="<?php echo $place['id'] ?>"><?php echo $place['place'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="destination">Select Destination Place</label>
                <select class="form-select" name="destination_id" aria-label="Select Source">
                    <option>Select the Destination</option>
                    <?php foreach ($places as $place) { ?>
                        <option value="<?php echo $place['id'] ?>"><?php echo $place['place'] ?></option>
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
    <div class="row justify-content-center">
        <?php
        $buses = query("SELECT * FROM buses LIMIT 3");
        if (count($buses) > 0) {
            foreach ($buses as $bus) {
        ?>
                <div class="col-md-4 mb-3">
                    <div class="card" style="width: 100%;">
                        <img src="<?php echo $bus['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Bus Type: <?php echo $bus['type'] ?></h5>
                            <p class="card-text">Bus Number: <?php echo $bus['number_plate'] ?></p>
                            <p class="card-text">Total Seats: <?php echo $bus['seats'] ?></p>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<hr class="my-2">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Our Bus Stations</h4>
                    <ul class="list-group">
                        <?php
                        $places = all("places");
                        foreach ($places as $place) {
                        ?>
                            <li class="list-group-item"><?php echo $place['place']; ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Our Latest Trips</h4>
                    <ul class="list-group">
                        <?php
                        $trips = query("SELECT * FROM trips where date >= CURDATE() ");
                        foreach ($trips as $trip) {
                            $route = find("routes", $trip['route_id']);
                            $source = find("places", $route['source_place_id']);
                            $destination = find("places", $route['destination_place_id']);
                        ?>
                            <li class="list-group-item">
                                <?php
                                echo $source['place'] . " to " . $destination['place'];
                                echo " on " . $trip['date'] . " at " . date('H:i', strtotime($trip['time'])) ;
                                ?>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>









    <?php require_once "./components/footer.php"; ?>
<?php


// $routes = where('routes', 'source_place_id', '=', '1');

if (empty($_POST['source_id']) || empty($_POST['destination_id']) || empty($_POST['date'])) {

    $_SESSION['error'] = "Please fill all the fields";
    redirect($root);
}

if ($_POST['source_id'] == $_POST['destination_id']) {
    $_SESSION['error'] = "Source and Destination cannot be same";
    redirect($root);
}

$date = strval($_POST['date']);

$source_place = find('places', $_POST['source_id'])['place'];


$destination_place = find('places', $_POST['destination_id'])['place'];


$routes = query("SELECT*FROM routes where source_place_id=" . $_POST['source_id'] . " and destination_place_id=" . $_POST['destination_id']);

if (count($routes) > 0) {



    $trips = query("SELECT * FROM trips where route_id=" . $routes[0]['id'] . " and date='$date'");

    if (count($trips) == 0) {
        $_SESSION['error'] = "No buses available in this route";
        redirect($root);
    }


    $route_id = $routes[0]['id'];





    $buses_id = [];
    $i = 1;
    foreach ($trips as $tripdata) {
        # code...

        $buses_id[$i] = $tripdata['bus_id'];
        $i++;
    }

    foreach ($routes as $route) {
        # code...
        $route = $route;
    }

    if (count($routes) == 0) {
        die("No buses available");
    }




    $buses = whereIn('buses', $buses_id);
}

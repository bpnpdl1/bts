<?php




if (count($_POST) == 0) {
    die("No seats selected");
}

$seats = array_keys($_POST['seats']);





// die;



$trips = $_SESSION['trips'];



$route = find('routes', $trips['route_id']);
$bus = find('buses', $trips['bus_id']);

$source_place = find('places', $route['source_place_id']);
$destination_place = find('places', $route['destination_place_id']);






$seat = [
    'bus_id' => $trips['bus_id'],
    'trip_id' => $trips['id'],
    'seat_number' => $seats[0],
    'is_reserved' => 'reserved'
];

$_SESSION['seats'] = $seats;

// create('seat', $seat);

// dd($seat);

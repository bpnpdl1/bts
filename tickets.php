<?php

require_once "./db.php";
auth();
$title = "Buses";

$userid = $_SESSION['user_id'];

$tickets = where('tickets', 'ticket_number', '=', request('ticket'));


if (count($tickets) == 0) {
    $_SESSION['ticketerror'] = "Your ticket is not founded";
    redirect('index.php');
}

$ticket = $tickets[0];


$user = find('users', $userid);
$trips = find('trips', $ticket['trip_id']);
$bus = find('buses', $trips['bus_id']);

$route = find('routes', $trips['route_id']);

$source_place = find('places', $route['source_place_id']);
$destination_place = find('places', $route['destination_place_id']);



require_once "./components/header.php";

require_once "./components/nav.php";
?>

<div class="container">


    <?php
    get_error();
    get_success();
    ?>
</div>

<div class="container p-5">
    <p class="h3">Tickets</p>
    <hr>
    <div class="section">

        <div>
            <p>Ticket Number : <?php echo $ticket['ticket_number']; ?></p>
            <p>Passenger Name: <?php echo $user['name'] ?></p>
            <p>Passenger Email: <?php echo $user['email'] ?></p>
            <p>Bus Number Plate : <?php echo $bus['number_plate'] ?></p>
            <p>Route: <?php echo $source_place['place'] . " - " . $destination_place['place'] ?></p>
            <p>Total Number of Passengers : <?php echo $ticket['total_fare'] / $route['fare'] ?></p>
            <p>Fare amount: <?php echo  $route['fare'] ?></p>
            <p>Date: <?php echo $trips['date'] ?></p>
            <p>Time: <?php echo $trips['time'] ?></p>
        </div>
    </div>
</div>





<?php
require_once "./components/footer.php";
?>
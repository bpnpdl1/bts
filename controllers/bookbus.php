<?php
require_once __DIR__ . "/../db.php";


if (isset($_SESSION['seat'])) {





    $seat = $_SESSION['seat'];

    // $data = create('seat', $seat);

    $trips = $_SESSION['trips'];

    $route = find('routes', $trips['route_id']);
    $bus = find('buses', $trips['bus_id']);


    $sql = "SELECT max(id) as id FROM seat";

    $max_id = query($sql)[0]['id'];

    $ticket = uniqid();





    $ticketdata = [
        'ticket_number' => $ticket,
        'trip_id' => $seat['trip_id'],
        'user_id' => $_SESSION['user_id'],
        'total_fare' => $route['fare'] * $_REQUEST['seat_number'],
    ];




    create('tickets', $ticketdata);

    $sql = "SELECT max(id) as id FROM tickets";
    $ticket_id = query($sql);



    $ticket = find('tickets', $ticket_id[0]['id']);

    redirect('../tickets.php?ticket=' . $ticket['ticket_number']);
}

<?php
require_once __DIR__ . "/../db.php";


if (isset($_SESSION['seats'])) {





    $seat = $_SESSION['seat'];
    $seats=$_SESSION['seats'];


    

    // $data = create('seat', $seat);

    $trips = $_SESSION['trips'];

    // dd($trips);

    $route = find('routes', $trips['route_id']);
    $bus = find('buses', $trips['bus_id']);


    $sql = "SELECT max(id) as id FROM seat";

    $max_id = query($sql)[0]['id'];

    $ticket = uniqid();





    $ticketdata = [
        'ticket_number' => $ticket,
        'trip_id' => $trips['id'],
        'user_id' => $_SESSION['user_id'],
        'total_fare' => $route['fare'] * $_REQUEST['seat_number'],
    ];




    create('tickets', $ticketdata);

    $sql = "SELECT max(id) as id FROM tickets";
    $ticket_id = query($sql);

  foreach($seats as $reserve_seat){

    $insertdata=[
        'bus_id'=>$seat['bus_id'],
        'trip_id'=>$trips['id'],
        'seat_number'=>$reserve_seat, 
        'is_reserved'=>'reserved',  
    ];

    create('seat',$insertdata);



  }



    $ticket = find('tickets', $ticket_id[0]['id']);

    redirect('../tickets.php?ticket=' . $ticket['ticket_number']);
}

<?php

$date = strval(request('date'));

$sql = "SELECT * FROM trips where route_id=" . request('route_id') . " and date='$date' and bus_id=" . request('bus_id') . "";

$trips = query($sql);

$_SESSION['trips'] = $trips[0];


$bus_seat = query("SELECT * FROM seat  where bus_id=" . request('bus_id') . "");


if (count($bus_seat) > 0) {
    $seat = $bus_seat[0];
}



function reserved($seat, $i, $actionmsg)
{
    if ($seat['seat_number'] == $i) {
        echo $actionmsg;
    } else {
        echo "";
    }
}



$bus = find('buses', $trips[0]['bus_id']);

$maxseat = $bus['seats'];

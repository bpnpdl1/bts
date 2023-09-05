<?php

require_once "./db.php";
$title = "Buses";

auth();
require_once "./components/header.php";

require_once "./components/nav.php";
?>


<div class="my-5" style="min-height: 440px;">
    <div class="container">
        <p class="h4">Ticket Lists</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">SN</th>
                        <th scope="col">Ticket number</th>
                        <th scope="col">Date</th>
                        <th scope="col">Ticket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT tickets.*,trips.date FROM tickets JOIN trips ON tickets.trip_id=trips.id WHERE user_id=6 ORDER BY  tickets.id DESC LIMIT 15";
                    $tickets = query($sql);

                    if (isset($tickets)) {
                        foreach ($tickets as $key => $ticket) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $key + 1 ?></th>
                                <td><?php echo $ticket['ticket_number']; ?></td>
                                <td><?php echo $ticket['date']; ?></td>
                                <td><a class="btn btn-sm btn-primary text-light" href="./tickets.php?ticket=<?php echo $ticket['ticket_number']; ?>">View Ticket details</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No Ticket Found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?php
require_once "./components/footer.php";
?>
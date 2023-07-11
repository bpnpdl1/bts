<nav class="navbar navbar-expand-lg navbar-light bg-light  d-flex justify-content-between px-5">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand" href="<?php echo $root ?>">Bus Ticketing System</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo $root ?>">Home</a>
                </li>



                <?php

                if (user()) {
                ?>

                    <li class="nav-item">
                        <a class="nav-link " onclick="ticketdialog()" style="cursor: pointer;">Search Ticket</a>
                    </li>
                <?php
                }
                ?>
                <?php

                if (!user()) {
                ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $root . 'login.php' ?>">Login</a>
                    </li>
                <?php
                }
                ?>


            </ul>

        </div>
    </div>

    <dialog id="ticketdialog" class="bg-light">
        <div class="d-flex justify-content-end">
            <button class="btn btn-danger btn-sm" onclick="closedialog()">X</button>

        </div>
        <form action="./tickets.php" method="get" class="form d-flex flex-column py-5 px-4 justify-items-center align-content-center">
            <legend class="mb-3 text-center">Search the Ticket</legend>

            <input type="text" class="form-input m-2" name="ticket">
            <?php

            if (isset($_SESSION['ticketerror'])) {

                echo "<div class='alert alert-danger'>" . $_SESSION['ticketerror'] . "</div>";
                unset($_SESSION['ticketerror']);
            }

            ?>


            <button class="btn btn-primary m-2" type="submit">Search Ticket</button>

        </form>

    </dialog>

    <?php

    if (user()) {

        $user = user();
    ?>
        <div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user"> </i> <?php echo $user['name'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">

                            <li><a class="dropdown-item" href="./ticketlists.php">Ticket List</a></li>
                            <li><a class="dropdown-item" onclick="logout()" style="cursor:pointer;">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    <?php
    }
    ?>

    <script>
        var dialog = document.getElementById('ticketdialog');

        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "<?php echo './controllers/logout.php' ?>";
            }
        }


        <?php

        if (isset($_SESSION['ticketerror'])) {

        ?>
            dialog.showModal();

        <?php
        }

        ?>




        function ticketdialog() {

            dialog.showModal();
        }

        function closedialog() {
            dialog.close();
        }
    </script>
</nav>
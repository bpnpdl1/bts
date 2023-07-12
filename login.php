<?php

require_once "./db.php";
$title = "Login";
require_once "./components/header.php";

require_once "./components/nav.php";
?>

<div style="width: 100vw; height:90vh;display:flex;justify-content:center;align-items:center">
    <form action="./controllers/usercontroller.php" method="post">
        <legend>Login Form</legend>
        <?php
        get_error();
        get_success();
        ?>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>

        <div class="mb-3 d-flex flex-column ">
            <button type="submit" name="login" class="btn btn-primary">Login</button>
            <i class="center">Not have an Account ?</i>
            <a type="button" href="./register.php" class="btn btn-primary">Sign Up</a>
        </div>
    </form>
</div>



<?php
require_once "./components/footer.php";
?>
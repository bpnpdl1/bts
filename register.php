<?php

require_once "./db.php";
$title = "Register";
require_once "./components/header.php";

require_once "./components/nav.php";
?>


<div style="width: 100vw; height:90vh;display:flex;justify-content:center;align-items:center">
    <form action="./controllers/usercontroller.php" method="post">
        <legend>Register Here</legend>
        <?php
        get_error();

        ?>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name">

        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmpassword" id="exampleInputPassword1">
        </div>


        <div class="mb-3 d-flex flex-column ">
            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
            <i class="center">Already have an Account ?</i>
            <a type="button" href="./login.php" class="btn btn-primary">Login in</a>
        </div>

    </form>
</div>


<?php
require_once "./components/footer.php";
?>
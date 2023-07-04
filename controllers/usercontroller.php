
<?php
require_once "../db.php";


if (isset($_POST['login'])) {


    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Please Fill all the fields";
        header("Location: ../login.php");
        die();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please Enter a valid Email";
        header("Location: ../login.php");
        die();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be atleast 6 characters";
        header("Location: ../login.php");
        die();
    }

    $result = where('users', 'email', '=', $email)[0];


    if (!$result) {
        $_SESSION['error'] = "Email doesnot exists";
        header("Location: ../login.php");
        die();
    }

    if ($result['password'] != hash('sha256', $password)) {
        $_SESSION['error'] = "Password is incorrect";
        header("Location: ../login.php");
        die();
    }

    if ($result['password'] == hash('sha256', $password)) {
        $_SESSION['user_id'] = $result['id'];
        success("Login Successfull");

        header("Location: ../index.php");
        die();
    }
}


if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if (empty($email) || empty($password) || empty($confirmpassword)) {
        $_SESSION['error'] = "Please Fill all the fields";


        // redirect("../register.php");
        header("Location: ../register.php");
        die();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please Enter a valid Email";
        header("Location: ../register.php");
        die();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be atleast 6 characters";
        header("Location: ../register.php");
        die();
    }

    if ($password != $confirmpassword) {
        $_SESSION['error'] = "Password and confirm password Doesnot match";
        header("Location: ../register.php");
        die();
    }

    if (where('users', 'email', '=', $email)) {
        $_SESSION['error'] = "Email already exists";
        header("Location: ../register.php");
        die();
    }

    if ($password == $confirmpassword) {
        $result = create('users', [
            'name' => $name,
            'email' => $email,
            'password' => hash('sha256', $password),
        ]);
        if ($result) {
            success("New Account Created Successfully");
            header("Location: ../login.php");
            die();
        } else {
            echo "Error";
        }
    } else {
        $_SESSION['error'] = "Password and confirm password Doesnot match";
        header("Location: ../register.php");
        die();
    }
}


?>
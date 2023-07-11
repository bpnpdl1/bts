<?php
session_start();

$root = "http://localhost:8080/bts/";

$_SESSION['root'] = $root;



function mysqli_connect_db()
{
    $dbhost = "localhost"; // or IP address: 127.0.0.1
    $dbname = "bts";
    $dbuser = "root";
    $dbpass = "";

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($mysqli->connect_errno) {
        die("Cannot Connect to Database: " . $mysqli->connect_error);
    }

    return $mysqli;
}

function mysqli_query_exec($mysqli, $sql)
{
    $result = $mysqli->query($sql);

    if (!$result) {
        die("Query Error: " . $mysqli->error);
    }

    return $result;
}

function mysqli_fetch_all_rows($result)
{
    $rows = [];

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}

function mysqli_fetch_single_row($result)
{
    return $result->fetch_assoc();
}

function mysqli_get_last_insert_id($mysqli)
{
    return $mysqli->insert_id;
}

// function mysqli_escape_string($mysqli, $string)
// {
//     return $mysqli->real_escape_string($string);
// }

function create($table, $data)
{
    $mysqli = mysqli_connect_db();

    // Prepare the column names and values
    $columns = implode(', ', array_keys($data));

    $values = array_map(function ($value) use ($mysqli) {
        return "'" . mysqli_escape_string($mysqli, $value) . "'";
    }, $data);

    $values = implode(', ', $values);

    // Create the INSERT query
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    // Execute the query
    mysqli_query_exec($mysqli, $sql);

    // Return the last insert ID
    return mysqli_get_last_insert_id($mysqli);
}


function all($table)
{
    $mysqli = mysqli_connect_db();
    $sql = "SELECT * FROM $table";
    $result = mysqli_query_exec($mysqli, $sql);
    return mysqli_fetch_all_rows($result);
}

function find($table, $id)
{
    $mysqli = mysqli_connect_db();
    $id = mysqli_escape_string($mysqli, $id);
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    $result = mysqli_query_exec($mysqli, $sql);
    return mysqli_fetch_single_row($result);
}

function where($table, $col, $opr, $val)
{
    $mysqli = mysqli_connect_db();
    $col = mysqli_escape_string($mysqli, $col);
    $val = mysqli_escape_string($mysqli, $val);
    $sql = "SELECT * FROM $table WHERE $col $opr '$val'";
    $result = mysqli_query_exec($mysqli, $sql);
    return mysqli_fetch_all_rows($result);
}

function db_count($table)
{
    $mysqli = mysqli_connect_db();
    $sql = "SELECT count(*) as count FROM $table";
    $result = mysqli_query_exec($mysqli, $sql);
    $row = mysqli_fetch_single_row($result);
    return $row['count'];
}

function query($sql)
{
    $mysqli = mysqli_connect_db();
    $result = mysqli_query_exec($mysqli, $sql);
    return mysqli_fetch_all_rows($result);
}


function whereIn($table, $arr_id)
{
    $mysqli = mysqli_connect_db();
    $arr_id = implode(',', $arr_id);
    $sql = "SELECT * FROM $table WHERE id IN ($arr_id)";
    $result = mysqli_query_exec($mysqli, $sql);
    return mysqli_fetch_all_rows($result);
}


function pluck($table, $col)
{
    $mysqli = mysqli_connect_db();
    $sql = "SELECT $col FROM $table";
    $result = mysqli_query_exec($mysqli, $sql);
    return mysqli_fetch_all_rows($result);
}


function request($key)
{
    return $_REQUEST[$key] ?? null;
}

/**
 * Check if User is Logged in or Not
 *   
 * @return bool
 */
function is_logged()
{
    if (empty($_SESSION['user_id'])) {
        return false;
    }

    return true;
}

/**
 * Get currently logged in user details
 *
 * @return false|array
 */
function user()
{
    if (is_logged()) {
        return find('users', $_SESSION['user_id']);
    }

    return false;
}



function dd($data)
{
    echo "
<pre>";
    print_r($data);
    echo "</pre>";
    die();
}


function redirect($url)
{
    header("Location: $url");
    die();
}




function success($msg)
{
    $_SESSION['success'] = $msg;
}

function error($msg)
{
    $_SESSION['error'] = $msg;
}

function get_error()
{
    if (isset($_SESSION['error'])) {
        $msg = $_SESSION['error'];
        echo "<div class='alert alert-danger'>$msg</div>";
        unset($_SESSION['error']);
        return $msg;
    }
    return false;
}

function get_success()
{
    if (isset($_SESSION['success'])) {
        $msg = $_SESSION['success'];
        echo "<div class='alert alert-success'>$msg</div>";
        unset($_SESSION['success']);
        return $msg;
    }
    return false;
}
function has_error()
{
    return isset($_SESSION['error']);
};

function has_success()
{
    return isset($_SESSION['success']);
};

function auth()
{
    if (!is_logged()) {
        $_SESSION['error'] = "Please Login First";
        redirect($GLOBALS['root'] . 'login.php');
    }
}

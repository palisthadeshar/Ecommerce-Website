<?php
session_start();

include('connect.php');

//setting cookie for user authentication logins

//user cookie

// $_COOKIE["user"] = false;

$userName = $_POST['name'];
$password = $_POST['password'];

//if customer or trader -->
$passwordhash = sha1($password);

// $passwordhash = strtoupper($passwordhash);

$sqlForUserLogin = "SELECT * FROM USER_TABLE WHERE USERNAME = '$userName' AND PASSWORD = '$passwordhash'";


$parsing = oci_parse($conn, $sqlForUserLogin);

$execute = oci_execute($parsing);

// print_r();
$status = false;
$row = oci_fetch_array($parsing, OCI_BOTH);

while (($row) != false) {
    $status = true;
    break;
}

// exit();
if ($row == null) {
    $_SESSION["user"] = 'not a user';
    header('Location:../loginPage.php');
} else if ($row['VERIFICATION'] != 1) {
    header('Location:../loginPage.php?verified=failed');
    exit();
} else {
    $type = $row[8];

    if ($type == "customer") {
        $_SESSION["name"] = $row[1];
        $_SESSION["cus_id"] = $row[0];
    } else if ($type == "trader") {
        $_SESSION["name_t"] = $row[1];
        $_SESSION["tra_id"] = $row[0];
    } else if ($type == "admin") {
        $_SESSION["admin"] = $row[1];
    }
    if (isset($_GET["redirect"])) {
        $redirect = $_GET["redirect"];
        header("location:../ $redirect");
    }


    header("Location:./wishListAdd.php");
}

<?php
include('./connect.php');

session_start();

if (isset($_GET['username']) && isset($_GET['pass'])) {
    $USER_NAME = $_GET['username'];
    $pass = $_GET['pass'];
    $email = $_GET['email'];

    $hashedPassword = strtoupper(sha1($pass));

    $sql = "UPDATE USER_TABLE SET password = '$hashedPassword' WHERE USERNAME = '$USER_NAME'";
    echo $sql;
    $compiled = oci_parse($conn, $sql);

    oci_execute($compiled);
    header('Location:../loginpage.php?reset=sucess');
    exit();
}
$USER_NAME = $_POST['username'];
$pass = $_POST['pass'];
$currentpass = $_POST['currentPass'];

$sql = "SELECT 1 FROM USER_TABLE WHERE USERNAME = '$USER_NAME'";

$compiled = oci_parse($conn, $sql);

oci_execute($compiled);

if (oci_fetch_array($compiled, OCI_ASSOC) == null) {
    header("Location:../passwordReset.php?username=failed");
}


$hashedPassword = sha1($currentpass);


$sql = "SELECT 1 FROM USER_TABLE WHERE USERNAME = '$USER_NAME' AND PASSWORD = '$hashedPassword'";

$compiled = oci_parse($conn, $sql);
oci_execute($compiled);

if (oci_fetch_array($compiled, OCI_ASSOC) == null) {
    header("Location:../passwordReset.php?password=failed");
}

$hashedPassword = sha1($pass);

$sql = "UPDATE USER_TABLE SET password = '$hashedPassword' WHERE USERNAME = '$USER_NAME'";

$compiled = oci_parse($conn, $sql);

if (oci_execute($compiled)) {
    header("Location:../passwordReset.php?resetSucess=true");
}

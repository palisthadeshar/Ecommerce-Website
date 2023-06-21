<?php
include('connect.php');
$email = $_GET['email'];
$sql = "UPDATE USER_TABLE SET VERIFICATION = 1 WHERE EMAIL = '$email'";

$parsing = oci_parse($conn, $sql);
$execute = oci_execute($parsing);

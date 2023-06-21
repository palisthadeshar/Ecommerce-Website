<?php
include('connect.php');

$decode = json_decode($_GET['updateProfile'], true);
$id = $_GET['id'];

$user_name = $decode['username'];
$first_name = $decode['fname'];
$last_name = $decode['lname'];
$email = $decode['email'];
$ph_number = $decode['phone'];
$dob = $decode['dob'];
$address = $decode['address'];
$gender = $decode['gender'];

//checking if the unique column have unique value or not

session_start();
$stmt1 = "select 1 from USER_TABLE where username = '$user_name'";

$compiled = oci_parse($conn, $stmt1);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);

$stmt = "SELECT * FROM USER_TABLE WHERE USER_ID = $_SESSION[cus_id]";
echo $stmt;
$compiled2 = oci_parse($conn, $stmt);
oci_execute($compiled2);
$userinformation = oci_fetch_array($compiled2, OCI_BOTH);

if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1 && $userinformation['USERNAME'] != $user_name) {
    $_SESSION["repeat_username"] = "repeatitive";
    header("Location:../CustomerProfileUpdate.php?notupdated=true");
    exit();
} else {
    $_SESSION["repeat_username"] = "none";
}


$stmt2 = "select 1 from USER_TABLE where email = '$email'";
$compiled = oci_parse($conn, $stmt2);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1 && $userinformation['EMAIL'] != $email) {
    $_SESSION["repeat_email"] = "repeatitive";
    header("Location:../CustomerProfileUpdate.php?notupdated=true");
    exit();
} else {
    $_SESSION["repeat_email"] = "none";
}

$stmt3 = "select 1 from USER_TABLE where phone_number = '$ph_number'";
$compiled = oci_parse($conn, $stmt3);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1 && $userinformation['PHONE_NUMBER'] != $ph_number) {
    $_SESSION["repeat_phone_number"]  = "repeatitive";
    header("Location:../CustomerProfileUpdate.php?notupdated=true");
    exit();
} else {
    $_SESSION["repeat_phone_number"] = "none";
}

unset($_SESSION["repeat_username"]);
unset($_SESSION["repeat_email"]);
unset($_SESSION["repeat_phone_number"]);


$todayDay = date("m/d/Y");
$dob = explode("-", $dob);
$todayDay = explode("/", $todayDay);

//months
$month = array("01" => "JAN", "02" => "FEB", "03" => "MAR", "04" => "APR", "05" => "MAY", "06" => "JUNE", "07" => "JULY", "08" => "AUG", "09" => "SEPT", "10" => "OCT", "11" => "NOV", "12" => "DEC");
$DOBMonth = $month[$dob[1]];

$todayDayMonth = $month[$todayDay[0]];

$sqlForUpdate = "UPDATE USER_TABLE
SET USERNAME='$user_name', FIRST_NAME= '$first_name', LAST_NAME='$last_name' , USER_ADDRESS='$address', PHONE_NUMBER='$ph_number',EMAIL = '$email', GENDER= '$gender', DOB ='$dob[2]-$DOBMonth-$dob[0]'
WHERE USER_ID= $id";

$compiled = oci_parse($conn, $sqlForUpdate);


if (oci_execute($compiled)) {
    header('Location:../CustomerProfileUpdate.php?profileupdated=true');
}

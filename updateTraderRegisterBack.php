<?php
include("connect.php");


$decode = json_decode($_GET['updateProfile'], true);
$id = $_GET['id'];

$company_name = $decode["comp_name"];

$registration_date = $decode["reg_date"];

$category = $decode["category"];

$email = $decode["email"];

$phone = $decode["ph_number"];

$address = $decode["address"];

$todayDay = date("m/d/Y");

$dob = explode("-", $registration_date);

$todayDay = explode("/", $todayDay);

//months

session_start();


$stmt = "SELECT * FROM USER_TABLE WHERE USER_ID = $_SESSION[tra_id]";
echo $stmt;
$compiled2 = oci_parse($conn, $stmt);
oci_execute($compiled2);
$userinformation = oci_fetch_array($compiled2, OCI_BOTH);

$stmt1 = "select 1 from USER_TABLE where username = '$company_name'";
$compiled = oci_parse($conn, $stmt1);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1 && $userinformation['USERNAME'] != $company_name) {
    $_SESSION["repeat_username_t"] = "repeatitive";
    header("Location:../traderProfileUpdate.php");
    exit();
} else {
    $_SESSION["repeat_username_t"] = "none";
}

$stmt2 = "select 1 from USER_TABLE where email = '$email'";
$compiled = oci_parse($conn, $stmt2);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1 && $userinformation['EMAIL'] != $email) {
    $_SESSION["repeat_email_t"] = "repeatitive";
    header("Location:../traderProfileUpdate.php");
    exit();
} else {
    $_SESSION["repeat_email_t"] = "none";
}

$stmt3 = "select 1 from USER_TABLE where phone_number = '$phone'";
$compiled = oci_parse($conn, $stmt3);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1 && $userinformation['PHONE_NUMBER'] != $phone) {
    $_SESSION["repeat_phone_number_t"]  = "repeatitive";
    header("Location:../traderProfileUpdate.php");
    exit();
} else {
    $_SESSION["repeat_phone_number_t"] = "none";
}

unset($_SESSION["repeat_username_t"]);
unset($_SESSION["repeat_email_t"]);
unset($_SESSION["repeat_phone_number_t"]);


$month = array("01" => "JAN", "02" => "FEB", "03" => "MAR", "04" => "APR", "05" => "MAY", "06" => "JUNE", "07" => "JULY", "08" => "AUG", "09" => "SEPT", "10" => "OCT", "11" => "NOV", "12" => "DEC");

$DOBMonth = $month[$dob[1]];

$todayDayMonth = $month[$todayDay[0]];

$sqlForUpdate = "UPDATE USER_TABLE
SET USERNAME='$company_name', USER_ADDRESS='$address', PHONE_NUMBER='$phone',EMAIL = '$email', DOB ='$dob[2]-$DOBMonth-$dob[0]'
WHERE USER_ID= $id";

$compiled = oci_parse($conn, $sqlForUpdate);

if (oci_execute($compiled)) {

    header('Location:../traderProfileUpdate.php?profileupdated=true');
} else {
    echo $sql;
}

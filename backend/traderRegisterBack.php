<?php
include("connect.php");
$company_name = $_POST["comp_name"];

$registration_date = $_POST["reg_date"];

$category = $_POST["category"];

$email = $_POST["email"];

$phone = $_POST["ph_number"];

$address = $_POST["address"];

$password = $_POST["pass"];

$hashedPassword = sha1($password);

$todayDay = date("m/d/Y");

$dob = explode("-", $registration_date);

$todayDay = explode("/", $todayDay);

//months

session_start();


$stmt1 = "select 1 from USER_TABLE where username = '$company_name'";
$compiled = oci_parse($conn, $stmt1);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1) {
    $_SESSION["repeat_username_t"] = "repeatitive";
    header("Location:../traderRegistration.php");
    exit();
} else {
    $_SESSION["repeat_username_t"] = "none";
}

$stmt2 = "select 1 from USER_TABLE where email = '$email'";
$compiled = oci_parse($conn, $stmt2);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1) {
    $_SESSION["repeat_email_t"] = "repeatitive";
    header("Location:../traderRegistration.php");
    exit();
} else {
    $_SESSION["repeat_email_t"] = "none";
}

$stmt3 = "select 1 from USER_TABLE where phone_number = '$phone'";
$compiled = oci_parse($conn, $stmt3);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1) {
    $_SESSION["repeat_phone_number_t"]  = "repeatitive";
    header("Location:../traderRegistration.php");
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

$sql = "insert into USER_TABLE (USERNAME , PASSWORD, FIRST_NAME, LAST_NAME, USER_ADDRESS, PHONE_NUMBER , EMAIL , TYPE , GENDER, DOB , REGISTRATION_DATE,TRADER_CATEGORY) values
(:fullname,'$hashedPassword','none', 'none',:address,:ph_number, :email, 'trader' , 'none', '$dob[2]-$DOBMonth-$dob[0]' ,'$todayDay[1]-$todayDayMonth-$todayDay[2]', '$category')";


$compiled = oci_parse($conn, $sql);
echo $sql;
oci_bind_by_name($compiled, ':fullname', $company_name);
oci_bind_by_name($compiled, ':address', $address);
oci_bind_by_name($compiled, ':ph_number', $phone);
oci_bind_by_name($compiled, ':email', $email);

if (oci_execute($compiled)) {
    header("Location:sendmail.php?email=$email");
} else {
    echo $sql;
}

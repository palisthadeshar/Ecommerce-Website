<?php

include('connect.php');


//to do -->
//create sequence to create user
//database validation if same email or something like that
//dob put in database
//today date

// --->
//login 
//sessions if not logged out log in
//name of person show there

// ----->
//login as trader or customer

//--->
//sort items with price or alphabetically

//----->
//search product recommendations

//tommorow 
//cart
//trader conspiracy
//triggers in database

$user_name = $_POST['username'];
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$email = $_POST['email'];
$ph_number = $_POST['phone'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$confim_pass = $_POST['confirmPass'];
$gender = $_POST['gender'];

//checking if the unique column have unique value or not

session_start();


$stmt1 = "select 1 from USER_TABLE where username = '$user_name'";
$compiled = oci_parse($conn, $stmt1);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1) {
    $_SESSION["repeat_username"] = "repeatitive";
    header("Location:../CustomerRegistration.php");
    exit();
} else {
    $_SESSION["repeat_username"] = "none";
}


$stmt2 = "select 1 from USER_TABLE where email = '$email'";
$compiled = oci_parse($conn, $stmt2);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1) {
    $_SESSION["repeat_email"] = "repeatitive";
    header("Location:../CustomerRegistration.php");
    exit();
} else {
    $_SESSION["repeat_email"] = "none";
}

$stmt3 = "select 1 from USER_TABLE where phone_number = '$ph_number'";
$compiled = oci_parse($conn, $stmt3);
oci_execute($compiled);
$check_hasor_not = oci_fetch_array($compiled, OCI_BOTH);
if ($check_hasor_not != null && $check_hasor_not[0] == 1 && $check_hasor_not[1] == 1) {
    $_SESSION["repeat_phone_number"]  = "repeatitive";
    header("Location:../CustomerRegistration.php");
    exit();
} else {
    $_SESSION["repeat_phone_number"] = "none";
}

unset($_SESSION["repeat_username"]);
unset($_SESSION["repeat_email"]);
unset($_SESSION["repeat_phone_number"]);

$hashedPassword = sha1($confim_pass);

$todayDay = date("m/d/Y");
$dob = explode("-", $dob);
$todayDay = explode("/", $todayDay);

//months
$month = array("01" => "JAN", "02" => "FEB", "03" => "MAR", "04" => "APR", "05" => "MAY", "06" => "JUNE", "07" => "JULY", "08" => "AUG", "09" => "SEPT", "10" => "OCT", "11" => "NOV", "12" => "DEC");
$DOBMonth = $month[$dob[1]];

$todayDayMonth = $month[$todayDay[0]];

$sql = "insert into USER_TABLE (USERNAME , PASSWORD, FIRST_NAME, LAST_NAME, USER_ADDRESS, PHONE_NUMBER , EMAIL , TYPE , GENDER, DOB , REGISTRATION_DATE)values
(:fullname,'$hashedPassword',:first_name, :last_name,:address,:ph_number, :email, 'customer' , '$gender', '$dob[2]-$DOBMonth-$dob[0]' ,'$todayDay[1]-$todayDayMonth-$todayDay[2]')";


$compiled = oci_parse($conn, $sql);
oci_bind_by_name($compiled, ':fullname', $user_name);
oci_bind_by_name($compiled, ':first_name', $first_name);
oci_bind_by_name($compiled, ':last_name', $last_name);
oci_bind_by_name($compiled, ':address', $address);
oci_bind_by_name($compiled, ':ph_number', $ph_number);
oci_bind_by_name($compiled, ':email', $email);

if (oci_execute($compiled)) {
    header("Location:sendmail.php?email=$email");
}

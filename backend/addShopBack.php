<?php
include('connect.php');
session_start();
$trader_id = $_SESSION["tra_id"];
$sql = "SELECT COUNT(SHOP_ID) AS SHOP_ID FROM SHOP WHERE USER_ID=$trader_id";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$row = oci_fetch_array($compiled, OCI_ASSOC);

if ($row['SHOP_ID'] > 2) {
    header("Location:../addShop.php?not_more_than_two_shop=true");
    exit();
}

$product_name = htmlentities($_POST['shop_name']);

$address = htmlentities($_POST['address']);

$contact_number = htmlentities($_POST['contact_number']);

$sql = "SELECT 1 from SHOP where SHOP_NAME = '$product_name'";
echo $sql;
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$check_hasor_not_s = oci_fetch_array($compiled, OCI_BOTH);

if ($check_hasor_not_s != null && $check_hasor_not_s[0] == 1 && $check_hasor_not_s[1] == 1) {
    $_SESSION["shop_name_repeat"] = "repeatitive";
    header("Location:../addShop.php");
    exit();
} else {
    $_SESSION["shop_name_repeat"] = "none";
}


unset($_SESSION["shop_name_repeat"]);

$sql = "SELECT 1 from SHOP where CONTACT_NUMBER = '$contact_number'";

$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$check_hasor_not_s = oci_fetch_array($compiled, OCI_BOTH);

if ($check_hasor_not_s != null && $check_hasor_not_s[0] == 1 && $check_hasor_not_s[1] == 1) {
    $_SESSION["contact_repeat_s"] = "repeatitive";
    header("Location:../addShop.php");
    exit();
} else {
    $_SESSION["contact_repeat_s"] = "none";
}


unset($_SESSION["contact_repeat_s"]);

$todayDay = date("m/d/Y");
$todayDay = explode("/", $todayDay);

$month = array("01" => "JAN", "02" => "FEB", "03" => "MAR", "04" => "APR", "05" => "MAY", "06" => "JUNE", "07" => "JULY", "08" => "AUG", "09" => "SEPT", "10" => "OCT", "11" => "NOV", "12" => "DEC");

$todayDayMonth = $month[$todayDay[0]];

$sql = "INSERT INTO SHOP (SHOP_NAME, SHOP_ADDRESS, CONTACT_NUMBER, REGISTRATION_DATE, USER_ID) VALUES('$product_name' , '$address' , '$contact_number', '$todayDay[1]-$todayDayMonth-$todayDay[2]',$trader_id)";
echo $sql;
$compiled = oci_parse($conn, $sql);
if (oci_execute($compiled)) {
    header('Location:../addShop.php?added=true');
}

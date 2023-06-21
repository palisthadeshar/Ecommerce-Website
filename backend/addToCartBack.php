<?php
session_start();
include('connect.php');
$sql = "SELECT * FROM CART";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$carts =  oci_fetch_array($compiled, OCI_ASSOC);






if (!isset($_SESSION["cus_id"])) {
    header("Location: ../loginpage.php?notLogin=error");
    exit();
}

$user_id = $_SESSION["cus_id"];
// exit();

$pid = $_POST['pid'];
$qty = $_POST['qty'];
if ($carts['NUMBER_OF_PRODUCT'] + $qty > 20) {
    header("Location:../productDetail.php?outOFweight=true");
    exit();
}

$price = $_POST['price'];


//user id


//not login cart---->

// setcookie($user_id, $pid, time() + (86400 * 30), "/");


$sql = "SELECT 1 FROM CART WHERE USER_ID = $user_id";

$parsing = oci_parse($conn, $sql);

$execute = oci_execute($parsing);

$row = oci_fetch_array($parsing, OCI_BOTH);

if ($row == null) {
    $sql = "INSERT INTO CART(NUMBER_OF_PRODUCT, TOTAL_PRICE, MINIMUM_ORDER, MAXIMUM_ORDER, USER_ID) VALUES(0,0,0,20,$user_id)";
    $parsing = oci_parse($conn, $sql);
    $execute = oci_execute($parsing);
}


$sql = "SELECT * FROM CART WHERE USER_ID = $user_id";
$parsing = oci_parse($conn, $sql);
$execute = oci_execute($parsing);

$row = oci_fetch_array($parsing, OCI_BOTH);

$cart_id = $row['CART_ID'];
$Total_price = $row['TOTAL_PRICE'];
$order = $row['NUMBER_OF_PRODUCT'];
$order = (int)$order;
$qty = (int)$qty;

$order += $qty;

$sql = "SELECT 1, QUANTITY FROM CART_ENTRY WHERE PRODUCT_ID= $pid AND  CART_ID = $cart_id";
$parsing = oci_parse($conn, $sql);
$execute = oci_execute($parsing);
$row = oci_fetch_array($parsing, OCI_ASSOC);
if ($row != null && $row[1] == 1) {
    $updated_quantity_of_product = $row['QUANTITY'] + $qty;
    $sql = "UPDATE CART_ENTRY SET QUANTITY= $updated_quantity_of_product WHERE CART_ID = $cart_id AND PRODUCT_ID = $pid";
    $parsing = oci_parse($conn, $sql);
    $execute = oci_execute($parsing);
} else {
    $sql = "INSERT INTO CART_ENTRY(QUANTITY, UNIT_PRICE, CART_ID, PRODUCT_ID) VALUES ($qty,$price,$cart_id,$pid )";
    $parsing = oci_parse($conn, $sql);
    $execute = oci_execute($parsing);
    // exit();
}

$this_product_price = $qty * $price;
$Total_price = $Total_price + $this_product_price;
//adding quantity has a problem need to solve that
// $sql  = "SELECT 1 FROM CART_ENTRY WHERE CART_OD"; TO DO IF PRODUCT IS ALREADY THERE . IF COMPLETELY NEW PRODUCT ARRIVES THEN ADD NEW PRODUCT ?? ASK GUYS

$sql = "UPDATE CART SET TOTAL_PRICE = $Total_price , NUMBER_OF_PRODUCT = $order WHERE USER_ID = $user_id";
print_r($sql);
$parsing = oci_parse($conn, $sql);
$execute = oci_execute($parsing);

header("Location:../productCategory.php?sucess=true");

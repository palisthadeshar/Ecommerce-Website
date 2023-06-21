<?php
include('connect.php');
session_start();
$sql = "SELECT * FROM CART";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$carts =  oci_fetch_array($compiled, OCI_ASSOC);


$pid = $_GET['product_id'];

$quantity = $_GET['quantity'];

if ($_GET['add']) {
    if ($carts['NUMBER_OF_PRODUCT'] + 1 > 20) {
        header('Location:../homepage.php?outOFweight=true');
        exit();
    }

    print_r($quantity);
    $quantity = (int) $quantity + 1;

    $sqs = "UPDATE CART_ENTRY
    SET QUANTITY= $quantity
    WHERE PRODUCT_ID = $pid";

    $compiled = oci_parse($conn, $sqs);
    oci_execute($compiled);
    print_r($sqs);

    $sq = "SELECT PRICE FROM PRODUCT WHERE PRODUCT_ID = $pid";
    $compiled = oci_parse($conn, $sq);
    oci_execute($compiled);
    $price = oci_fetch_array($compiled, OCI_ASSOC);


    $sq = "SELECT CART_ID,NUMBER_OF_PRODUCT, TOTAL_PRICE FROM CART WHERE USER_ID = $_SESSION[cus_id]";
    $compiled = oci_parse($conn, $sq);
    oci_execute($compiled);

    $cart = oci_fetch_array($compiled, OCI_ASSOC);


    $finalPrice = $cart['TOTAL_PRICE'] + $price['PRICE'];
    $quantity = $cart['NUMBER_OF_PRODUCT'] + 1;

    $sql = "UPDATE CART
    SET NUMBER_OF_PRODUCT= $quantity , TOTAL_PRICE=$finalPrice
    WHERE CART_ID = $cart[CART_ID]";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled); //lets see

} else {
    $cart_entry_id = $_GET['cart_entry_id'];
    print_r($cart_entry_id);
    if ($carts['NUMBER_OF_PRODUCT'] == 1) {
        header("Location:./deleteProductBack.php?cart_entry_id=$cart_entry_id&&quantity=1");
        exit();
    }

    $quantity = (int) $quantity - 1;

    $sqs = "UPDATE CART_ENTRY
    SET QUANTITY= $quantity
    WHERE PRODUCT_ID = $pid";

    $compiled = oci_parse($conn, $sqs);
    oci_execute($compiled);
    print_r($sqs);

    $sq = "SELECT PRICE FROM PRODUCT WHERE PRODUCT_ID = $pid";
    $compiled = oci_parse($conn, $sq);
    oci_execute($compiled);
    $price = oci_fetch_array($compiled, OCI_ASSOC);


    $sq = "SELECT CART_ID,NUMBER_OF_PRODUCT, TOTAL_PRICE FROM CART WHERE USER_ID = $_SESSION[cus_id]";
    $compiled = oci_parse($conn, $sq);
    oci_execute($compiled);

    $cart = oci_fetch_array($compiled, OCI_ASSOC);


    $finalPrice = $cart['TOTAL_PRICE'] - $price['PRICE'];
    $quantity = $cart['NUMBER_OF_PRODUCT'] - 1;

    $sql = "UPDATE CART
    SET NUMBER_OF_PRODUCT= $quantity , TOTAL_PRICE=$finalPrice
    WHERE CART_ID = $cart[CART_ID]";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled); //lets see

}



header("Location:../homepage.php");

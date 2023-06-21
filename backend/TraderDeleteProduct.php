<?php
include('./connect.php');

$id = $_GET['traproid'];
$sql = "SELECT * FROM CART_ENTRY WHERE PRODUCT_ID=$id";

$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$wishlistdetails = oci_fetch_array($compiled, OCI_ASSOC);

$qty = $wishlistdetails['QUANTITY'];
$unitprice = $wishlistdetails['UNIT_PRICE'];
$cartid = $wishlistdetails['CART_ID'];
$total = $qty * $unitprice;


$sql = "SELECT TOTAL_PRICE,NUMBER_OF_PRODUCT FROM CART WHERE CART_ID = $cartid";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$totalCart = oci_fetch_array($compiled, OCI_ASSOC);

$totalCartPrice = $totalCart['TOTAL_PRICE'];
$totalCartPrice = $totalCartPrice - $total;

$totalproduct =  $totalCart['NUMBER_OF_PRODUCT'];
$totalproduct = $totalproduct - $qty;


$sql = "UPDATE CART
SET NUMBER_OF_PRODUCT= $totalproduct , TOTAL_PRICE=$totalCartPrice
WHERE CART_ID = $cartid";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled); //lets see


$sql = "DELETE FROM WISHLIST_ENTRY WHERE PRODUCT_ID=$id";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);


$sql = "DELETE FROM CART_ENTRY WHERE PRODUCT_ID=$id";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);



$sql = "DELETE FROM PRODUCT WHERE PRODUCT_ID = $id";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);


header('Location: ' . $_SERVER['HTTP_REFERER']);


// header('Location: ' . $_SERVER['HTTP_REFERER']);

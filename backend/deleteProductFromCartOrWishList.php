<?php
include('connect.php');
session_start();

if (isset($_GET['from']) && $_GET['from'] == "cart") {
    $sql = "SELECT * FROM CART WHERE USER_ID = $_SESSION[cus_id]";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    $cartsInfo = oci_fetch_array($compiled);
    $cart_id = $cartsInfo['CART_ID'];

    $sql = "DELETE FROM CART_ENTRY WHERE CART_ID = $cart_id";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);


    $sql = "UPDATE CART SET NUMBER_OF_PRODUCT=0, TOTAL_PRICE=0 WHERE USER_ID= $_SESSION[cus_id]";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);

    header('Location:../homepage.php');
} else {
    $sql = "SELECT * FROM WISHLIST WHERE USER_ID = $_SESSION[cus_id]";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    $wishlistinfo = oci_fetch_array($compiled, OCI_ASSOC);
    // print_r($cartsInfo);
    $wishlist_id = $wishlistinfo['WISHILIST_ID'];

    $sql = "DELETE FROM WISHLIST_ENTRY WHERE WISHILIST_id = $wishlist_id";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);

    header('Location:../homepage.php');
}

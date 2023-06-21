<?php

session_start();

include('connect.php');

if (isset($_GET['notloggedin'])) {
    //for 1 baki cha!!
    $ex = explode('~', $_SESSION['wishlistproduct']);
    $_SESSION['updatedProductList'] = '';
    // print_r($ex);
    // exit();
    if (count($ex) != 1) {
        $count = 0;
        foreach ($ex as $key => $value) {
            $product_id = substr($value, 1, 2);
            $vals = json_decode($value, true);

            foreach ($vals as $ke => $val) {

                if ($ke == $_GET['todeleteId']) {
                    continue;
                }
                if ($count == 0) {
                    $temp = $value;
                } else {
                    $temp =  $_SESSION['updatedProductList'] . '~' . $value;
                }
                $_SESSION['updatedProductList'] = $temp;
            }
            // print_r($product_id);

        }
    } else {
        $_SESSION['wishlistproduct'] = null;
    }

    // exit();
    $_SESSION['wishlistproduct'] = $_SESSION['updatedProductList'];
    unset($_SESSION['updatedProductList']);

    // exit();
    header("Location:../homepage.php");
    exit();
}

$product_id = $_GET['product_id'];
$wishlist_id = $_GET['wishlist_id'];


$sql = "DELETE FROM WISHLIST_ENTRY WHERE WISHILIST_ID= $wishlist_id AND PRODUCT_ID = $product_id";

$deleteFromWishList = oci_parse($conn, $sql);

if (oci_execute($deleteFromWishList)) {
    header("Location:../homepage.php");
}

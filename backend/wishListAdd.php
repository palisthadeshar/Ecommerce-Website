<?php
session_start();
include('connect.php');
if (isset($_GET['aboutProductId'])) {
    $product = $_GET['aboutProductId'];
}
$user_id = $_SESSION["cus_id"];

$todayDay = date("m/d/Y");
$todayDay = explode("/", $todayDay);

$month = array("01" => "JAN", "02" => "FEB", "03" => "MAR", "04" => "APR", "05" => "MAY", "06" => "JUNE", "07" => "JULY", "08" => "AUG", "09" => "SEPT", "10" => "OCT", "11" => "NOV", "12" => "DEC");

$todayDayMonth = $month[$todayDay[0]];

$sql = "SELECT WISHILIST_ID FROM WISHLIST WHERE USER_ID = $user_id";
$parsing = oci_parse($conn, $sql);
$execute = oci_execute($parsing);
$value = oci_fetch_array($parsing, OCI_ASSOC);

// print_r($value);

if (isset($_SESSION['wishlistproduct']) && $_SESSION['wishlistproduct'] != null && isset($_SESSION['cus_id'])) {
    $productsinjson = $_SESSION['wishlistproduct'];
    $ex = explode('~', $productsinjson);
    // print_r($ex);
    // exit();
    foreach ($ex as $product => $val) {
        $decode = json_decode($val, true);
        foreach ($decode as $product_id => $val) {
            $sql = "SELECT 1 FROM WISHLIST_ENTRY WHERE WISHILIST_ID = $value[WISHILIST_ID] AND PRODUCT_ID = $product_id";
            $parsing2 = oci_parse($conn, $sql);
            $execute2 = oci_execute($parsing2);
            $checkProductHas = oci_fetch_array($parsing2, OCI_ASSOC);
            if ($checkProductHas == null) {
                $sql = "INSERT INTO WISHLIST_ENTRY(WISHLIST_DATE, WISHILIST_ID, PRODUCT_ID) VALUES('$todayDay[1]-$todayDayMonth-$todayDay[2]',$value[WISHILIST_ID],$product_id)";
                $parsing = oci_parse($conn, $sql);
                $execute = oci_execute($parsing);
            }
        }
    }
    unset($_SESSION['wishlistproduct']);
    header("Location:../homepage.php");
} else if (!isset($_SESSION['cus_id'])) {
    $hasproductid = false;
    $assocproducts = array($product => $_SESSION['aboutUser']);
    if (!isset($_SESSION['wishlistproduct'])) {
        $_SESSION['wishlistproduct'] = json_encode($assocproducts);
    } else {
        $ex = explode('~', $_SESSION['wishlistproduct']);
        foreach ($ex as $key => $value) {
            $checkContains = json_decode($value, true);
            // print_r($checkContains);
            foreach ($checkContains as $has => $val) {
                if ($product == $has) {
                    $hasproductid = true;
                    break;
                }
            }
        }

        if ($_SESSION['wishlistproduct'] == null) {
            $_SESSION['wishlistproduct'] = json_encode($assocproducts);
        } else if (!$hasproductid) {
            $temp = $_SESSION['wishlistproduct'] . '~' . json_encode($assocproducts);
            $_SESSION['wishlistproduct'] = $temp;
        } else {
            header("Location:../productDetail.php?sameproduct=true");
            exit();
        }
    }

    print_r($_SESSION['wishlistproduct']);
    header("Location:../productCategory.php");
}

// exit();

if (isset($_GET['aboutProductId'])) {
    $sql = "SELECT 1 FROM WISHLIST WHERE USER_ID = $user_id";


    $parsing = oci_parse($conn, $sql);

    $execute = oci_execute($parsing);

    $row = oci_fetch_array($parsing, OCI_BOTH);

    if ($row == null) {
        $sql = "INSERT INTO WISHLIST(LISTED_DATE, USER_ID) VALUES('$todayDay[1]-$todayDayMonth-$todayDay[2]',$user_id)";
        $parsing = oci_parse($conn, $sql);
        $execute = oci_execute($parsing);
        echo $sql;
        // exit();
    }

    $sql = "SELECT 1 FROM WISHLIST_ENTRY WHERE WISHILIST_ID = $value[WISHILIST_ID] AND PRODUCT_ID = $product";
    $parsing2 = oci_parse($conn, $sql);
    $execute2 = oci_execute($parsing2);
    $checkProductHas = oci_fetch_array($parsing2, OCI_ASSOC);

    if ($checkProductHas != null) {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?sameproduct=true');
        exit();
    }

    $sql = "INSERT INTO WISHLIST_ENTRY( WISHLIST_DATE, WISHILIST_ID, PRODUCT_ID) VALUES('$todayDay[1]-$todayDayMonth-$todayDay[2]',$value[WISHILIST_ID],$product)";
    $parsing = oci_parse($conn, $sql);

    if (oci_execute($parsing)) {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?productaddedTowishlist=true');
        exit();
    }
}


header("Location:../homepage.php");

"INSERT INTO OFFER (OFFER_NAME, DISCOUNT, STARTING_DATE, ENDING_DATE) VALUES ('Thanks giving offer', 15,'5/26/2022', '5/26/2023')";

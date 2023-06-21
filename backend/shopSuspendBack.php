<?php

include('connect.php');

// print_r($_GET);
if ($_GET['activate'] == 'false') {
    $sql = "UPDATE SHOP
    SET VERIFIED = 'sus'
    WHERE SHOP_ID = $_GET[shopid]";

    echo $sql;
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    if (oci_execute($compiled)) {
        header("Location:../suspendShop.php");
    }
}

if ($_GET['activate'] == 'true') {
    $sql = "UPDATE SHOP
    SET VERIFIED = 'yes'
    WHERE SHOP_ID = $_GET[shopid]";

    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    if (oci_execute($compiled)) {
        header("Location:../suspendShop.php");
    }
}

<?php
include('connect.php');
if (isset($_GET['approve']) && $_GET['approve'] == true) {

    $sql = "UPDATE SHOP
    SET VERIFIED = 'yes'
    WHERE SHOP_ID = $_GET[shopid]";

    echo $sql;
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    if (oci_execute($compiled)) {

        header("Location:../pendingRegistration.php?Approved=true");
    }
} else {

    $sql = "DELETE FROM SHOP WHERE SHOP_ID = $_GET[shopid]";

    echo $sql;
    $compiled = oci_parse($conn, $sql);
    if (oci_execute($compiled)) {
        header("Location:../pendingRegistration.php?Approved=false");
    }
}

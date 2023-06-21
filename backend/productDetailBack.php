<?php

include('connect.php');
session_start();

if (isset($_GET['id']) || isset($_GET['traproid'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = $_GET['traproid'];
    }

    // exit();
    $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $id";

    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);

    $_SESSION['aboutUser'] = oci_fetch_array($compiled, OCI_ASSOC);
    if (isset($_GET['id'])) {
        header("Location:../productDetail.php");
    }

    if (isset($_GET['traproid'])) {
        print_r($_SESSION['aboutUser']);
        // exit();
        header("Location:../updateProduct.php");
    }
}

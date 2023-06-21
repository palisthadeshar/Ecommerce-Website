<?php
include('connect.php');

$product_name = $_POST["pname"];
$price = $_POST["price"];
$description = $_POST["description"];
$availibility = $_POST["available"];
$quantity = $_POST["quantity"];
$allergy_information = $_POST["aller_information"];
// $category = $_POST["category"];
$shop = $_POST["shop"];

$product_U_name = strtoupper($product_name);

//uploading file
$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "../image/$filename";

//making category available
$sql_category_consist = "SELECT 1 FROM PRODUCT_CATEGORY WHERE CATEGORY_NAME = '$_POST[category_name]'";
$check_category_consist = oci_parse($conn, $sql_category_consist);
oci_execute($check_category_consist);
echo $sql_category_consist;
if (oci_fetch_array($check_category_consist, OCI_BOTH) != null) {
    header("Location:../addProduct.php?category_consist=true");
} else {
    $sql_insert_category = "INSERT INTO  PRODUCT_CATEGORY (CATEGORY_NAME) VALUES ('$_POST[category_name]')";
    $insert_category = oci_parse($conn, $sql_insert_category);
    oci_execute($insert_category);
}

//selecting category
$sql_category_consistt = "SELECT CATEGORY_ID FROM PRODUCT_CATEGORY WHERE CATEGORY_NAME = '$_POST[category_name]'";
$check_category_consistt = oci_parse($conn, $sql_category_consistt);
oci_execute($check_category_consistt);

$id = oci_fetch_array($check_category_consistt, OCI_ASSOC);
if ($id == null) {
    exit();
}

if (isset($_GET['update']) && $_GET['update'] == true) {
    $sql = "UPDATE PRODUCT SET PRODUT_NAME = '$product_U_name', PRICE= '$price' , DESCRIPTION='$description', IMAGE='$filename',  QUANTITY='$quantity',AVAILABILITY='$availibility',ALERGIC_INFORMATION='$allergy_information',CATEGORY_ID='$id[CATEGORY_ID]',SHOP_ID='$shop' WHERE  PRODUCT_ID= $_GET[pro_id]";
    $compiled = oci_parse($conn, $sql);

    if (move_uploaded_file($tempname, $folder)) {
        $msg = "Image uploaded successfully";
        //location to product page
    } else {
        $msg = "Failed to upload image";
    }
    if (oci_execute($compiled)) {
        header('Location:../productCategory.php?updated=true');
    }
    // exit();
    exit();
}
//setting up sessions
session_start();
$sql = "SELECT 1 from PRODUCT where PRODUT_NAME = '$product_name'";

$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$check_hasor_not_p = oci_fetch_array($compiled, OCI_BOTH);



if ($check_hasor_not_p != null && $check_hasor_not_p[0] == 1 && $check_hasor_not_p[1] == 1) {
    $_SESSION["product_repeat_p"] = "repeatitive";
    header("Location:../addProduct.php");
    // exit();
} else {
    $_SESSION["product_repeat_p"] = "none";
}

unset($_SESSION["product_repeat_p"]);




$insertSql = "INSERT into product (PRODUT_NAME, PRICE, DESCRIPTION, IMAGE, QUANTITY, AVAILABILITY, ALERGIC_INFORMATION, CATEGORY_ID, SHOP_ID) VALUES
    ('$product_U_name', '$price', '$description', '$filename' ,'$quantity', $availibility, '$allergy_information', '$id[CATEGORY_ID]', $shop)";
echo $insertSql;
$compiled = oci_parse($conn, $insertSql);
// Now let's move the uploaded image into the folder: image
if (move_uploaded_file($tempname, $folder)) {
    $msg = "Image uploaded successfully";
    //location to product page
} else {
    $msg = "Failed to upload image";
}

if (oci_execute($compiled)) {
    header("Location:../productCategory.php?added=true");
}


<?php

include('connect.php');

$cartentryId = $_GET['cart_entry_id'];

$sql1 = "SELECT * FROM CART_ENTRY WHERE CART_ENTRY_ID = $cartentryId";
$selectFromCartEntry = oci_parse($conn, $sql1);
oci_execute($selectFromCartEntry);
$row = oci_fetch_array($selectFromCartEntry, OCI_ASSOC);

$cartId = $row['CART_ID'];
$qty = $row['QUANTITY'];
$unitPrice = $row['UNIT_PRICE'];
$totalPrice = $qty * $unitPrice;

$sql3 = "SELECT * FROM CART WHERE CART_ID = $cartId";
$selectFromCart = oci_parse($conn, $sql3);
oci_execute($selectFromCart);
$row = oci_fetch_array($selectFromCart, OCI_ASSOC);

$number_of_productC = $row['NUMBER_OF_PRODUCT'];
$total_priceC = $row['TOTAL_PRICE'];

print_r($row['NUMBER_OF_PRODUCT']);

$updated_number_of_product =  $number_of_productC - $_GET['quantity'];
$updated_total_price = $total_priceC - $totalPrice;

$sql2 = "UPDATE CART  SET NUMBER_OF_PRODUCT = '$updated_number_of_product' , TOTAL_PRICE = '$updated_total_price' WHERE CART_ID = '$cartId'";
$updateOnCart = oci_parse($conn, $sql2);
oci_execute($updateOnCart);


$sql = "DELETE FROM CART_ENTRY WHERE CART_ENTRY_ID = $cartentryId";
$deleteFromCart = oci_parse($conn, $sql);
oci_execute($deleteFromCart);

header("Location:../homepage.php?cartClicked=true");

<?php

$fetchFromF = isset($_GET['fetch']) ? $_GET['fetch'] : "nothing";

$fetchFromC = isset($_GET['category']) ? $_GET['category'] : "nothing";

// exit();

if ($fetchFromF != "nothing") {
    header("Location:../productCategory.php?price=$fetchFromF");
    exit();
}

header("Location:../productCategory.php?category=$fetchFromC");

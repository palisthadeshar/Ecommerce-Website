<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./cart.css">
    <title>Snap Up</title>
</head>

<body>
    <div class="modal fade" id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Your wishlist Cart
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php


                include('./backend/connect.php');
                if (isset($_SESSION['wishlistproduct']) && !isset($_SESSION['cus_id']) && $_SESSION['wishlistproduct'] != '') {
                    $productsinjson = $_SESSION['wishlistproduct'];
                    print_r($productsinjson);
                    $ex = explode('~', $productsinjson);

                    if ($ex == '') {
                        echo "<p style='color:red; text-align:center'> WishList is empty! </p>";
                    } else {
                ?>
                        <div class="modal-body">
                            <table class="table table-image">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($ex as $product => $val) {

                                    $decode = json_decode($val, true);
                                    if ($decode != null) {

                                        foreach ($decode as $key => $val) {
                                            echo "<tr>
                                            <td class='w-25'>
                                                <img src='./image/$val[IMAGE]' class='img-fluid img-thumbnail' alt='productImage'>
                                            </td>
                                            <td>$val[PRODUT_NAME]</td>
                                            <td>'£' . $val[PRICE]</td>
                                            <td>
                                                <a href='./backend/deleteProductWishlist.php?notloggedin=true&&todeleteId=$key' class='btn btn-danger btn-sm'>
                                                    <i class='fa fa-times'></i>
                                                </a>
                                            </td>
                                        </tr>";
                                        }
                                    }
                                }
                            }
                                ?>
                                </tbody>
                            </table>

                        </div>
                        <?php

                    } else if (isset($_SESSION['cus_id'])) {
                        $sql = "SELECT * FROM WISHLIST WHERE USER_ID = $_SESSION[cus_id]";
                        $compiledWishlistId = oci_parse($conn, $sql);
                        $execute = oci_execute($compiledWishlistId);
                        $wishlistInfo = oci_fetch_array($compiledWishlistId, OCI_ASSOC);

                        if ($wishlistInfo == null) {
                            echo "<p style='color:red; text-align:center'> WishList is empty! </p>";
                        } else {
                            $sqlForEmpty = "SELECT * FROM WISHLIST_ENTRY WHERE WISHILIST_ID = $wishlistInfo[WISHILIST_ID]";
                            $compiled = oci_parse($conn, $sqlForEmpty);
                            oci_execute($compiled);
                            $hasValue = oci_fetch_array($compiled, OCI_ASSOC);

                            if ($hasValue == null) {
                                echo "<p style='color:red; text-align:center'> WishList is empty! </p>";
                            } else {


                        ?>
                                <div class="modal-body">
                                    <table class="table table-image">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM WISHLIST_ENTRY WHERE WISHILIST_ID = $wishlistInfo[WISHILIST_ID]";
                                            $compiled = oci_parse($conn, $sql);
                                            oci_execute($compiled);
                                            $status = false;
                                            while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
                                                $status = true;
                                                $sql = "SELECT IMAGE,PRODUT_NAME,PRICE FROM PRODUCT WHERE PRODUCT_ID = $row[PRODUCT_ID]";
                                                $compiledImgName = oci_parse($conn, $sql);
                                                oci_execute($compiledImgName);
                                                $imageName = oci_fetch_array($compiledImgName, OCI_ASSOC);
                                            ?>
                                                <tr>
                                                    <td class="w-25">
                                                        <img src="./image/<?php echo $imageName['IMAGE'] ?>" class="img-fluid img-thumbnail" alt="productImage">
                                                    </td>
                                                    <td><?php echo $imageName['PRODUT_NAME'] ?></td>
                                                    <td><?php echo "£ " . $imageName['PRICE'] ?></td>
                                                    <td>
                                                        <a href="./backend/deleteProductWishlist.php?product_id=<?php echo $row['PRODUCT_ID'] ?>&& wishlist_id=<?php echo $wishlistInfo['WISHILIST_ID'] ?>" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>


                                        </tbody>
                                    </table>

                                </div>
                        <?php
                        }
                    } else {
                        echo "<p style='color:red; text-align:center'> WishList is empty! </p>";
                    }
                        ?>
                        <div class="modal-footer border-top-0 d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>

                        <a href="./backend/deleteProductFromCartOrWishList.php?from=wishlist" type="button" class="btn btn-secondary">Clear all</a>
            </div>
        </div>
    </div>


</body>

</html>


<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="./js/script.js"></script>



<script>
    function showCartModal() {
        $('#cartModal').modal('show');

    }

    // $(document).ready(function() {
    //   const minus = $('.quantity__minus');
    //   const plus = $('.quantity__plus');
    //   const input = $('.quantity__input');
    //   minus.click(function(e) {
    //     e.preventDefault();
    //     var value = input.val();
    //     if (value > 1) {
    //       value--;
    //     }
    //     input.val(value);
    //   });

    //   plus.click(function(e) {
    //     e.preventDefault();
    //     var value = input.val();
    //     value++;
    //     input.val(value);
    //   })
    // });
</script>
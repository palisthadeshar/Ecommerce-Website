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
  <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">
            Your Shopping Cart
          </h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
        include('./backend/connect.php');

        $sql = "SELECT CART_ID,TOTAL_PRICE,NUMBER_OF_PRODUCT FROM CART WHERE USER_ID = $_SESSION[cus_id]";
        $compiledCartId = oci_parse($conn, $sql);
        oci_execute($compiledCartId);
        $cartInfo = oci_fetch_array($compiledCartId, OCI_ASSOC);
        // print_r($cartInfo);
        // exit();
        if (isset($_GET['outOFweight']) && $_GET['outOFweight'] == true) {
          echo "<p style='color:red; text-align:center;'>you cannot store more than 20 items</p>";
        }
        if ($cartInfo == null) {
          echo "<p style='color:red; text-align:center' > Cart is empty! </p>";
        } else if ($cartInfo['NUMBER_OF_PRODUCT'] == 0) {
          echo "<p style='color:red; text-align:center' > Cart is empty! </p>";
        } else {
        ?>
          <div class="modal-body">
            <table class="table table-image">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Total</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM CART_ENTRY WHERE CART_ID= $cartId[CART_ID] ";
                $compiled = oci_parse($conn, $sql);
                oci_execute($compiled);
                $status = false;
                while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
                  $status = true;
                  $sql = "SELECT IMAGE,PRODUT_NAME FROM PRODUCT WHERE PRODUCT_ID = $row[PRODUCT_ID]";
                  $compiledImgName = oci_parse($conn, $sql);
                  oci_execute($compiledImgName);
                  $imageName = oci_fetch_array($compiledImgName, OCI_ASSOC);
                ?>
                  <tr>
                    <td class="w-25">
                      <img src="./image/<?php echo $imageName['IMAGE'] ?>" class="img-fluid img-thumbnail" alt="productImage">
                    </td>
                    <td><?php echo $imageName['PRODUT_NAME'] ?></td>
                    <td><?php echo "£ " . $row['UNIT_PRICE'] ?></td>
                    <td class="qty">
                      <div class="quantity">
                        <a style="margin: 3px ;" href="./backend/cartQuantityManipulation.php?subtract=true&&quantity=<?php echo $row['QUANTITY'] ?>&&product_id=<?php echo $row['PRODUCT_ID'] ?>&&cart_entry_id=<?php echo $row['CART_ENTRY_ID'] ?>"><span>-</span></a>
                        <?php echo $row['QUANTITY'] ?>
                        <a style="margin: 3px ;" href="./backend/cartQuantityManipulation.php?add=true&&quantity=<?php echo $row['QUANTITY'] ?>&&product_id=<?php echo $row['PRODUCT_ID'] ?>"><span>+</span></a>
                      </div>
                    </td>
                    <td><?php echo  "   £      " . $row['UNIT_PRICE'] * $row['QUANTITY']  ?></td>
                    <td>
                      <a href="./backend/deleteProductBack.php?cart_entry_id=<?php echo $row['CART_ENTRY_ID'] ?> &&quantity= <?php echo $row['QUANTITY'] ?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                <?php
                }
                ?>

              </tbody>
            </table>
            <div class="d-flex justify-content-end">
              <h5>Total: <span class="price text-success"><?php echo $cartId['TOTAL_PRICE'] ?></span></h5>
            </div>
          </div>
        <?php
        }
        ?>
        <div class="modal-footer border-top-0 d-flex justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="./backend/deleteProductFromCartOrWishList.php?from=cart" type="button" class="btn btn-secondary">Clear All products</a>
          <?php if ($cartInfo != null && $cartInfo['NUMBER_OF_PRODUCT'] != 0) { ?>
            <a href="./orderDetail.php" type="button" class="btn btn-success">Checkout</a>
          <?php } ?>
        </div>
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

  $(document).ready(function() {
    const minus = $('.minus');
    const plus = $('.plus');
    const input = $('.input');
    minus.click(function(e) {
      e.preventDefault();
      var value = input.val();
      if (value > 1) {
        value--;
      }
      input.val(value);
    });

    plus.click(function(e) {
      e.preventDefault();
      var value = input.val();
      value++;
      input.val(value);
    })
  });
</script>
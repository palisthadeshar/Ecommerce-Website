<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./productDetail.css">


   <title>Snap Up</title>
</head>



<body>
   <?php
   include('nav.php');
   ?>

   <body>
      <p><?php if (isset($_GET['sameproduct'])) {
            echo "<h2 style='color:red;text-align:center;'>This product already exist in your wishlist!</h2>";
         }
         if (isset($_GET['outOFweight']) && $_GET['outOFweight'] == true) {
            echo "<h2 style='color:red; text-align:center;'>you cannot store more than 20 items!</h2>";
         }
         if (isset($_GET['productaddedTowishlist'])) {
            echo "<h2 style='color:red; text-align:center;'>product added to wishlist!</h2>";
         }
         ?></p>
      <div class="container">
         <div class="col-lg-8 border p-3 main-section bg-white">

            <div class="row m-0" style=" display: flex;
  justify-content: center;
  align-items: center;">
               <div class="col-lg-4 left-side-product-box pb-3">
                  <img src="./image/<?php echo $_SESSION['aboutUser']['IMAGE'] ?>" class="border p-3" style="height: 5000%">
               </div>
               <div class="col-lg-8">
                  <div class="right-side-pro-detail border p-3 m-0">
                     <div class="row">
                        <div class="col-lg-12">
                           <h1 class="m-0 p-0"><?php echo $_SESSION['aboutUser']['PRODUT_NAME'] ?></h1>
                        </div>
                        <div class="col-lg-12">
                           <p class="m-0 p-0 price-pro"><?php echo "£" . $_SESSION['aboutUser']['PRICE'] ?></p>
                           <hr class="p-0 m-0">
                        </div>
                        <div class="col-lg-12 pt-2">
                           <h5>Product Detail</h5>
                           <span><?php echo $_SESSION['aboutUser']['DESCRIPTION'] ?></span>
                           <hr class="m-0 pt-2 mt-2">
                        </div>
                        <?php
                        include('./backend/connect.php');
                        $category_id = $_SESSION['aboutUser']['CATEGORY_ID'];
                        $sql = "SELECT CATEGORY_NAME FROM PRODUCT_CATEGORY WHERE CATEGORY_ID = $category_id";
                        $parsing = oci_parse($conn, $sql);
                        $hasreturned = oci_execute($parsing);
                        $row = oci_fetch_array($parsing, OCI_ASSOC);
                        ?>
                        <div class="col-lg-12">
                           <p class="tag-section"><strong>Allergic Information: </strong><?php echo "  " . $_SESSION['aboutUser']['ALERGIC_INFORMATION'] ?></p>
                        </div>
                        <div class="col-lg-12">
                           <p class="tag-section"><strong>Category :</strong><a href="./productCategory.php?category=<?php echo $category_id ?>&&category_name=<?php echo $row['CATEGORY_NAME'] ?>"> <?php echo $row['CATEGORY_NAME'] ?> </a></p>
                        </div>
                        <form action="./backend/addToCartBack.php" method="POST">
                           <div class="col-lg-12" style="display:flex ;">
                              <h6>Quantity :</h6>
                              <div class="quantity ml-5">
                                 <a href="" class="quantity__minus"><span>-</span></a>
                                 <input name="qty" type="text" class="quantity__input" value="1" style="height: 23px;">
                                 <a href="" class="quantity__plus"><span>+</span></a>
                                 <input type="hidden" name="pid" value="<?php echo $_SESSION['aboutUser']['PRODUCT_ID'] ?>">
                                 <input type="hidden" name="price" value="<?php echo $_SESSION['aboutUser']['PRICE'] ?>">
                              </div>
                           </div>
                           <div class="ratings">
                              <?php
                              $pid = $_SESSION['aboutUser']['PRODUCT_ID'];

                              $sql = "SELECT AVG(RATING) FROM REVIEW WHERE PRODUCT_ID =$pid";
                              // echo $sql;
                              $compiled = oci_parse($conn, $sql);
                              oci_execute($compiled);
                              // print_r(oci_fetch_array($compiled));
                              ?>
                              <div class="ml-3">Rating
                                 <p>★★★☆☆</p>
                              </div>

                           </div>
                           <div class="col-lg-12 mt-3">
                              <div class="row">
                                 <div class="col-lg-6 pb-2">
                                    <button type="submit" class="btn btn-danger w-100">Add To Cart</button>
                                 </div>
                                 <div class="col-lg-6">
                                    <a href="./backend/wishListAdd.php?aboutProductId=<?php print_r($_SESSION['aboutUser']['PRODUCT_ID']) ?>" class="btn btn-success">Add to Wishlist</a>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
   <?php
   include('footer.php');
   ?>
</body>

</html>


<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script>
   $(document).ready(function() {
      const minus = $('.quantity__minus');
      const plus = $('.quantity__plus');
      const input = $('.quantity__input');

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
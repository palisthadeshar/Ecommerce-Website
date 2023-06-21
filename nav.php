<?php
if (session_id() == '') {
    session_start();
}
?>


<?php

include('./backend/connect.php');

$countCarts = 0;
if (isset($_SESSION['cus_id'])) {
    $sql = "SELECT CART_ID,TOTAL_PRICE,NUMBER_OF_PRODUCT FROM CART WHERE USER_ID = $_SESSION[cus_id]";
    $compiledCartId = oci_parse($conn, $sql);
    oci_execute($compiledCartId);
    $cartId = oci_fetch_array($compiledCartId, OCI_ASSOC);

    if ($cartId != null) {
        $countCarts = $cartId['NUMBER_OF_PRODUCT'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homePage</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">

    <link rel="stylesheet" href="nav-style.css">
</head>

<body>
    <div class="overlay"></div>



    <nav class="navbar navbar-expand-md navbar  main-menu" style="box-shadow:none">
        <div class="container">

            <button type="button" id="sidebarCollapse" class="btn btn-link d-block d-md-none">
                <i class="bx bx-menu icon-single"></i>
            </button>

            <a class="navbar-brand" href="./homePage.php">
                <img src="./image/logo.png" alt="logo" srcset="">
            </a>

            <ul class="navbar-nav ml-auto d-block d-md-none">
                <li class="nav-item">
                    <a class="btn btn-link" href="#" data-target="#cartModal" data-toggle="modal"><i class="bx bxs-cart icon-single"></i> <span id="numberOfCart" class="badge badge-danger">0</span></a>
                </li>
            </ul>



            <div class="collapse navbar-collapse">
                <form action="./productCategory.php" method="GET" class="form-inline my-2 my-lg-0 mx-auto">
                    <input name="search" class="form-control" type="search" placeholder="Search for products..." aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="bx bx-search"></i></button>
                </form>

                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['cus_id'])) {
                    ?>
                        <li class="nav-item" style="color:white;">
                            <a class="btn btn-link" data-toggle="modal" data-target="#cartModal" onclick="showCartModal()">
                                <i class="bx bxs-cart icon-single"></i>
                                <span class="badge badge-danger" class="mx-auto"><?php echo $countCarts ?> </span>
                            </a>
                        </li>


                    <?php } ?>

                    <li class="nav-item">
                        <a class="btn btn-link" data-toggle="modal" data-target="#wishlistModal"><i class="fas fa-heart"></i></a>
                    </li>

                    <li class="nav-item ml-md-3">
                        <?php
                        $isLoggedInU = isset($_SESSION["name"]);
                        $isLoggedInT = isset($_SESSION["name_t"]);
                        $isLoggedInA = isset($_SESSION['admin']);
                        ?>

                        <a class="btn btn-primary" href="
                        <?php
                        if ($isLoggedInU) {
                            echo "customerProfileUpdate.php";
                        } else if ($isLoggedInT) {
                            echo "./traderProfileUpdate.php";
                        } else if ($isLoggedInA) {
                        } else {
                            echo "Loginpage.php";
                        }
                        ?>"><i class="bx bxs-user-circle mr-1"></i>
                            <?php if ($isLoggedInU) {
                                echo $_SESSION["name"];
                            } else if ($isLoggedInT) {
                                echo $_SESSION["name_t"];
                            } else if ($isLoggedInA) {
                                echo "Admin";
                            } else {
                                echo "login";
                            } ?></a>
                        <?php
                        ?>
                        <a class="btn btn-primary" href="<?php if ($isLoggedInU || $isLoggedInT || $isLoggedInA) {
                                                                echo "./backend/logout.php";
                                                            } else {
                                                                echo './customerRegistration.php';
                                                            } ?>"><i class="bx bxs-user-circle mr-1"></i><?php
                                                                                                            if ($isLoggedInU || $isLoggedInT || $isLoggedInA) {
                                                                                                                echo "Logout";
                                                                                                            } else {
                                                                                                                echo "Register";
                                                                                                            }
                                                                                                            // make logout 
                                                                                                            ?></a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <nav class="navbar navbar-expand-md navbar-dark bg-light sub-menu">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="homepage.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productCategory.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About us</a>
                    </li>

                    <?php
                    if (isset($_SESSION["name_t"])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./addProduct.php">Trader DashBoard</a>
                        </li>
                    <?php
                    }

                    if (isset($_SESSION["admin"])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./pendingRegistration.php">Admin DashBoard</a>
                        </li>

                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Today's Deal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQs</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="search-bar d-block d-md-none">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form class="form-inline mb-3 mx-auto">
                        <input class="form-control" type="search" placeholder="Search for products..." aria-label="Search">
                        <button class="btn btn-success" type="submit"><i class="bx bx-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-10 pl-0">
                        <a class="btn btn-primary" href="loginpage.php"><i class="bx bxs-user-circle mr-1"></i> Log In</a>
                        <a class="btn btn-primary" href="customerRegistration.php"><i class="bx bxs-user-circle mr-1"></i> Register</a>
                    </div>

                    <div class="col-2 text-left">
                        <button type="button" id="sidebarCollapseX" class="btn btn-link">
                            <i class="bx bx-x icon-single"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <ul class="list-unstyled components links">
            <li class="active">
                <a href="homePage.php"> Home</a>
            </li>

            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    Categories</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a class="dropdown-item" href="productCategory.php">Green Grocer</a>
                        <a class="dropdown-item" href="productCategory.php">Bakery</a>
                        <a class="dropdown-item" href="productCategory.php">Butcher</a>
                        <a class="dropdown-item" href="productCategory.php">Delicatessen</a>
                        <a class="dropdown-item" href="productCategory.php">Fishmonger</a>

                    </li>
                </ul>
            </li>

            <li>
                <a href="aboutus.php"> About us</a>
            </li>
            <li>
                <a href="#"> Today's Deal</a>
            </li>
            <li>
                <a href="#"> FAQs</a>
            </li>
        </ul>


        <ul class="social-icons">
            <li><a href="#" target="_blank" title=""><i class="bx bxl-facebook-square"></i></a></li>
            <li><a href="#" target="_blank" title=""><i class="bx bxl-twitter"></i></a></li>
            <li><a href="#" target="_blank" title=""><i class="bx bxl-instagram"></i></a></li>
        </ul>

    </nav>

</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"></script>

<script>
    $(document).ready(function() {
        $("#sidebarCollapse").on("click", function() {
            $("#sidebar").addClass("active");
        });

        $("#sidebarCollapseX").on("click", function() {
            $("#sidebar").removeClass("active");
        });

        $("#sidebarCollapse").on("click", function() {
            if ($("#sidebar").hasClass("active")) {
                $(".overlay").addClass("visible");
                console.log("it's working!");
            }
        });

        $("#sidebarCollapseX").on("click", function() {
            $(".overlay").removeClass("visible");
        });
    });
</script>



<?php
include('cart.php');
include('wishlist.php');
?>
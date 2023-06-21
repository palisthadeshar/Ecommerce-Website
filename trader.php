<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap Up</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">

    <link rel="stylesheet" href="./nav-style.css">
    <link rel="stylesheet" href="./trader.css">


</head>


<body>


    <div class="overlay"></div>



    <nav class="navbar navbar-expand-md navbar  main-menu" style="box-shadow:none">
        <div class="container">

            <button type="button" id="sidebarCollapse" class="btn btn-link d-block d-md-none">
                <i class="bx bx-menu icon-single"></i>
            </button>

            <a class="navbar-brand" href="homePage.php">
                <img src="./image/logo.png" alt="logo" srcset="">
            </a>
            <li class="nav-item ">
                <a class="btn btn-primary" href="customerRegistration.php"><i class="bx bxs-user-circle mr-1"></i> <?php if (isset($_SESSION["name_t"])) {
                                                                                                                        echo $_SESSION["name_t"];
                                                                                                                    } else {
                                                                                                                        echo "Login";
                                                                                                                    } ?></a>
            </li>
            </ul>
        </div>

        </div>
    </nav>





    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar-trader" style="height:500px; width:250px;">

            <div class="col-lg-3 form">

                <img src="#">
                <p><?php echo $_SESSION['name_t'] ?></p>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Report</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">My Shop</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <?php
                        include('./backend/connect.php');
                        $sql = "SELECT SHOP_ID,SHOP_NAME FROM SHOP WHERE USER_ID = $_SESSION[tra_id] AND VERIFIED = 'yes'";
                        $compiled = oci_parse($conn, $sql);
                        oci_execute($compiled);
                        while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
                        ?>
                            <li>
                                <a href="traderProducts.php?shop_id=<?php echo $row['SHOP_ID'] ?>"><?php echo $row['SHOP_NAME'] ?></a>
                            </li>

                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="addProduct.php">Add Product</a>

                </li>
                <li>
                    <a href="addShop.php">Add New Shop</a>

                </li>
                <li>
                    <a href="./updateShop.php">Update Shop</a>
                </li>

            </ul>



        </nav>








        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-10 pl-0">
                            <img src="#">
                            <p>Trader Name</p>

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
                <li>
                    <a href="#"> Dashboard</a>
                </li>

                <li>
                    <a href="traderProduct.php"> Shop 1</a>
                </li>
                <li>
                    <a href="traderProduct.php"> Shop 2</a>
                </li>

                <li>
                    <a href="#"> Report</a>
                </li>
                <li>
                    <a href="addProduct.php">Add Product</a>
                </li>
                <li>
                    <a href="addShop.php"> Add New Shop</a>
                </li>
            </ul>


            <!-- <ul class="social-icons">
            <li><a href="#" target="_blank" title=""><i class="bx bxl-facebook-square"></i></a></li>
            <li><a href="#" target="_blank" title=""><i class="bx bxl-twitter"></i></a></li>
            <li><a href="#" target="_blank" title=""><i class="bx bxl-instagram"></i></a></li>
        </ul> -->

        </nav>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</body>

</html>



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

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar-trader').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>
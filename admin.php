<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snap Up</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">

    <link rel="stylesheet" href="nav-style.css">
    <link rel="stylesheet" href="trader.css">


</head>

<body>
    <div class="overlay"></div>



    <nav class="navbar navbar-expand-md navbar  main-menu" style="box-shadow:none">
        <div class="container">

            <button type="button" id="sidebarCollapse" class="btn btn-link d-block d-md-none">
                <i class="bx bx-menu icon-single"></i>
            </button>

            <a class="navbar-brand" href="#">

                <img src="./image/logo.png" alt="logo" srcset="">
            </a>
            <li class="nav-item ">
                <a class="btn btn-primary" href="customerRegistration.php"><i class="bx bxs-user-circle mr-1"></i>Admin</a>
            </li>
            </ul>
        </div>

        </div>
    </nav>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar-trader" style="height:500px; width:250px;">

            <div class="col-lg-3 form">

                <img style="height: 40px; width:40px" src="./image/anmol.png">
                <p>Admin</p>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#">Dashboard</a>
                </li>

                <li>
                    <a href="pendingRegistration.php">Pending Shop Regsitration</a>
                </li>
                <li>
                    <a href="pendingPayment.php">Pending Payment</a>

                </li>
                <li>
                    <a href="./suspendShop.php">Suspend Shop</a>
                </li>
                <li>
                    <a href="#">Generate Report</a>

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
                            <p>Admin Name</p>

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
                    <a href="#">Generate Report</a>
                </li>
                <li>
                    <a href="pendingPayment.php">Pending Payment</a>
                </li>
                <li>
                    <a href="pendingRegistration.php">Pending Regsitration</a>
                </li>
            </ul>
        </nav>





        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>



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


        <script type="text/javascript">
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar-trader').toggleClass('active');
                    $(this).toggleClass('active');
                });
            });
        </script>



</body>

</html>
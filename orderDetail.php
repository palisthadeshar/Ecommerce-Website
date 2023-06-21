<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">
    <link rel="stylesheet" href="./orderDetail.css">
    <title>Snap Up</title>
</head>

<body>
    <?php
    include('nav.php');

    if (isset($_GET['invoicestatus']) && $_GET['invoicestatus'] == true) {
        echo "<p style='color:red;text-align:center;'>Invoice sucessfully sent!</p>";
    }
    ?>


    <div class=" container-fluid my-5 ">
        <div class="row justify-content-center ">
            <div class="col-xl-10">
                <div class="card shadow-lg ">

                    <div class="row  mx-auto justify-content-center text-center">
                        <div class="col-12 mt-3 ">
                            <nav aria-label="breadcrumb" class="second ">
                                <ol class="breadcrumb indigo lighten-6 first  ">
                                    <li class="breadcrumb-item font-weight-bold "><a class="black-text text-uppercase " href="productCategory.php"><span class="mr-md-3 mr-1">BACK TO SHOP</span></a><i class="fa fa-angle-double-right " aria-hidden="true"></i></li>
                                    <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" data-toggle="modal" data-target="#wishlistModal" href=""><span class="mr-md-3 mr-1">SHOPPING BAG</span></a><i class="fa fa-angle-double-right text-uppercase " aria-hidden="true"></i></li>
                                    <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase active-2" href="orderDetail.php"><span class="mr-md-3 mr-1">CHECKOUT</span></a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row justify-content-around">
                        <div class="col-md-4">
                            <div class="card border-0">
                                <div class="card-header pb-0">
                                    <h2 class="card-title space ">Checkout</h2>

                                    <hr class="my-0">
                                </div>
                                <div class="card-body">

                                    <div class="row mb-md-5">

                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-sm-7 pr-sm-2">

                                            <form>
                                                <label for="slot">Select Collection slot:</label><br>

                                                <select name="slot" id="slots" onchange=updateSlot(this.value)>
                                                    <option selected disabled>choose a day</option>
                                                    <!-- <option value="wednesday">Wednesday</option>
                                                    <option value="thrusday">Thrusday</option>
                                                    <option value="friday">Friday</option> -->
                                                </select>
                                            </form>
                                            <script>
                                                var todayDate = new Date();
                                                var dayAfter24hours = new Date(new Date(todayDate).getTime() + 60 * 60 * 24 * 1000);
                                                const daysinweek = ["monday", "tuesday", "wednesday", "thrusday", "friday", "saturday", "sunday"];
                                                const availableSlotsDay = ["wednesday", "thrusday", "friday"];
                                                const availabeSlotsTime = ["10-13", "13-16", "16-19"];

                                                const month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                                                let dayslot = dayAfter24hours.getDay() - 1;
                                                let time = dayAfter24hours.getHours();
                                                let year = dayAfter24hours.getFullYear();
                                                let day = todayDate;
                                                let availableSlotsForAfterDay;

                                                console.log(time + "<----time");

                                                const totalslots = new Map();
                                                console.log("dayslot" + dayslot);
                                                if (dayslot == 2 || dayslot == 3 || dayslot == 4) {
                                                    if (time > 16) {
                                                        day = new Date(new Date(dayAfter24hours).getTime() + 60 * 60 * 24 * 1000);
                                                        availableSlotsForAfterDay = ["10-13", "13-16", "16-19"];
                                                    } else if (time < 16) {
                                                        if (time < 10) {
                                                            availableSlotsForAfterDay = ["10-13", "13-16", "16-19"];
                                                        } else if (time < 13) {
                                                            availableSlotsForAfterDay = ["13-16", "16-19"];
                                                        } else if (time < 16) {
                                                            availableSlotsForAfterDay = ["16-19"];
                                                        }
                                                    }
                                                    if (daysinweek[day.getDay()] == "wednesday" || daysinweek[day.getDay()] == "thrusday" || daysinweek[day.getDay()] == "friday") {
                                                        totalslots.set(daysinweek[day.getDay()], availableSlotsForAfterDay);
                                                    }
                                                }


                                                console.log(totalslots);
                                                count = 1;
                                                while (count < 14) {
                                                    day = new Date(new Date(day).getTime() + 60 * 60 * 24 * 1000);
                                                    let dayLit = day;
                                                    if (dayLit.getDay() == 3) {

                                                        document.getElementById("slots").innerHTML = document.getElementById("slots").innerHTML + "<option value=" + daysinweek[dayLit.getDay() - 1] + ">" + daysinweek[dayLit.getDay() - 1] + " - " + dayLit.getDate() + "th" + month[dayLit.getMonth()] + " - " + dayLit.getFullYear()
                                                        "</option>";

                                                    } else if (dayLit.getDay() == 4) {
                                                        console.log(dayLit);
                                                        document.getElementById("slots").innerHTML = document.getElementById("slots").innerHTML + "<option value=" + daysinweek[dayLit.getDay() - 1] + ">" + daysinweek[dayLit.getDay() - 1] + " - " + dayLit.getDate() + "th  " + month[dayLit.getMonth()] + " - " + dayLit.getFullYear() + "</option>";

                                                    } else if (dayLit.getDay() == 5) {
                                                        console.log(dayLit);
                                                        document.getElementById("slots").innerHTML = document.getElementById("slots").innerHTML + "<option value=" + daysinweek[dayLit.getDay() - 1] + ">" + daysinweek[dayLit.getDay() - 1] + " - " + dayLit.getDate() + "th  " + month[dayLit.getMonth()] + " - " + dayLit.getFullYear() + "</option>";

                                                    }
                                                    count++;

                                                }
                                            </script>

                                        </div>
                                        <script>
                                            function updateSlot(val) {

                                                document.getElementById("slot").innerHTML = "";

                                                let dayChoose = totalslots.get(val);
                                                // console.log(dayChoose);
                                                if (dayChoose != null) {
                                                    for (let i = 0; i < dayChoose.length; i++) {
                                                        document.getElementById("slot").innerHTML = document.getElementById("slot").innerHTML + "<option value=" + dayChoose[i] + ">" + dayChoose[i] + "</option>";
                                                    }
                                                } else {
                                                    document.getElementById("slot").innerHTML = document.getElementById("slot").innerHTML + "<option value=" + "10-13" + ">" + "10-13" + "</option>";
                                                    document.getElementById("slot").innerHTML = document.getElementById("slot").innerHTML + "<option value=" + "13-16" + ">" + "13-16" + "</option>";
                                                    document.getElementById("slot").innerHTML = document.getElementById("slot").innerHTML + "<option value=" + "16-19" + ">" + "16-19" + "</option>";
                                                }
                                            }
                                        </script>
                                        <div class="col-sm-7"><br>

                                            <label for="time">Select time:</label><br>
                                            <select name="slot" id="slot">
                                                <option selected disabled>Choose time</option>
                                            </select>
                                            </form>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card border-0 ">
                                <div class="card-header card-2">
                                    <p class="card-text text-muted mt-md-4  mb-2 space">YOUR ORDER </p>
                                    <hr class="my-2">
                                </div>


                                <div class="card-body pt-3">
                                    <div class="row  justify-content-between">
                                        <div class="col-auto col-md-7">
                                            <div class="media flex-column flex-sm-row">
                                                <b>ORDER NAME</b>
                                                <div class="media-body  my-auto">
                                                    <div class="row ">
                                                        <div class="col-auto">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" pl-0 flex-sm-col col-auto  my-auto">
                                            <B class=""><?php echo "QUANTITY" ?></B>
                                        </div>
                                        <div class=" pl-0 flex-sm-col col-auto  my-auto ">
                                            <p><b><?php echo "PRICE" ?></b></p>
                                        </div>
                                    </div>
                                </div>




                                <?php
                                include('./backend/connect.php');

                                $cartSql = "SELECT CART_ID FROM CART WHERE USER_ID = $_SESSION[cus_id] ";

                                $fireSql = oci_parse($conn, $cartSql);
                                oci_execute($fireSql);

                                $cartInfo = oci_fetch_array($fireSql, OCI_ASSOC);

                                $sql = "SELECT * FROM CART_ENTRY WHERE CART_ID = $cartInfo[CART_ID]";
                                $compiled = oci_parse($conn, $sql);
                                oci_execute($compiled);

                                $arr = array("");


                                while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
                                    $sql2 = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $row[PRODUCT_ID]";

                                    $compile = oci_parse($conn, $sql2);
                                    oci_execute($compile);
                                    $product_name = oci_fetch_array($compile, OCI_ASSOC);
                                    array_push($arr, $product_name);
                                ?>
                                    <div class="card-body pt-0">
                                        <div class="row  justify-content-between">
                                            <div class="col-auto col-md-7">
                                                <div class="media flex-column flex-sm-row">
                                                    <img class=" img-fluid" src="./image/<?php echo $product_name['IMAGE'] ?>" width="70px" height="70px">
                                                    <div class="media-body  my-auto">
                                                        <div class="row ">
                                                            <div class="col-auto">
                                                                <p class="mb-0 ml-3"><b><?php echo $product_name['PRODUT_NAME'] ?></b>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" pl-0 flex-sm-col col-auto  my-auto">
                                                <p class="boxed-1"><?php echo $row['QUANTITY'] ?></p>
                                            </div>
                                            <div class=" pl-0 flex-sm-col col-auto  my-auto ">
                                                <p><b><?php echo $row['UNIT_PRICE'] ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                                <?php
                                $sql = "SELECT TOTAL_PRICE from CART WHERE USER_ID = $_SESSION[cus_id]";
                                $compiled = oci_parse($conn, $sql);
                                oci_execute($compiled);
                                $total_price = oci_fetch_array($compiled, OCI_ASSOC);
                                ?>

                                <!-- bill -->
                                <hr class="my-2">
                                <div class="row ">
                                    <div class="col">
                                        <?php
                                        $sql = "SELECT * FROM OFFER";
                                        $compiled = oci_parse($conn, $sql);
                                        oci_execute($compiled);

                                        $date = date('d-m-y');

                                        $today = explode('-', $date);
                                        $discount = 0;
                                        $totalPayment = $total_price['TOTAL_PRICE'];
                                        while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
                                            $datetime = DateTime::createFromFormat('j-M-y', $row['STARTING_DATE']);
                                            $datetime_dmy = $datetime->format('d/m/Y');
                                            $dates = explode('/', $datetime_dmy);

                                            if ($dates[0] == $today[0] && $dates[1] == $today[1] && str_contains($dates[2], $today[2])) {
                                                $discount = $row['DISCOUNT'];
                                            }

                                            if ($discount != 0) {
                                                $totalPayment = $total_price['TOTAL_PRICE'] - (($discount / 100) * $total_price['TOTAL_PRICE']);
                                            }
                                        }
                                        ?>
                                        <div class="row justify-content-between">
                                            <div class="col">
                                                <p class="mb-1"><b>Discount</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b><?php if ($discount != 0) {
                                                                        echo $discount . '%';
                                                                    } else {
                                                                        // $discount = 0;
                                                                        echo "no discount available";
                                                                    } ?> </b></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <p><b>Total</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b>£ <?php if (isset($discount)) {
                                                                            echo $totalPayment;
                                                                        } else {
                                                                            echo $totalPayment = $total_price['TOTAL_PRICE'];
                                                                        } ?></b></p>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                    </div>
                                </div>

                                <div class="row mb-5 mt-3 ">
                                    <div id="paypal-payment-button" class="mx-auto mt-1">
                                        <?php
                                        $_SESSION['products'] = $arr;
                                        ?>
                                    </div>
                                    <a href="./backend/orderPaymentBack.php?paid=false&&discount=<?php echo $discount; ?>" class="col-md-7 col-lg-6 mx-auto"><button type="button" class="btn btn-block btn-outline-primary btn-lg">Confirm Order</button></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>


</body>

</html>


<script src="https://www.paypal.com/sdk/js?client-id=AZW5IagwgbjPBIuJV22OMgIuYL3NRz_0wLWZ6YcqpA4YFpglz7nLbLEqR-FCSqV3iz8iSTMYhMI6s7xI&disable-funding=credit,card"></script>
<script>
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: "pill"
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $totalPayment; ?>
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details);
                window.location.replace('http://localhost:80/project_management/backend/orderPaymentBack.php?total=<?php echo $totalPayment ?>&&paid=true')
            })
        },
        oncancel: function(data) {
            window.location.replace('http://localhost:80/project_management/backend/orderPaymentBack.php?paid=false')
        }
        // 6ZN_o/^I paypal password


    }).render('#paypal-payment-button');
</script>
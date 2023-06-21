<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">
    <link rel="stylesheet" href="./trader.css">
    <link rel="stylesheet" href="./admin.css">
    <title>Snap Up</title>
</head>

<body>
    <?php
    include('./backend/connect.php');
    include('admin.php');
    ?>


    <?php

    $sql = "SELECT * FROM SHOP";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    ?>

    <div class="col-lg-5 mt-5" style="padding-left: 20px;">
        <?php
        while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {

        ?>
            <ul class="list-group ">
                <li class="list-group-item ">
                    <p><?php echo "Shop name     :" . $row['SHOP_NAME'] ?></p>
                    <p><?php echo "Address     :" . $row['SHOP_ADDRESS'] ?></p>
                    <p><?php echo "Contact number     :" . $row['CONTACT_NUMBER'] ?></p>
                    <p><?php echo "Shop registration date     :" . $row['REGISTRATION_DATE'] ?></p>
                    <p>Category</p>

                    <div class="btn">
                        <?php if (isset($row['VERIFIED']) && $row['VERIFIED'] == 'yes') { ?>
                            <a href="./backend/shopSuspendBack.php?activate=false&&shopid=<?php echo $row['SHOP_ID'] ?>"> <button type="button" class="btn btn-danger">Suspend</button></a>
                        <?php } ?>
                        <?php if (isset($row['VERIFIED']) && $row['VERIFIED'] == 'sus') { ?>
                            <a href="./backend/shopSuspendBack.php?activate=true&&shopid=<?php echo $row['SHOP_ID'] ?>"> <button type="button" class="btn btn-success">Activate</button> </a>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        <?php } ?>
    </div>
</body>

</html>
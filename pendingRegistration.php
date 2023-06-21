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

    $sql = "SELECT * FROM SHOP WHERE VERIFIED IS NULL";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    $status = true;
    ?>

    <div class="col-lg-5 mt-5" style="padding-left: 20px;">
        <?php
        while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {
            $status = false;
        ?>
            <ul class="list-group ">
                <li class="list-group-item ">
                    <p><?php echo $row['SHOP_NAME'] ?></p>
                    <p><?php echo $row['SHOP_ADDRESS'] ?></p>
                    <p><?php echo $row['CONTACT_NUMBER'] ?></p>
                    <p><?php echo $row['REGISTRATION_DATE'] ?></p>
                    <p>Category</p>
                    <div class="btn">
                        <a href="./backend/shopapprovedenyBack.php?approve=true&&shopid=<?php echo $row['SHOP_ID'] ?>"> <button type="button" class="btn btn-success">Approve</button> </a>
                    </div>
                    <div class="btn">
                        <a href="./backend/shopapprovedenyBack.php?approve=false&&shopid=<?php echo $row['SHOP_ID'] ?>"> <button type="button" class="btn btn-danger">Deny</button></a>
                    </div>
                </li>
            </ul>
        <?php } ?>
    </div>

    <?php
    if ($status) {
        echo "<p style='font-size:30px;'>Do not have any pending request.</p>";
    }
    ?>
</body>

</html>
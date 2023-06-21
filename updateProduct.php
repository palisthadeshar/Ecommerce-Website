<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">
    <link rel="stylesheet" href="./trader.css">
    <title>Snap Up</title>
</head>

<body>
    <?php
    include('trader.php');
    ?>
    <div class="form col-lg-10">
        <form name="addProduct" enctype="multipart/form-data" action="./backend/addProductBack.php?update=true&&pro_id=<?php echo $_SESSION['aboutUser']['PRODUCT_ID'] ?>" method='POST' action='#' style="width: 50%;">
            <fieldset>

                <h2>Update new product</h2>
                <div class="input_field">
                    <label for="pname">Product Name: </label>
                    <input type="text" name="pname" value="<?php echo $_SESSION['aboutUser']['PRODUT_NAME']  ?>"><br>
                    <div id="product_error">
                        <?php
                        if (isset($_SESSION["product_repeat_p"]) && $_SESSION["product_repeat_p"] == "repeatitive") {
                        ?><p style="color: red;"><?php echo "product is already entered" ?></p><?php
                                                                                            }
                                                                                                ?>
                    </div>
                </div>

                <div class="input_field">
                    <label for="price">Price: </label>
                    <input type="text" name="price" value="<?php echo $_SESSION['aboutUser']['PRICE'] ?>"><br>
                    <div id="price_error">

                    </div>
                </div>

                <div class="input_field">
                    <label for="desc">Description: </label>
                    <input type="text" name="description" value="<?php echo $_SESSION['aboutUser']['DESCRIPTION'] ?>"><br>
                    <div id="description_error">
                    </div>
                </div>

                <div class="input_field">
                    <label for="shop">Shop:</label>
                    <?php
                    $status = false;
                    // inorder to get shops
                    include('./backend/connect.php');

                    if (isset($_SESSION["tra_id"])) {
                        $tra_id = $_SESSION["tra_id"];
                        $sql = "SELECT SHOP_ID, SHOP_NAME FROM SHOP WHERE USER_ID = '$tra_id'";
                        $parsing = oci_parse($conn, $sql);
                        $hasreturned = oci_execute($parsing);
                        $product_id = $_SESSION["aboutUser"]["PRODUCT_ID"];
                        $sql2 = "SELECT SHOP_ID FROM PRODUCT WHERE PRODUCT_ID =  product_id";
                        $compiled = oci_parse($conn, $sql2);
                        oci_execute($compiled);
                        $shop_id = oci_fetch_array($compiled);
                    }
                    ?>
                    <?php
                    if ($hasreturned == 1) {
                    ?>
                        <select name='shop' for="shop">:
                            <?php
                            while ($row = oci_fetch_array($parsing, OCI_ASSOC)) {
                                $status = true;
                            ?> <option value='<?php echo $row["SHOP_ID"] ?>' <?php if ($shop_id['SHOP_ID'] == $row['SHOP_ID']) {
                                                                                    echo "selected";
                                                                                } ?>name='shop'><?php echo $row["SHOP_NAME"] ?> </option>
                            <?php
                            }
                            ?>
                        </select>

                        <div id="shop_error"></div>
                    <?php
                    }
                    if (!$status) {
                        echo "<p style='color:red'>please create a shop in order to add product!</p>";
                    }
                    ?>
                </div>

                <div class="input_field">
                    <label for="Availability">Availability: </label>
                    <select name='available' for="avalilable">Category:
                        <option value="choose category" name="available" selected disabled>Choose Category</option>
                        <option value='1' name="available" <?php if ($_SESSION['aboutUser']['AVAILABILITY'] == 1) {
                                                                echo "selected";
                                                            } ?>>yes</option>

                        <option value='0' name="available" <?php if ($_SESSION['aboutUser']['AVAILABILITY'] == 0) {
                                                                echo "selected";
                                                            } ?>>no</option>
                    </select>
                    <div id="availibility_error"></div>
                </div>

                <div class="input_field">
                    <label for="quantity">Quantity: </label>
                    <input type="text" name="quantity" value="<?php echo $_SESSION['aboutUser']['QUANTITY'] ?>"><br>
                    <div id="quantity_error"></div>
                </div>

                <div class="input_field">
                    <label for="">Allergic Information: </label>
                    <input type="text" name="aller_information" value="<?php echo $_SESSION['aboutUser']['ALERGIC_INFORMATION'] ?>"><br>
                    <div id="allergic_information_error"></div>
                </div>

                <div class="input_field">
                    <label for="filename">Upload Image: </label>
                    <input type="file" name="image"><br>
                    <div id="imageUploadError"></div>
                </div>

                <div class="input_field">
                    <?php
                    $category_id = $_SESSION['aboutUser']['CATEGORY_ID'];
                    $sql = "SELECT CATEGORY_NAME FROM PRODUCT_CATEGORY WHERE CATEGORY_ID = $category_id";
                    $compiled = oci_parse($conn, $sql);
                    oci_execute($compiled);
                    $category_name = oci_fetch_array($compiled);
                    ?>

                    <label for="filename">Your category name: </label>
                    <input type="text" name="category_name" value="<?php echo $category_name['CATEGORY_NAME'] ?>">
                    <div id="category_error"><?php
                                                if (isset($_GET['category_consist']) && $_GET['category_consist'] == true) {
                                                    echo "<p style='color:red'>This category consisit</p>";
                                                }
                                                ?></div>
                </div>
                <div id="categoryerror">

                </div>

                <div class="btn">
                    <input type="button" value="UPDATE PRODUCT" onclick="validate()">
                </div>

            </fieldset>
        </form>
    </div>
</body>

</html>

<script>
    function validate() {
        let product_error = document.getElementById("product_error");
        let product_name = document.forms["addProduct"]["pname"].value;

        if (product_name == "") {
            product_error.innerHTML = "please enter product name";
            product_error.style.color = "red";
            return false;
        } else if (product_name.length < 5) {
            product_error.innerHTML = "please enter product name must be greater than 5 characters";
            product_error.style.color = "red";
            return false;
        } else if (product_name.length > 18) {
            product_error.innerHTML = "please enter product name must be less than 18 characters";
            product_error.style.color = "red";
            return false;
        } else {
            product_error.innerHTML = "";
        }


        let price_error = document.getElementById("price_error");
        let price = document.forms["addProduct"]["price"].value;
        if (price == "") {
            price_error.innerHTML = "please enter price";
            price_error.style.color = "red";
            return false;
        }
        if (isNaN(price)) {
            price_error.innerHTML = "price must be integer";
            price_error.style.color = "red";
            return false;
        } else {
            price_error.innerHTML = "";
        }


        let description_error = document.getElementById("description_error");
        let description = document.forms["addProduct"]["description"].value;

        // return false;
        if (description == "") {
            description_error.innerHTML = "please enter description name";
            description_error.style.color = "red";
            return false;
        } else if (description.length < 5) {
            description_error.innerHTML = "please enter description more than 5 characters";
            description_error.style.color = "red";
            return false;
        } else if (description.length > 498) {
            description_error.innerHTML = "please enter description less than 498 characters";
            description_error.style.color = "red";
            return false;
        } else {
            description_error.innerHTML = "";
        }
        console.log(description);

        let availibility_error = document.getElementById("availibility_error");
        let availibility = document.forms["addProduct"]["available"].value;

        if (availibility != 0 && availibility != 1) {
            availibility_error.innerHTML = "please select yes or no";
            availibility_error.style.color = "red";
            return false;
        } else {
            availibility_error.innerHTML = "";
        }


        let quantity_error = document.getElementById("quantity_error");
        let quantity = document.forms["addProduct"]["quantity"].value;

        if (quantity == "") {
            quantity_error.innerHTML = "please type something!";
            quantity_error.style.color = "red";
            return false;
        } else if (isNaN(quantity)) {
            quantity_error.innerHTML = "please type numeric!";
            quantity_error.style.color = "red";
            return false;
        } else if (quantity < 0) {
            quantity_error.innerHTML = "please give quantity more than 1";
            quantity_error.style.color = "red";
            return false;
        } else {
            quantity_error.innerHTML = "";
        }

        let allergic_information_error = document.getElementById("allergic_information_error");
        let allergic_info = document.forms["addProduct"]["aller_information"].value;
        if (allergic_info == "") {
            allergic_information_error.innerHTML = "please enter allergic information";
            allergic_information_error.style.color = "red";
            return false;
        } else if (allergic_info.length < 5) {
            allergic_information_error.innerHTML = "please enter allergic information more than 5 characters ";
            allergic_information_error.style.color = "red";
            return false;
        } else if (allergic_info.length > 298) {
            allergic_information_error.innerHTML = "please enter allergic information less than 298 characters ";
            allergic_information_error.style.color = "red";
            return false;
        } else {
            allergic_information_error.innerHTML = "";
        }

        let imageUploadError = document.getElementById("imageUploadError");
        let imageUpload = document.forms["addProduct"]["image"].value;
        // console.log(imageUpload + "hello");
        if (imageUpload == "") {
            imageUploadError.innerHTML = "please select a picture in order to update";
            imageUploadError.style.color = "red";
            return false;
        } else if (!imageUpload.includes(".JPG") && !imageUpload.includes(".PNG") && !imageUpload.includes(".jpg") && !imageUpload.includes(".png")) {
            imageUploadError.style.color = "red";
            imageUploadError.innerHTML = "we support png and jpg format only";
            imageUploadError.style.color = "red";
            return false;
        } else {
            imageUploadError.innerHTML = "";
        }

        let category_error = document.getElementById("category_error");
        let category = document.forms["addProduct"]["category_name"].value;

        if (category == "") {
            category_error.innerHTML = "please type something!";
            category_error.style.color = "red";
            return false;
        } else if (category.length < 3) {
            category_error.innerHTML = "category name must be greater than 3 characters";
            category_error.style.color = "red";
            return false;
        } else {
            category_error.innerHTML = "";
        }

        let shop_error = document.getElementById("shop_error");
        let shop_name = document.forms["addProduct"]["shop"].value;

        if (shop_name == "select a shop") {
            shop_error.innerHTML = "please select shop";
            shop_error.style.color = "red";
            return false;
        } else {
            shop_error.innerHTML = "";
        }
        document.addProduct.submit();

    }
</script>
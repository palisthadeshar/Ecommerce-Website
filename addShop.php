<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">
    <link rel="stylesheet" href="./trader.css">
    <title>Snap Up</title>
</head>

<body>
    <?php
    include('trader.php');
    ?>
    <div class="form col-lg-9">
        <form method='POST' action='./backend/addShopBack.php' name="addShop" style="width: 50%;">
            <fieldset>
                <?php
                if (isset($_GET['not_more_than_two_shop']) && $_GET['not_more_than_two_shop'] == true) {
                    echo "<p style ='color:red; font-size:2em'>cannot add more than 2 shop</p>";
                }

                if (isset($_GET['added']) && $_GET['added'] == true) {
                    echo "<p style ='font-size:3em'>shop added</p>";
                }
                ?>
                <h2>Add New Shop</h2>
                <div class="input_field">
                    <label for="shop">Shop Name:</label>
                    <input type="text" name="shop_name">
                    <div id="shopname_error">
                        <?php
                        if (isset($_SESSION["shop_name_repeat"]) && $_SESSION["shop_name_repeat"] == "repeatitive") {
                        ?> <p style="color:red;"> This shop name is already taken</p><?php
                                                                                    }
                                                                                        ?>
                    </div>
                </div>
                <div class="input_field">
                    <label for="shop_address">shop address:</label>
                    <input type="text" name="address">
                    <div id="error_shopaddr"></div>
                </div>

                <div class="input_field">
                    <label for="shopContact_number">contact number:</label>
                    <input type="text" name="contact_number">
                    <div id="error_shopContact">
                        <?php
                        if (isset($_SESSION["contact_repeat_s"]) && $_SESSION["contact_repeat_s"] == "repeatitive") {
                        ?><p style="color:red ;"><?php echo "This phone number is already entered" ?></p>
                        <?php }
                        ?>
                    </div>
                </div>


                <div class="btn">
                    <input type="button" value="Add shop" onclick="validate()">
                </div>
            </fieldset>
        </form>
    </div>
</body>

</html>

<script>
    function validate() {
        console.log("hey");
        let error_pname = document.getElementById("shopname_error");
        let pname = document.forms["addShop"]["shop_name"].value;

        console.log(pname);
        if (pname == "") {
            error_pname.innerHTML = "Please enter something";
            error_pname.style.color = "red";

            return false;
        } else {
            error_pname.innerHTML = "";
        }


        let error_shopaddr = document.getElementById("error_shopaddr");
        let address = document.forms["addShop"]["address"].value;


        if (address == "") {
            error_shopaddr.innerHTML = "enter something";
            error_shopaddr.style.color = "red";
            return false;
        } else if (address.length < 3) {
            error_shopaddr.innerHTML = "please enter shop address";
            error_shopaddr.style.color = "red";
            return false;
        } else {
            error_shopaddr.innerHTML = "";
        }

        let error_shopContact = document.getElementById("error_shopContact");
        let contact = document.forms["addShop"]["contact_number"].value;

        if (contact == "") {
            error_shopContact.innerHTML = "please enter a number";
            error_shopContact.style.color = "red";
            return false;
        } else if (contact.length != 10) {
            error_shopContact.innerHTML = "please enter valid number";
            error_shopContact.style.color = "red";
            return false;
        } else {
            error_shopContact.innerHTML = "";
        }


        document.addShop.submit();
    }
</script>
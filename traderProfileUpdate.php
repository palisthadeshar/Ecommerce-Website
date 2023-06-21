<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./registration.css">
    <title>Snap Up</title>
</head>

<body>
    <?php
    include('nav.php');
    ?>
    <!-- navbar ends here -->

    <!-- form starts here -->

    <?php
    include('./backend/connect.php');
    $sql = "SELECT * FROM USER_TABLE WHERE USER_ID= $_SESSION[tra_id]";
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);
    $traderInfo = oci_fetch_array($compiled, OCI_ASSOC);

    ?>
    <div class="form row">
        <?php if (isset($_GET['profileupdated']) && $_GET['profileupdated'] == true) {
            echo "<p style='color:red; text-align:center;'>profile updated</p>";
        }
        if (isset($_GET['checkemail']) && $_GET['checkemail'] == true) {
            echo "<p style='color:red; text-align:center;'>please verify email to update your data</p>";
        }
        ?>
        <div class="col-4">
            <h3>Be a part of our <span>team.</span>
                <br><span>Update </span> Trader
            </h3>
            <div id="error_message"></div>
            <form name="traderRegister" action="./backend/sendmail.php?updateprofileT=true" method="post">
                <div class="input_field">
                    <label>Company Name*</label><br>
                    <input type="text" id="name" name="comp_name" value="<?php echo $traderInfo['USERNAME'] ?>">
                    <div id="comp_error">
                        <?php
                        if (isset($_SESSION['repeat_username_t']) && $_SESSION['repeat_username_t'] == "repeatitive") {
                            echo "This username is occupied!!";
                        }
                        ?>
                    </div>
                </div>
                <?php
                $datetime     = DateTime::createFromFormat('j-M-y', $traderInfo['REGISTRATION_DATE']);
                $datetime_dmy = $datetime->format('d/m/Y');
                $date = explode('/', $datetime_dmy);
                ?>
                <label>Registration Date*</label><br>
                <div class="input_field">
                    <input type="date" id="subject" name="reg_date" value=<?php echo $date[2] . '-' . $date[1] . '-' . $date[0] ?>>
                    <div id="reg_error"></div>
                </div>
                <label>Category</label><br>
                <div class="input_field">
                    <input type="text" name="category" value="<?php echo $traderInfo['TRADER_CATEGORY'] ?>">
                    <div id="category_error"></div>
                </div>

                <label>Email Address*</label><br>
                <div class="input_field">
                    <input type="email" id="phone" name="email" value="<?php echo $traderInfo['EMAIL'] ?>">
                    <div id="email_error">
                        <?php
                        if (isset($_SESSION['repeat_email_t']) && $_SESSION['repeat_email_t']  == "repeatitive") {
                            echo "This email is already entered!";
                        } ?>
                    </div>
                </div>
                <label>Phone Number*</label><br>
                <div class="input_field">
                    <input type="text" id="subject" name="ph_number" value="<?php echo $traderInfo['PHONE_NUMBER'] ?>">
                    <div id="phone_error">
                        <?php
                        if (isset($_SESSION['repeat_phone_number_t']) && $_SESSION['repeat_phone_number_t'] == "repeatitive") {
                            echo "This phone number is already entered!";
                        }
                        ?>
                    </div>
                </div>

                <label>Address*</label><br>
                <div class="input_field">
                    <input type="text" id="subject" name="address" value="<?php echo $traderInfo['USER_ADDRESS'] ?>">
                    <div id="address_error"></div>
                </div>
                <div class="btn">
                    <input type="button" value="Update Profile" onclick="validate()">
                </div>
            </form>
        </div>
    </div>
    <!-- footer -->
    <?php
    include('footer.php');
    ?>
</body>

</html>



<script>
    let status = false;

    function validate() {
        //validation begins here
        let compname = document.forms["traderRegister"]["comp_name"].value;
        let errorComname = document.getElementById("comp_error");

        if (compname == "") {
            errorComname.innerHTML = "please enter compay name";
            errorComname.style.color = "red";
            return false;
        } else if (compname.length < 5) {
            errorComname.innerHTML = "please enter company name with more than 5 characters";
            errorComname.style.color = "red";
            return false;
        } else if (compname.length > 28) {
            errorUsername.innerHTML = "please enter company name not greater than 28 characters";
            errorUsername.style.color = "red";
            return false;
        } else {
            errorComname.innerHTML = "";
        }

        var today = new Date();
        let regDate = document.forms["traderRegister"]["reg_date"].value;

        //trader date validation--->
        let errorRegDate = document.getElementById("reg_error");

        if (regDate == "") {
            errorRegDate.innerHTML = "please enter date";
            errorRegDate.style.color = "red";
            return false;
        }
        regDate = new Date(regDate);
        var CurrentDate = new Date();


        if (regDate > CurrentDate) {
            errorRegDate.innerHTML = "please enter valid date!";
            errorRegDate.style.color = "red";
            return false;
        } else {
            errorRegDate.innerHTML = "";
        }

        let categoryerror = document.getElementById("category_error");
        let category = document.forms["traderRegister"]["category"].value;
        // console.log(category);

        if (category == "") {
            categoryerror.innerHTML = "please enter someting";
            categoryerror.style.color = 'red';
            return false;
        } else if (category.length < 3) {
            categoryerror.innerHTML = "category must be greater than 3 characters";
            categoryerror.style.color = 'red';
            return false;
        } else if (category.length > 30) {
            categoryerror.innerHTML = "category must be less than 30 characters";
            categoryerror.style.color = 'red';
        } else {
            categoryerror.innerHTML = "";
        }

        // console.log(errorRegDate);

        // //email validation--->
        let errorEmail = document.getElementById("email_error");
        let email = document.forms["traderRegister"]["email"].value;

        if (email == "") {
            errorEmail.innerHTML = "Please Enter something in email";
            errorEmail.style.color = "red";
            return false;
        } else if (email.indexOf("@") == -1 || email.length < 6 || email.length > 30) {
            errorEmail.innerHTML = "Please Enter valid Email";
            errorEmail.style.color = "red";
            return false;
        } else {
            errorEmail.innerHTML = "";
        }

        // //phone validation--->
        let errorPhone = document.getElementById("phone_error");
        let phone = document.forms["traderRegister"]["ph_number"].value;
        console.log(errorPhone);
        console.log(phone);
        if (phone == "") {
            errorPhone.innerHTML = "Please Enter a Phone Number";
            errorPhone.style.color = "red";
            return false;
        } else if (isNaN(phone) || phone.length != 10) {
            errorPhone.innerHTML = "Please Enter valid Phone Number ";
            errorPhone.style.color = "red";
            return false;
        } else {
            errorPhone.innerHTML = "";
        }

        let errorAddress = document.getElementById("address_error");
        let address = document.forms["traderRegister"]["address"].value;

        if (address == "") {
            errorAddress.innerHTML = "please enter a valid address";
            errorAddress.style.color = "red";
            return false;
        } else if (address.length < 5) {
            errorAddress.innerHTML = "please enter address greater than 5 characters";
            errorAddress.style.color = "red";
            return false;
        } else if (address.length > 30) {
            errorAddress.innerHTML = "please enter address greater than 30 characters";
            errorAddress.style.color = "red";
            return false;
        } else {
            errorAddress.innerHTML = "";
        }


        document.traderRegister.submit();

    }
</script>
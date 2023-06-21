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
    $sql = "SELECT * FROM USER_TABLE WHERE USER_ID = $_SESSION[cus_id]";

    $parsing = oci_parse($conn, $sql);

    $execute = oci_execute($parsing);

    $row = oci_fetch_array($parsing, OCI_ASSOC);

    ?>

    <div class="form row">
        <?php if (isset($_GET['profileupdated']) && $_GET['profileupdated'] == true) {
            echo "<p style='color:red; text-align:center;'>profile updated</p>";
        }
        if (isset($_GET['checkemail']) && $_GET['checkemail'] == true) {
            echo "<p style='color:red; text-align:center;'>please verify email to update your data</p>";
        }
        ?>
        <div class="col-lg-3 col-md-4">
            <h3>Update profile.</h3>
            <form name="myForm" action="./backend/sendmail.php?updateprofile=true" method="post">
                <div class="input_field">
                    <label>User name*</label><br>
                    <input type="text" id="name" name="username" value="<?php echo $row['USERNAME'] ?>">
                    <div id="name_error">
                        <?php
                        if (isset($_SESSION['repeat_username']) && $_SESSION['repeat_username'] == "repeatitive") {
                            echo "This username is occupied!!";
                        }
                        ?>
                    </div>
                </div>

                <div class="input_field">
                    <label>First Name*</label><br>
                    <input type="text" id="name" name="fname" value="<?php echo $row['FIRST_NAME'] ?>">
                    <div id="username_error"></div>
                </div>
                <div class="input_field">
                    <label>Last Name*</label><br>
                    <input type="text" id="name" name="lname" value="<?php echo $row['LAST_NAME'] ?>">
                    <div id="lastname_error"></div>
                </div>
                <label>Email Address*</label><br>
                <div class="input_field">
                    <input type="email" placeholder="Email address" id="" name="email" value="<?php echo $row['EMAIL'] ?>">
                    <div id="email_error"><?php if (isset($_SESSION['repeat_email']) && $_SESSION['repeat_email']  == "repeatitive") {
                                                echo "This email is already entered!";
                                            } ?></div>
                </div>
                <label>Phone Number*</label><br>
                <div class="input_field">
                    <input type="text" placeholder="Phone" id="subject" name="phone" value="<?php echo $row['PHONE_NUMBER'] ?>">
                    <div id="phone_error">
                        <?php
                        if (isset($_SESSION['repeat_phone_number']) && $_SESSION['repeat_phone_number'] == "repeatitive") {
                            echo "This phone number is already entered!";
                        }
                        ?>
                    </div>
                </div>
                <label>Date of Birth*
                    <?php
                    $datetime     = DateTime::createFromFormat('j-M-y', $row['DOB']);
                    $datetime_dmy = $datetime->format('d/m/Y');
                    $date = explode('/', $datetime_dmy);
                    ?></label><br>

                <div class="input_field">
                    <input type="date" id="subject" name="dob" id='myDate' value=<?php echo $date[2] . '-' . $date[1] . '-' . $date[0] ?>>
                    <div id="dob_error">
                    </div>
                </div>
                <label>Gender*</label><br>
                <div class="radio">
                    <input type="radio" name="gender" value="male" <?php if ($row['GENDER'] == 'male') {
                                                                        echo "checked";
                                                                    } ?> /> Male &nbsp;&nbsp;
                    <input type="radio" name="gender" value="female" <?php if ($row['GENDER'] == 'female') {
                                                                            echo "checked";
                                                                        } ?> /> Female &nbsp;&nbsp;
                    <input type="radio" name="gender" value="Other" <?php if ($row['GENDER'] == 'Other') {
                                                                        echo "checked";
                                                                    } ?> /> Other &nbsp;&nbsp;
                </div>
                <div id="gender_error"></div>
                <br>
                <label>Address*</label><br>
                <div class="input_field">
                    <input type="text" id="subject" name="address" value="<?php echo $row['USER_ADDRESS'] ?>">
                    <div id="address_error"></div>
                </div>

                <div id="password_error"></div>

                <div class="btn">
                    <button type="button" onclick="validateForm()">update profile</button>
                </div>
            </form>
            <h3>Do you want to register as <a href="traderRegistration.php"><span>Trader?</span></a></h3>
        </div>
    </div>
    <!-- footer -->
    <?php
    include('footer.php');
    ?>
    <!-- js
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js">
</script>
 icon -->
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->



</body>

</html>

<script>
    function validateForm() {
        //validation begins here


        let username = document.forms["myForm"]["username"].value;
        let errorUsername = document.getElementById("name_error");

        if (username.length < 5) {
            errorUsername.innerHTML = "please enter valid username having at least 5 characters";
            errorUsername.style.color = "red";
            return false;
        } else if (username.length > 28) {
            errorUsername.innerHTML = "please enter valid username not greater than 28 characters";
            errorUsername.style.color = "red";
            return false;
        } else {
            errorUsername.innerHTML = "";
        }

        let firstname = document.forms["myForm"]["fname"].value;

        //user name validation--->
        let errorFirstname = document.getElementById("username_error");

        if (firstname.length < 5) {
            errorFirstname.innerHTML = "please enter first name greater than 5 characters";
            errorFirstname.style.color = "red";
            return false;
        } else if (firstname.length > 15) {
            errorFirstname.innerHTML = "please enter first name less than 15 characters";
            errorFirstname.style.color = "red";
            return false;
        } else {
            errorFirstname.innerHTML = "";
        }

        //last name validation--->
        let errorLastName = document.getElementById("lastname_error");
        let lastName = document.forms["myForm"]["lname"].value;

        if (lastName.length < 5) {
            errorLastName.innerHTML = "please enter last name greater than 5 characters";
            errorLastName.style.color = "red";
            return false;
        } else if (lastName.length > 20) {
            errorFirstname.innerHTML = "please enter first name less than 15 characters";
            errorFirstname.style.color = "red";
            return false;
        } else {
            errorLastName.innerHTML = "";
        }

        //email validation--->
        let errorEmail = document.getElementById("email_error");
        let email = document.forms["myForm"]["email"].value;

        if (email.indexOf("@") == -1 || email.length < 6) {
            errorEmail.innerHTML = "Please Enter including @ and at least 6 character long";
            errorEmail.style.color = "red";
            return false;
        } else {
            errorEmail.innerHTML = "";
        }

        //phone validation--->
        let errorPhone = document.getElementById("phone_error");
        let phone = document.forms["myForm"]["phone"].value;

        if (isNaN(phone) || phone.length != 10) {
            errorPhone.innerHTML = "Please Enter valid Phone Number";
            errorPhone.style.color = "red";
            return false;
        } else {
            errorPhone.innerHTML = "";
        }

        // should watch this again..
        let errorDob = document.getElementById("dob_error");
        let dobinp = document.forms["myForm"]["dob"].value;
        if (dobinp == '') {
            errorDob.innerHTML = "please select some date!";
            errorDob.style.color = "red";
            return false;
        }
        let splitdob = dobinp.split("-");
        console.log(splitdob);
        var dob = new Date(splitdob[1] + "/" + splitdob[2] + "/" + splitdob[0]);
        //calculate month difference from current date in time
        var month_diff = Date.now() - dob.getTime();

        //convert the calculated difference in date format
        var age_dt = new Date(month_diff);

        //extract year from date
        var year = age_dt.getUTCFullYear();

        //now calculate the age of the user
        var age = Math.abs(year - 1970);

        //display the calculated age
        if (age <= 18) {
            errorDob.innerHTML = "sorry! you are just " + age + " year old";
            errorDob.style.color = "red";
            return false;
        } else {
            errorDob.innerHTML = "";
        }


        let error_gender = document.getElementById("gender_error");
        const genderButtons = document.forms["myForm"]["gender"].value;

        if (genderButtons == "") {
            error_gender.innerHTML = "please select gender options";
            error_gender.style.color = "red";
            return false;
        } else {
            error_gender.innerHTML = "";
        }


        let errorAddress = document.getElementById("address_error");
        let address = document.forms["myForm"]["address"].value;

        if (address.length < 5) { // more validation required includes doesnot work!!
            errorAddress.innerHTML = "please enter valid address more than 5 characters";
            errorAddress.style.color = "red";
            return false;
        } else if (address.length > 28) {
            errorAddress.innerHTML = "please enter valid address less than 28 characters";
            errorAddress.style.color = "red";
            return false;
        } else {
            errorAddress.innerHTML = "";
        }



        //gender


        document.myForm.submit();
    }
</script>
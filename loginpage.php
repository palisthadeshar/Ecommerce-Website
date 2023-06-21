<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./loginpage.css">

    <title>Snap Up</title>
</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['cus_id']) && $_SESSION['cus_id']) {
        header("Location:./homepage.php");
        exit();
    }
    include('nav.php');
    ?>



    <!-- navbar ends here -->

    <!-- login form starts here -->
    <div class="login-form">
        <!-- <div class="image">
        <img src="image/loginpage.png" alt="loginpage image">
    </div> -->

        <div class="form">
            <h3><b>Login To Your Account</b></h3>
            <div id="usernotfound"><?php
                                    if (isset($_GET["verified"]) && $_GET["verified"] == 'failed') {
                                        echo "<p style='color:red'>Please verify your email address</p>";
                                    }
                                    if (isset($_GET["notLogin"]) && $_GET["notLogin"] == "error") {
                                        echo "<p style='color:red'>please login as a user in order to add to cart!</p>";
                                    }

                                    if (isset($_GET['reset']) && $_GET['reset'] = 'sucess') {

                                        echo "<p style='color:red'>password reset sucessfully!</p>";
                                    }
                                    if (isset($_SESSION["user"]) && $_SESSION["user"] == "not a user") { // todo

                                        echo "<p style='color:red'>user name and password does not match!</p>";
                                        unset($_SESSION["user"]);
                                    }

                                    ?></div>
            <div class="form-area">
                <?php
                //for action
                $action = "./backend/loginPageBack.php";

                if (isset($_GET["notLogin"]) && $_GET["notLogin"] == "error") {
                    $action = "./backend/loginPageBack.php?redirect=productCategory.php";
                }
                ?>
                <form name="loginForm" action="<?php echo $action ?>" method="post">
                    <label for="fname">Username:</label><br>
                    <input type="text" id="name" name="name">
                    <hr><br>
                    <div id="username_error"></div>
                    <label for="lname">Password:</label><br>
                    <input type="password" id="password" name="password">
                    <hr><br>
                    <div id="password_error"></div>
                    <input type="checkbox" onclick="myFunction()"> Show Password
                    <br>
                    <br>
                    <input type="button" value="Login" onclick="validateLogin()">
                </form> <br>
                <p><b><a href="./passwordReset.php">Reset Password?</a></b></p>
                <p><b><a href="./forgotPassword.php">Forgot Password?</a></b></p>
                <p><b><a href="./customerRegistration.php">Create New Account</a></b></p>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php
    include('footer.php');
    ?>
</body>

</html>


<script>
    //js goes here...
    function validateLogin() {
        let userName = document.forms["loginForm"]["name"].value;
        let user_error = document.getElementById("username_error");
        if (userName.length < 5) {
            user_error.innerHTML = "please enter valid username";
            user_error.style.color = "red";
            return false;
        } else {
            user_error.innerHTML = "";
        }

        let password = document.forms["loginForm"]["password"].value;
        let password_error = document.getElementById("password_error");

        if (password.length < 4) {
            password_error.innerHTML = "please enter valid password";
            password_error.style.color = "red";
            // return false;
        } else {
            password_error.innerHTML = "";
        }
        document.loginForm.submit();
    }

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    var input = document.getElementById("password");

    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click

            document.loginForm.submit();

        }
    });
</script>
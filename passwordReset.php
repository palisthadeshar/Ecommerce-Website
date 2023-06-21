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
  <!-- form -->
  <div class="form row pt-5">
    <div class="col-3">

      <?php

      if (isset($_GET['resetSucess']) && $_GET['resetSucess'] == true) {

        echo "<p style='color:red;'>Password reset sucessfull</p>";
      }
      ?>
      <h3>Reset Your <span>Password.</span></h3>
      <?php
      if (isset($_GET['password']) && $_GET['password'] == 'failed') {
        echo "<p style='color:red;'>username or password doesnot match</p>";
      }
      ?>
      <form id="myForm" name="myForm" action="./backend/passwordResetBack.php" method='POST'>
        <label>Username*</label>
        <div class="input_field">
          <input type="text" id="username" name="username">
          <div id="username-error">
            <?php
            if (isset($_GET['username']) && $_GET['username'] == 'failed') {
              echo "<p style='color:red;'>Please enter valid username!!</p>";
            }
            ?>
          </div>
        </div>

        <label>Current password*</label>
        <div class="input_field">
          <input type="password" id="password" name="currentPass">

          <div id="current_password_error">

          </div>
        </div>


        <label>New Password*</label><br>
        <div class="input_field">
          <input type="password" id="password" name="pass">
        </div>

        <div id="password_error"></div>

        <label>Confirm Password*</label><br>
        <div class="input_field">
          <input type="password" id="password" name="confirmPass">
        </div>
        <div id="confirmpass_error"></div>

        <div class="btn">
          <input type="button" value="Reset Password" onclick="validate()">
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
  function validate() {

    let error_username = document.getElementById("username-error");
    let username = document.forms["myForm"]["username"].value;

    if (username == '') {
      error_username.innerHTML = "Please enter something";
      error_username.style.color = 'red';
      return false;
    } else if (username.length < 5) {
      error_username.innerHTML = "Username must be greater than 5 characters";
      error_username.style.color = 'red';
      return false;
    }

    //current password
    let error_current_password = document.getElementById("current_password_error");

    let current_password = document.forms["myForm"]["currentPass"].value;

    if (current_password === '') {
      error_current_password.innerHTML = "Please enter something";
      error_current_password.style.color = "red";
      return false;
    } else if (current_password.length < 4) {
      error_current_password.innerHTML = "Password must be greater than 5 character";
      error_current_password.style.color = "red";
      return false;
    }

    let error_password = document.getElementById("password_error");
    let password = document.forms["myForm"]["pass"].value;
    let confirmPass = document.forms["myForm"]["confirmPass"].value;
    let confirmPass_error = document.getElementById("confirmpass_error");

    if (password === '') {
      error_password.innerHTML = "please enter something";
      error_password.style.color = "red";
      return false;
    } else if (password.length < 5) {
      error_password.innerHTML = "please enter password greater than 5 character";
      error_password.style.color = "red";
      return false;
    } else if (confirmPass === '') {
      confirmPass_error.innerHTML = "please enter something";
      confirPass_error.style.color = "red";
      return false;
    } else if (password != confirmPass) {
      error_password.innerHTML = "please enter correct password";
      error_password.style.color = "red";
      return false;
    } else {
      error_password.innerHTML = "";
      confirmPass_error.innerHTML = "";
    }
    document.myForm.submit();
  }
</script>
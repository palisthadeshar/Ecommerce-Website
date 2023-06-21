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
<div class="form">
    <h3>Edit Your <span>Profile</span> Details</h3>
  <div id="error_message"></div>
  <form id="myform">
    <div class="input_field">
        <label>First Name*</label><br>
        <input type="text"  id="name">
    </div>
    <div class="input_field">
        <label>Last Name*</label><br>
        <input type="text" id="name">
    </div>
   
    <label>Email Address*</label><br>
    <div class="input_field">
        <input type="email"  id="phone">
    </div>
    <label>Phone Number*</label><br>
    <div class="input_field">
        <input type="text"  id="subject">
    </div>
    <label>Date of Birth*</label><br>
    <div class="input_field">
        <input type="date"  id="subject">
    </div>
    <label>Gender*</label><br>
    <div class="radio">
    <input type="radio" name="gender"/> Male &nbsp;&nbsp;
    <input type="radio" name="gender"/> Female &nbsp;&nbsp;
    <input type="radio" name="gender"/> Other  &nbsp;&nbsp;
  </div>
   <br>
    <label>Address*</label><br>
    <div class="input_field">
        <input type="text"  id="subject">
    </div>
    
    
    <div class="btn">
        <input type="submit" value="Update Profile" >
    </div>
  </form>
</div>
<!-- footer -->
<?php 
include('footer.php');
?>
</body>
</html>

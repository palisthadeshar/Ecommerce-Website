<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./loginpage.css">
    <link rel="stylesheet" type="text/css" href="registration.css">
    <title>Snap Up</title>
</head>
  <body>
   <?php
    include('nav.php');
    ?> 
    <!-- form starts here -->
<div class="form">
    <br>
    <h3>Contact Us</h3>
  <div id="error_message"></div>
  <form id="myform">
    <div class="input_field">
        <label>First Name</label><br>
        <input type="text"  id="name">
    </div>
    <div class="input_field">
        <label>Last Name</label><br>
        <input type="text" id="name">
    </div>
   
    <label>Email Address</label><br>
    <div class="input_field">
        <input type="email" placeholder="Phone" id="phone">
    </div>
    <label>Phone Number</label><br>
    <div class="input_field">
        <input type="text"  id="subject">
    </div>
    <label>Address</label><br>
    <div class="input_field">
        <input type="text"  id="subject">
    </div>
    <label>What can we help you with?</label><br>
    <div class="input_field">
        
        <select name="category">
        <option selected>Select an option</option>   
  <option value="order">Order Staus</option>
  <option value="promo">Invalid Promo Code</option>
  <option value="payment">Payment</option>
  <option value="return">Return</option>
  <option value="other">Other</option>
</select>
    </div>
    <label>Message</label><br>
    <div class="input_field">
       <textarea name="comment" form="usrform">Enter your query here...</textarea>
    </div>
    <div class="btn">
        <input type="submit" value="Submit" >
    </div>
  </form>
</div>
<!-- footer -->
<?php
    include('footer.php');
    ?>

 
  </body>
</html>
<?php
session_start();

header("Location:./invoicePage.php?total=$_GET[total]&&paid=true");

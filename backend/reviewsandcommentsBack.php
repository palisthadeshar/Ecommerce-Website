<?php
$to = "$_GET[email]";

$from = "kanmol21@tbc.edu.np";
$fromName = "anmol";

$subject = "Review and comments ";

$htmlContent = "
<h1>Did you receive the product? please reivew the product</h1>
<a href='https://localhost/project_management/backend/verifyemailBack.php?email=$to'>chick here to review</a>
";


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers 
$headers .= "From: " . $fromName . "<" . $from . ">" . "\r\n";
// $headers .= "Cc: welcome@example.com" . "\r\n"; 
// $headers .= "Bcc: welcome2@example.com" . "\r\n"; 

// Send email 
if (mail($to, $subject, $htmlContent, $headers)) {
    header("Location:../customerRegistration.php?verify=true");
} else {
    echo "Email sending failed.";
}

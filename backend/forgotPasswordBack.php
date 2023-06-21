<?php
include('connect.php');

$sql = "SELECT 1 FROM USER_TABLE WHERE USERNAME= '$_POST[username]' AND EMAIL = '$_POST[email]'";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);

if (oci_fetch_array($compiled, OCI_ASSOC) == null) {
    header('Location:../forgotPassword.php?user_email=failed');
    exit();
}

$to = $_POST['email'];
$from = "kanmol21@tbc.edu.np";
$fromName = "anmol";

$subject = "reset your password";

$htmlContent = "
<h1>Reset your password</h1>
<a href='https://localhost/project_management/backend/passwordResetBack.php?username=" . $_POST['username'] . "&&pass=" . $_POST['pass'] . "&&email=" . $_POST['email'] . "'>Reset your Password</a>";

// Set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
$headers .= "From: " . $fromName . "<" . $from . ">" . "\r\n"; // $headers .="Cc: welcome@example.com" . "\r\n" ; // $headers .="Bcc: welcome2@example.com" . "\r\n" ; // Send email if (mail($to, $subject, $htmlContent, $headers)) { echo "Email has sent successfully." ; } else { echo "Email sending failed." ; }

if (mail($to, $subject, $htmlContent, $headers)) {
    echo "Email has sent successfully.";
} else {
    echo "Email sending failed.";
}

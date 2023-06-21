<?php
include('connect.php');
session_start();
if ($_GET['updateprofile'] == true || $_GET['updateprofileT'] == true) {
    if (isset($_GET['updateprofileT']) && $_GET['updateprofileT'] == true) {
        $sql = "SELECT EMAIL FROM USER_TABLE WHERE USER_ID=$_SESSION[tra_id]";
        echo $sql;
    } else if (isset($_GET['updateprofile']) && $_GET['updateprofile'] == true) {
        $sql = "SELECT EMAIL FROM USER_TABLE WHERE USER_ID=$_SESSION[cus_id]";
    }
    $compiled = oci_parse($conn, $sql);
    oci_execute($compiled);

    $row = oci_fetch_array($compiled, OCI_ASSOC);

    $to = "$row[EMAIL]";

    $from = "kanmol21@tbc.edu.np";
    $fromName = "anmol";

    $subject = "snapup profile update email";

    $encode = json_encode($_POST);

    if (isset($_GET['updateprofileT']) && $_GET['updateprofileT'] == true) {
        $htmlContent = "
        <h1>update profile</h1>
        <a href='https://localhost/project_management/backend/updateTraderRegisterBack.php?updateProfile=$encode&&id=$_SESSION[tra_id]'>update profile</a>";
    } else if (isset($_GET['updateprofile']) && $_GET['updateprofile'] == true) {
        $htmlContent = "
        <h1>update profile</h1>
        <a href='https://localhost/project_management/backend/updatecustomerRegisterBack.php?updateProfile=$encode&&id=$_SESSION[cus_id]'>update profile</a>";
    }

    // Set content-type header for sending HTML email 
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers 
    $headers .= "From: " . $fromName . "<" . $from . ">" . "\r\n";
    // $headers .= "Cc: welcome@example.com" . "\r\n"; 
    // $headers .= "Bcc: welcome2@example.com" . "\r\n"; 

    // Send email 
    if (mail($to, $subject, $htmlContent, $headers)) {
        if (isset($_GET['updateprofileT']) && $_GET['updateprofileT'] == true) {
            header("Location:../traderProfileUpdate.php?checkemail=true");
        } else if (isset($_GET['updateprofile']) && $_GET['updateprofile'] == true) {
            header("Location:../CustomerProfileUpdate.php?checkemail=true");
        }
    } else {
        echo "Email sending failed.";
    }
} else {
    $to = "$_GET[email]";

    $from = "kanmol21@tbc.edu.np";
    $fromName = "anmol";

    $subject = "snapup verify email";

    $htmlContent = "

    <!doctype html>
<html lang='en-US'>

<head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <title>Snapup</title>

    <style type='text/css'>
        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #f2f3f8;' leftmargin='0'>
    <!-- 100% body table -->
    <table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#f2f3f8'
        style='@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;'>
        <tr>
            <td>
                <table style='background-color: #f2f3f8; max-width:670px; margin:0 auto;' width='100%' border='0'
                    align='center' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td style='height:80px;'>&nbsp;</td>
                    </tr>
                    <tr>
                      
                    </tr>
                    <tr>
                        <td style='height:20px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'
                                style='max-width:670px; background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
                                <tr>
                                    <td style='height:40px;'>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style='padding:0 35px;'>
                                        <h1
                                            style='color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>
                                            Verify Your Email Address
                                        </h1>
                                        <p style='font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;'>
                                            Thanks for registering for an account on Snapup. Before we create your
                                            account, we just need to confirm that this is your. Click below to verify
                                            your email address.</strong>.</p>
                                        <span
                                            style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span>
                                        <p
                                            style='color:#455056; font-size:18px;line-height:20px; margin:0; font-weight: 500;'>

                                        </p>

                                        <a href='https://localhost/project_management/backend/verifyemailBack.php?email=$to'
                                            style='background:olivedrab;text-decoration:none !important; display:inline-block; font-weight:500; margin-top:24px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;'>Verify
                                            Your Email</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='height:40px;'>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='height:20px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style='text-align:center;'>
                            <p
                                style='font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;'>
                                &copy; <strong>snapup2022</strong> </p>
                        </td>
                    </tr>
                    <tr>
                        <td style='height:80px;'>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>
</html>
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
}

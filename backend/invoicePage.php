<?php
include('connect.php');
session_start();

$products = $_SESSION['products'];
$totalAmount = $_GET['total'];

echo $totalAmount;
$InvoiceId = rand(10, 100) - 21 + 32 + rand(10, 100);

// print_r($products);
$item = "";
foreach ($_SESSION['products'] as $key => $value) {
    if ($value != null) {
        $product_Name = $value['PRODUT_NAME'];
        $price = $value['PRICE'];


        $items = "<tr class='item'>
        <td> £  " . $product_Name . "</td>

        <td> £  " . $price . "</td>

    </tr>";

        $item = $item . $items;
    }
}


//INSERT INTO ORDER
// $sql = "INSERT INTO ORDER_TABLE ()"

$fromName = "anmol";

$subject = "Snapup invoice";

$htmlContent = "
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <title>Snapup</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: white;
            background-color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {

            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class='invoice-box'>
        <table cellpadding='0' cellspacing='0'>
            <tr class='top'>
                <td colspan='2'>
                    <table>
                        <tr>

                            <td>
                                Invoice #:" . $InvoiceId . " <br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class='information'>
                <td colspan='2'>
                    <table>
                        <tr>
                            <td>
                                Address: Biratnagar-madumara<br />
                                Name: Anmol<br>
                                Email: kanmol21@tbc.edu.np<br>
                                Payment Method: Paypal

                            </td>


                        </tr>
                    </table>
                </td>
            </tr>




            <tr class='heading'>
                <td>Item</td>

                <td>Price</td>
            </tr>

            " . $item . "

            <tr class='total'>
                <td></td>

                <td>Total: £" . $totalAmount . "</td>
            </tr>
        </table>
    </div>
    <h3 style='text-align:center;'>Thanks For Shopping!</h3>

</body>

</html>";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers 


$sql = "SELECT EMAIL FROM USER_TABLE WHERE USER_ID=$_SESSION[cus_id]";
$compiled = oci_parse($conn, $sql);
oci_execute($compiled);
$user_info = oci_fetch_array($compiled, OCI_ASSOC);

$to = $user_info['EMAIL'];
$from = "kanmol21@tbc.edu.np";
$fromName = "anmol";

// Send email 
if (mail($to, $subject, $htmlContent, $headers)) {
    //order ma insert
    // if (isset($_GET['paid']) && $_GET['paid'] == 'true') {
    //     foreach ($_SESSION['products'] as $key => $value) {
    //         // $sql = "INSERT INTO ORDER_DETAIL (DISCOUNT, UNIT_PRICE, QUANTITY, ORDER_ID, PRODUCT_ID) VALUES($_GET[DISCOUNT], $value[PRICE], 0, )";
    //     }
    // } else {
    //     echo "Unfortunately payment has been cancelled!";
    // }
echo 'mail sent';

    // header("Location:./deleteProductFromCartOrWishList.php?from=cart&&invoicestatus=true");
} else {
    echo "Email sending failed.";
}
?>
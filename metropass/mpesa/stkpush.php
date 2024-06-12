<?php
// Include the access token generation script
include 'accessToken.php';
// Include the database connection script
require_once '../includes/dbconnection.php';

// Set the default timezone
date_default_timezone_set('Africa/Nairobi');

// M-PESA STK Push endpoint for sandbox environment
$processrequestUrl = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
// Callback URL for receiving M-PESA transaction status (ensure this is publicly accessible in production)
$callbackurl = "http://your-live-site.com/metropass/mpesa/callback.php";

// M-PESA credentials
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode = "174379";
$TimeStamp = date('YmdHis');
$password = base64_encode($BusinessShortCode . $passkey . $TimeStamp);

// Form handling
if (isset($_POST['submit'])) {
    $phone_Number = $_POST['phone']; 
    $newPhone = ltrim($phone_Number, '0');
    $phone = '254' . $newPhone; // Customer phone number in international format
    $money = $_POST['amount']; // Amount to be paid

    // Parameters for the STK Push request
    $partyA = $phone; // Customer phone number
    $partyB = $BusinessShortCode; // M-PESA business shortcode
    $AccountReference = "METROPASS"; // Account reference
    $TransactionDesc = "stk push test"; // Description of the transaction
    $amount = $money; // Transaction amount

    // Generate the access token
    $access_token = generateAccessToken();
    if ($access_token === null) {
        die("Error: Unable to generate access token.");
    }

    // Set the request headers
    $stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

    // Prepare the request data
    $curl_post_data = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $password,
        'Timestamp' => $TimeStamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $amount,
        'PartyA' => $partyA,
        'PartyB' => $partyB,
        'PhoneNumber' => $phone,
        'CallBackURL' => $callbackurl,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    );

    // Initialize cURL
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); // Set the headers
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($curl_post_data)); // Set the request payload

    // Execute the cURL request
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        die("Curl error: " . curl_error($curl));
    }

    // Close the cURL session
    curl_close($curl);

    // Decode the API response
    $data = json_decode($curl_response);
    if ($data === null) {
        die("Error: Invalid response from M-PESA API.");
    }

    // Handle the API response
    if (isset($data->CheckoutRequestID)) {
        $CheckoutRequestID = $data->CheckoutRequestID;
        $ResponseCode = $data->ResponseCode;

        if ($ResponseCode == "0") {
            // Insert the CheckoutRequestID into the database
            $sql = "INSERT INTO mpesa (CheckoutRequestID) VALUES (?)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$CheckoutRequestID]);

            // Redirect the user to a processing page
            header("Location: ../index.php?transaction=processing");
            exit();
        } else {
            // Handle transaction initiation error
            echo "Error in transaction initiation: " . $data->errorMessage;
        }
    } else {
        // Handle invalid response
        echo "Error: Invalid response from M-PESA API.";
    }
} else {
    // Form not submitted
    echo "Error: Form not submitted.";
}
?>

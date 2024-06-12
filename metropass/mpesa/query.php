<?php

include 'accessToken.php';

date_default_timezone_set('Africa/Nairobi');

// Variables (ensure you have these set with your actual credentials)
$BusinessShortCode = '174379';
$passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$CheckoutRequestID = ''; // Replace with the actual checkout request ID from the STK push response

// Generate the timestamp and password
$timestamp = date('YmdHis');
$password = base64_encode($BusinessShortCode . $passkey . $timestamp);

// Get the access token
$access_token = generateAccessToken();

$query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
$queryHeader = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token
];

// Prepare the request data
$curl_post_data = [
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'CheckoutRequestID' => $CheckoutRequestID
];

$data_string = json_encode($curl_post_data);

// Initiate the transaction
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $query_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $queryHeader);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
curl_close($curl);

$data_to = json_decode($curl_response);

if (isset($data_to->ResultCode)) {
    $resultCode = $data_to->ResultCode;
    switch ($resultCode) {
        case '1037':
            $message = "Timeout in completing transaction";
            break;
        case '1032':
            $message = "Transaction has been cancelled by user";
            break;
        case '1':
            $message = "The balance is insufficient for the transaction";
            break;
        case '0':
            $message = "Transaction is successful";
            break;
        default:
            $message = "Unknown error occurred";
            break;
    }
    echo $message;
} else {
    echo "Error: " . (isset($data_to->errorMessage) ? $data_to->errorMessage : 'Unknown error');
}
?>

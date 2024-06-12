<?php
require_once '../includes/dbconnection.php';


header("Content-Type: application/json");


$stkCallbackResponse = file_get_contents('php://input');
$logFile = "MpesaStkResponse.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);


$data = json_decode($stkCallbackResponse);
$MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->ResultCode;
$ResultDesc = $data->Body->stkCallback->ResultDesc;
$Amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$TransactionId = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$TransactionDate = $data->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$phoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;


// check if the transaction is successfull


if ($ResultCode == 0) {
    // store the transaction details in the database
    $sql = "UPDATE mpesa SET (MerchantRequestID, ResultCode, ResultDesc, Amount, TransactionId, TransactionDate, phoneNumber) VALUES (?,?,?,?,?) WHERE CheckoutRequestID = '$CheckoutRequestID'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$MerchantRequestID, $ResultCode, $ResultDesc, $Amount, $TransactionId, $TransactionDate,$phoneNumber]);

    header("location: index.php.php?transaction=success");
    exit();
}


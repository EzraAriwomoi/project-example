<?php
// accessToken.php

function generateAccessToken() {
    $consumerKey = 'your_consumer_key'; // Replace with your actual consumer key
    $consumerSecret = 'your_consumer_secret'; // Replace with your actual consumer secret
    $credentials = base64_encode("$consumerKey:$consumerSecret");

    $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    if ($response === false) {
        error_log('Curl error: ' . curl_error($ch));
        curl_close($ch);
        return null;
    }

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        error_log('HTTP Error Code: ' . $http_code);
        error_log('Response: ' . $response);
        return null;
    }

    $result = json_decode($response);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('JSON decode error: ' . json_last_error_msg());
        return null;
    }

    if (!isset($result->access_token)) {
        error_log('Unexpected response structure: ' . $response);
        return null;
    }

    return $result->access_token;
}

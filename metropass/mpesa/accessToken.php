<?php
// accessToken.php
function generateAccessToken() {
    $consumerKey = 'MpfUChOqI5gsw5otVjSN2BZOAuZpg0usMnr30f8RlyRLRwYi';
    $consumerSecret = 'IwRqW8hpZoBpQqv3mTp4t2NIa7euMx86wsa7wMnhRTA0TOKkhbkGhFwVSqceooyZ';
    $credentials = base64_encode("$consumerKey:$consumerSecret");

    $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch) . PHP_EOL;
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code !== 200) {
            echo 'HTTP Error Code: ' . $http_code . PHP_EOL;
            echo 'Response: ' . $response . PHP_EOL;
        } else {
            echo 'Response: ' . $response . PHP_EOL; // Output full response for debugging
            $result = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo 'JSON decode error: ' . json_last_error_msg() . PHP_EOL;
            } else {
                if (isset($result->access_token)) {
                    echo 'Access Token: ' . $result->access_token . PHP_EOL;
                } else {
                    echo 'Unexpected response structure: ' . $response . PHP_EOL;
                }
            }
        }
    }

    curl_close($ch);

    if (isset($result->access_token)) {
        return $result->access_token;
    } else {
        return null; // Handle case where access token is not retrieved
    }
}
?>

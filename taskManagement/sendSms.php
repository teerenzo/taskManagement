<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://auth.oltranz.com/auth/realms/api/protocol/openid-connect/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'client_id=isaha-co&grant_type=client_credentials&client_secret=f305ec36-f1e2-4858-85d0-386958185553',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
$result = json_decode($response);
$token = $result->{'access_token'};
//echo $token;

function sendSms($token, $receiver, $message)
{

    $curl = curl_init();
    $token1 =  "Authorization: Bearer $token";

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sms.api.oltranz.com/api/v1/sms/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
     "title": "Kora App",
      "message": "' . $message . '", 
      "receivers": [ "' . "25" . $receiver . '"]
   
     
}',
        CURLOPT_HTTPHEADER => array(
            $token1,
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}
sendSms($token, '0780640237', ' Hell your payment will be done on 31/01/2022');

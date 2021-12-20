<?php



function gen_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
$uuid = gen_uuid();
echo $uuid;
function transfer($uuid, $amountToPay, $reciever)
{

    $externalId = $uuid;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://opay-api.oltranz.com/opay/wallet/fundstransfer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
"merchantId": "3bb18f64-15a8-4c28-a189-2420fed2cf4e",
"receiverAccount": "' . $reciever . '",
"type": "MOBILE",
"transactionId": "' . $uuid . '",
"amount": "' . $amountToPay . '",
"callbackUrl": "http://localhost/taskManagement/testAPI.php",
"description": "FUNDS TRANSFER TEST"

}',
        CURLOPT_HTTPHEADER => array(
            'AccessKey: 4554e8905c3411ecb02c69b80d19a2d24554e8915c3411ecb02c69b80d19a2d24554e8925c3411ecb02c',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $response = curl_exec($curl);
    $res = json_decode($response);
    echo $response;
    echo  $result = $res->{'status'};
    curl_close($curl);
    // var_dump($response);
    if ($result == "INSUFFICIENT_FUNDS") {
        //echo "well done<br>Token:$token<br>UUID:$uuid";
    } else {

        echo $response;
    }
}
$amount = 10;
$reciever = "250780640237";
transfer($uuid,  $amount, $reciever);

<?php
include 'connection.php';
$id = $_GET['id'];
$query = "UPDATE  `assigned_tasks` SET status='approved' WHERE `task_id`='$id'";
$done = mysqli_query($connect, "$query");
if ($done) {
    echo "<script>alert('task approved')</script>";
    $select = mysqli_query($connect, "SELECT `users`.tel from users,assigned_tasks WHERE users.id=assigned_tasks.user_id and assigned_tasks.task_id='$id'");
    $tel = mysqli_fetch_array($select);
    echo $tel[0];

    // echo $taskId;


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
    sendSms($token, $tel[0], 'your task aproved, payment will be done soon');

?>

    <script>
        alert('Task Approved');
        window.open("projectStatus.php","_self");
    </script>
    <?php

    ?>

<?php
    // header("Location:All_Users.php");
} else {
    echo "noo";
}

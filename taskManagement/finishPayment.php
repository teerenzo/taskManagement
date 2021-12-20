<?php
require 'connection.php';
$id = $_POST['id'];

$select_assigned_info = mysqli_query($connect, "SELECT * FROM assigned_tasks WHERE id='$id'");
$query = mysqli_fetch_array($select_assigned_info);
$task_id = $query['task_id'];
$user_id = $query['user_id'];

$select_task_amount = mysqli_query($connect, "SELECT amount FROM tasks WHERE id='$task_id'");
$query1 = mysqli_fetch_array($select_task_amount);

$select_user_info = mysqli_query($connect, "SELECT * FROM users WHERE id='$user_id'");
$query2 = mysqli_fetch_array($select_user_info);
$names = $query2['names'];
$tel = '25' . $query2['tel'];

$amount = $query1[0];
?>
<!DOCTYPE html>



<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title Page-->
    <title>Task Management</title>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">



    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
</head>

<body>

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


    function transfer($uuid, $amountToPay, $reciever, $connect, $user_id, $task_id, $id)
    {

        //   $ternalIdex = $uuid . "123";

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
        //  echo $response;
        $res = json_decode($response);
        $result = $res->{'status'};
        curl_close($curl);
        // var_dump($response);
        if ($result == "INSUFFICIENT_FUNDS") {
            // $res = json_decode($response);
            echo $response;
    ?>
            <script>
                //  alert("INSUFFICIENT_FUNDS")
                //    history.go(-1)
            </script>
        <?php
        } else {
            $day = date("d");
            $month = date("m");
            $year = date("y");
            mysqli_query($connect, "INSERT INTO `payments` (`id`, `user_id`, `task_id`, `amount`, `p_date`) VALUES (NULL, '$user_id', '$task_id', '$amountToPay', '$day/$month/$year')");
            mysqli_query($connect, "UPDATE `assigned_tasks` SET `status`='paid' WHERE id='$id'");
        ?>


            <script>
                alert("Fund transfered Successfully")
                history.go(-2)
            </script>

    <?php          // echo $response;
        }
    }
    $amount = 10;
    //    // transfer($uuid,  $amount, $reciever);
    // echo $uuid;
    transfer($uuid, $amount, $tel, $connect, $user_id, $task_id, $id);

    ?>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/startmin.js"></script>

</body>

</html>
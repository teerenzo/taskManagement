<?php
include "connection.php";
session_start();

$taskId = $_GET['task_id'];

if (isset($_POST['submit'])) {


    $description = $_POST['description'];



    $done = mysqli_query($connect, "UPDATE `assigned_tasks` SET `feedback`='$description',`status`='rejected' WHERE `task_id`='$taskId'");
    $select = mysqli_query($connect, "SELECT `users`.tel from users,assigned_tasks WHERE users.id=assigned_tasks.user_id and assigned_tasks.task_id='$taskId'");
    $tel = mysqli_fetch_array($select);
    echo $tel[0];

    echo $taskId;

    if ($done) {

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
        sendSms($token, $tel[0], 'your task rejected becouse ' . $description);

?>

        <script>
            alert('Task Rejected');
            history.go(-3);
        </script>
<?php
    } else {
        echo "Error", mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Document</title>
</head>

<body>
    <?php include('includes/nav-sidebar.php'); ?>
    <br><br><br>
    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <?php include('includes/header.php');  ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p align='right'><button class="btn btn-danger text-center" data-dismiss="modal">X</button></p>
                    <h3 class="modal-title">Reject Task</h3>
                </div>
                <div class="modal-body">
                    <p>
                        Give Developer Feedback
                    </p>
                    <br>
                    <form action="#" method="post">
                        <div class="row">
                            <input type="hidden" name="taskId" id="" value="<?php echo $taskId ?>">
                            <div class="col-lg-12">
                                <div class="form-group">

                                    <textarea class="form-control" name="description" rows="3" placeholder="Describe rejecting resion"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <center>
                                <div class="col-lg-12">
                                    <button type="submit" name='submit' class="btn btn-primary">
                                        Send
                                    </button>
                                </div>
                            </center>
                        </div>

                    </form>
                </div>
                <!-- <div class="modal-footer">by director of 13or Ltd</div> -->
            </div>
        </div>

        <?php include('includes/footer.php') ?>
    </div>
</body>

</html>
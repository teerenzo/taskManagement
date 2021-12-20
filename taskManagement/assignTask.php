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


session_start();
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
include("connection.php");
if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $developer = $_POST['developer'];

    $desc = $_POST['description'];
    $deadline = $_POST['ddate'];

    //get developer infor
    $developerInfor=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM `users` WHERE `id`='$developer'"));

    $sel = mysqli_query($connect, "SELECT * FROM `assigned_tasks` WHERE task_id='$task'");
    if (mysqli_num_rows($sel)) {

        echo "<script>alert('task already assigned to this developer')</script>";
    } else {

        $query = mysqli_query($connect, "INSERT INTO`assigned_tasks`(task_id,user_id,task_note,deadline,status) VALUES('$task','$developer','$desc','$deadline','assigned')");

        mysqli_query($connect, "UPDATE `tasks` SET `status`='assigned' WHERE `id`='$task'");

        if ($query) {

            sendSms($token, $developerInfor[3], ' Hell '.$developerInfor[2].', you have new assign task please chackout into your app to see more informatione');

            echo "<script>alert('Task assigned Well..')</script>";
        } else {
            echo "erro";
            //echo "<script>alert('error while inserting..')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin</title>

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

<body class="animsition">


    <?php include('includes/nav-sidebar.php'); ?>

    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <?php include('includes/header.php');  ?>

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <div class="container">
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Assign Task</strong>
                                        </div>
                                        <div class="card-body card-block">
                                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">

                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p style="font-size: 16px; color: black;" class="form-control-static">Project</p>
                                                    </div>
                                                </div>
                                                <?php

                                                $select = mysqli_query($connect, "select * from project");

                                                ?>
                                                <div class="row form-group">
                                                    <div class="col-12 col-md-9">
                                                        <select id="selector" onchange="getTask(selector.value)" name="project_id" class="form-control">
                                                            <option value="#">Select Project</option>
                                                            <?php
                                                            while ($row = mysqli_fetch_array($select)) {
                                                            ?>
                                                                <option value="<?php echo $row[0] ?>">
                                                                    <?php
                                                                    echo $row[1]
                                                                    ?></option>

                                                            <?php
                                                            }

                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p style="font-size: 16px; color: black;" class="form-control-static">Task(s)</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <select id="task" onchange="getUser(task.value)" name="task" class="form-control">
                                                            <!-- <input type="text" id="task" name="name" placeholder="Enter Task Name" class="form-control"> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p style="font-size: 16px; color: black;" class="form-control-static">Developer</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <select id="developer" name="developer" class="form-control">
                                                            <!-- <input type="text" id="task" name="name" placeholder="Enter Task Name" class="form-control"> -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p class="form-control-static" style="font-size: 16px; color: black;">Description</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <textarea class="form-control" name="description"></textarea>
                                                        <!-- <input type="text" id="text-input" name="quantity" placeholder="enter quantity" class="form-control"> -->

                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p style="font-size: 16px; color: black;" class="form-control-static">Deadline</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-9">

                                                    <input type="date" id="text-input" name="ddate" class="form-control">

                                                </div>

                                                <div class="card-footer">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-dot-circle-o"></i> Submit
                                                    </button>
                                                    <input type="reset" class="btn btn-danger btn-sm">

                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">

                </div>
                <div class="col-sm-6 col-lg-3">

                </div>
                <div class="col-sm-6 col-lg-3">

                </div>
                <div class="col-sm-6 col-lg-3">

                </div>
            </div>



            <?php include('includes/footer.php') ?>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>

    </div>

    <!--   Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script>
        const getTask = (item) => {
            $.ajax({
                url: "getTask.php",
                type: "POST",
                data: {
                    item
                },
                success: function(data) {

                    $("#task").html(data);
                    console.log(data);
                }
            })
        }

        const getUser = (item) => {
            $.ajax({
                url: "getUser.php",
                type: "POST",
                data: {
                    item
                },
                success: function(data) {

                    $("#developer").html(data);
                    console.log(data);
                }
            })
        }
    </script>
</body>

</html>
<!-- end document-->
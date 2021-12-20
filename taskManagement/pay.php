<?php
require 'connection.php';
$id = $_GET['id'];

$select_assigned_info = mysqli_query($connect, "SELECT * FROM assigned_tasks WHERE id='$id'");
$query = mysqli_fetch_array($select_assigned_info);
$task_id = $query['task_id'];
$user_id = $query['user_id'];

$select_task_amount = mysqli_query($connect, "SELECT * FROM tasks,project WHERE tasks.proj_id=project.id and tasks.id='$task_id'");
$query1 = mysqli_fetch_array($select_task_amount);

$select_user_info = mysqli_query($connect, "SELECT * FROM users WHERE id='$user_id'");
$query2 = mysqli_fetch_array($select_user_info);
$names = $query2['names'];
$tel = $query2['tel'];

$amount = $query1['amount'];





?>

<!DOCTYPE html>
<html>

<head>
    <title></title>

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
    <center>
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">



                        <div class="panel-heading">
                            <h3 class="panel-title">You are about to pay <b style="color: green;"> <?php echo $names ?> </b> </h3>
                            <p>
                                <br>
                                <br>
                            <h4>TaskName: <?php echo $query1['task_name'] ?></h4>
                            <br>
                            <h4>Project Name: <?php echo $query1['proj_name'] ?></h4>
                            </p>
                        </div>
                        <div class="panel-body">

                            <fieldset>
                                <div class="form-group">

                                </div>
                                <div class="form-group">
                                    Amount: <b><?php echo $amount; ?> Frw</b>
                                </div>

                                <div class="form-group">
                                    Tel: <b><?php echo $tel; ?></b>
                                </div>


                                <form action="finishPayment.php" method="POST" enctype='multipart/form-data'>


                                    <div class="row">
                                        <div class="col-lg-6">

                                            <input type="hidden" name="id" value="<?php echo $id; ?>" id="">


                                            <div class="form-group">

                                                <button type="submit" name="done" id="" class="btn btn-success btn-block">Pay</button>
                                            </div>
                                        </div><br>
                                        <div class="col-lg-6"><a href="./index.php" class="btn btn-warning btn-block">cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </fieldset>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </center>
</body>

</html>
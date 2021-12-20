<?php

session_start();
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

include 'connection.php';
$query = "SELECT * FROM `project`";
$data = mysqli_query($connect, "$query");

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

<body>







    <!-- MAIN CONTENT-->
    <div class="main-content" style="background-color: white;">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">Progress Task Report</h3>
                        <div class="overview-wrap">
                            <table class="table table-stripe table-hover" border="1">

                                <tbody>

                                    <thead>
                                        <tr>
                                            <th>#</th>

                                            <th>Task Name</th>
                                            <th>Developer</th>
                                            <!-- <th>Date</th> -->
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $count = 0;
$amount=0;
                                    while ($row = mysqli_fetch_array($data)) {
                                        $selectTask = mysqli_query($connect, "SELECT tasks.task_name,assigned_tasks.user_id,tasks.amount FROM tasks,assigned_tasks WHERE tasks.id=assigned_tasks.task_id AND tasks.proj_id='{$row['id']}' AND assigned_tasks.status='paid'");

                                    ?>
                                        <tr>
                                            <td colspan="4"><?php echo $row[1]; ?></td>
                                        </tr>
                                        <?php
                                        if (mysqli_num_rows($selectTask)) {
                                            while ($row2 = mysqli_fetch_array($selectTask)) {
                                                @$amount = $amount + $row2[2];
                                                $count++;
                                                $selectDeveloper = mysqli_query($connect, "SELECT email,names,tel FROM users WHERE id=1 ");
                                                // $data = mysqli_fetch_array($selectDeveloper);
                                        ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>

                                                    <td><?php echo $row2[0]; ?></td>
                                                    <td><?php
                                                        while ($row3 = mysqli_fetch_array($selectDeveloper)) {
                                                            echo $row3[1] . " / " . $row3[2];
                                                        }



                                                        // echo $data[1];



                                                        ?></td>
                                                    <td><?php echo $row2[2]; ?></td>

                                                </tr>

                                            <?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td colspan="4">nothing to show</td>
                                            </tr>

                                        <?php }


                                        ?>


                                    <?php  }  ?>
                                    <tr>
                                        <td colspan="3">Total Amount</td>
                                        <td><?php echo $amount ?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.onload(print())
    </script>
    <!-- Jquery JS-->
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

</body>

</html>
<!-- end document-->
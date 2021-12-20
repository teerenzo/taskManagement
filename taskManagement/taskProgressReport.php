<?php

session_start();
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

include 'connection.php';
$query = "SELECT * FROM `project` WHERE `status`!='completed'";
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

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="" alt="" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <?php include('includes/nav-sidebar.php'); ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">

            <?php include('includes/header.php');  ?>

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
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $count = 0;
                                            $amount = 0;

                                            while ($row = mysqli_fetch_array($data)) {
                                                $selectTask = mysqli_query($connect, "SELECT tasks.task_name,assigned_tasks.user_id,tasks.amount,assigned_tasks.status FROM tasks,assigned_tasks WHERE tasks.id=assigned_tasks.task_id AND tasks.proj_id='{$row['id']}' AND (assigned_tasks.status='assigned' OR assigned_tasks.status='pending' OR assigned_tasks.status='approved')");

                                            ?>

                                                <?php
                                                if (mysqli_num_rows($selectTask)) {
                                                ?>
                                                    <tr>
                                                        <td colspan="4"><?php echo $row[1]; ?></td>
                                                    </tr>
                                                    <?php
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
                                                            <td><?php echo $row2[3] ?></td>
                                                            <td><?php echo $row2[2]; ?></td>

                                                        </tr>

                                                    <?php
                                                    }
                                                } else { ?>
                                                    <tr>
                                                        <!-- <td colspan="5">nothing to show</td> -->
                                                    </tr>

                                                <?php }


                                                ?>


                                            <?php  }  ?>
                                            <tr>
                                                <td colspan="4">Total Amount</td>
                                                <td><?php echo $amount ?> FRW</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <br><br>
                                <center><a href="taskProgressReportPrint.php" target="blank" class="btn btn-primary">Print</a></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
        <?php include('includes/footer.php') ?>
    </div>

    <!--  <!-- Jquery JS-->
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
    -->
    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
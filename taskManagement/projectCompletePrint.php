<?php

session_start();
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    echo "<script>window.open('login.php','_self')</script>";
}

include 'connection.php';
$query = "SELECT * FROM `project` WHERE `status`='completed'";
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

    <div class="main-content" style="background-color: white;">
        <div class="section__content section__content--p30">
            <center>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center">Progress Projects Report</h3>
                            <div class="overview-wrap">

                                <table class="table" border="1">

                                    <tbody>

                                        <thead>
                                            <tr>
                                                <th>#</th>

                                                <th>Project Name</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $count = 0;
                                        while ($row = mysqli_fetch_array($data)) {
                                            $count++;
                                            @$amount = $amount + $row[4];
                                        ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>

                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $row[4]; ?></td>
                                            </tr>
                                        <?php  }  ?>
                                        <tr>
                                            <td colspan="4">Total Amount</td>
                                            <td><?php echo $amount ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <br><br>

                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>
    <?php //include('includes/footer.php') 
    ?>
    </div>
    <script>
        window.onload(print())
    </script>
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
<?php
session_start();
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
include("connection.php");

$id1 = $_GET['id'];
$sel1 = mysqli_query($connect, "SELECT * FROM project WHERE id='$id1'");
$result = mysqli_fetch_array($sel1);
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    // $amount=$_POST['amount'];
    $price = $_POST['price'];
    $desc = $_POST['description'];

    $query = mysqli_query($connect, "UPDATE project SET proj_name='$name',proj_type='$type',proj_description='$desc',amount='$price' WHERE id='$id1'");
    if ($query) {
        echo "<script>alert('Data Updated Well..')</script>";
        echo "<script>window.open('projects.php','_self')</script>";
    } else {
        echo "<script>alert('error while updating..')</script>";
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
                                            <strong>Update Project Info</strong>
                                        </div>
                                        <div class="card-body card-block">
                                            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p style="font-size: 16px; color: black;" class="form-control-static">Name</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <input type="text" value="<?php echo $result[1] ?>" id="text-input" name="name" placeholder="Enter Project Name" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p class="form-control-static" style="font-size: 16px; color: black;">Type</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <?php

                                                    if ($result[2] = 'Web Design') {
                                                    ?>
                                                        <div class="col-12 col-md-9">
                                                            <select name="type" value="<?php echo $result[2] ?>" class="form-control">

                                                                <option>Web Design</option>
                                                                <option>Application Development</option>



                                                            </select>

                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="col-12 col-md-9">
                                                            <select name="type" value="<?php echo $result[2] ?>" class="form-control">
                                                                <option>Application Development</option>
                                                                <option>Web Design</option>




                                                            </select>

                                                        </div>



                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p class="form-control-static" style="font-size: 16px; color: black;">Description</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <textarea class="form-control" name="description">
                                                    <?php
                                                    echo $result[3]

                                                    ?>
                                                    </textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p class="form-control-static" style="font-size: 16px; color: black;">Amount paid</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <input type="text" value="<?php echo $result[4] ?>" id="text-input" name="price" placeholder="enter price" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" name="update" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-dot-circle-o"></i> Update
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

</body>

</html>
<!-- end document-->
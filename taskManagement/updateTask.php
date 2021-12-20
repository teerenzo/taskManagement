<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    echo "<script>window.open('login.php','_self')</script>";
}
include("connection.php");
$id = $_GET['id'];

$select_task = mysqli_query($connect, "SELECT * FROM tasks WHERE id='$id'");

$result = mysqli_fetch_array($select_task);


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $project = $_POST['project_id'];
    // $amount=$_POST['amount'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $skills = $_POST['skills'];



    $query = mysqli_query($connect, "UPDATE tasks   SET proj_description='$desc',amount='$price',skills_required='$skills' WHERE id='$id'");

    if ($query) {
        // $select_project_path = mysqli_query($connect, "SELECT project_path FROM project WHERE id='$project'");
        // $data = mysqli_fetch_array($select_project_path);
        // $path = $data[0] . "/" . $name;

        // mkdir($path);

        echo "<script>alert('Data Updated Well..')</script>";
    } else {
        echo "<script>alert('error while inserting..')</script>";
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
                                            <strong>New Task</strong>
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
                                                        <input type="text" readonly value="<?php echo $result['task_name'] ?>" id="text-input" name="name" placeholder="Enter Task Name" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p style="font-size: 16px; color: black;" class="form-control-static">Project</p>
                                                    </div>
                                                </div>
                                                <?php


                                                $select_pro = mysqli_query($connect, "select * from project where id='$result[2]'");
                                                $result2 = mysqli_fetch_array($select_pro);
                                                $select = mysqli_query($connect, "select * from project where id!='$result2[0]'");
                                                ?>
                                                <div class="row form-group">
                                                    <div class="col-12 col-md-9">

                                                        <input type="text" readonly value="<?php echo $result2[1] ?>" id="text-input" name="name" placeholder="Enter Task Name" class="form-control">



                                                    </div>
                                                </div>

                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p class="form-control-static" style="font-size: 16px; color: black;">Description</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <textarea class="form-control" name="description"><?php echo $result[4] ?></textarea>
                                                        <!-- <input type="text" id="text-input" name="quantity" placeholder="enter quantity" class="form-control"> -->

                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <p class="form-control-static" style="font-size: 16px; color: black;">Skills Required</p>
                                                        <input type="text" value="<?php echo $result[5] ?>" id="text-input" name="skills" placeholder="enter skills" class="form-control">
                                                        <b>NB:respect " , " ex: html,css,js </b>
                                                    </div>

                                                </div>

                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <p class="form-control-static" style="font-size: 16px; color: black;">Amount paid</p>
                                                    </div>
                                                </div>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-9">
                                                        <input type="text" value="<?php echo $result[6] ?>" id="text-input" name="price" placeholder="enter price" class="form-control">

                                                    </div>
                                                </div>









                                                <div class="card-footer">
                                                    <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-dot-circle-o"></i> Update
                                                    </button>


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
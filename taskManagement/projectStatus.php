<?php
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

    $sel = mysqli_query($connect, "SELECT * FROM `assigned_tasks` WHERE task_id='$task'");
    if (mysqli_num_rows($sel)) {

        echo "<script>alert('task already assigned to this developer')</script>";
    } else {

        $query = mysqli_query($connect, "INSERT INTO`assigned_tasks`(task_id,user_id,task_note,deadline,status) VALUES('$task','$developer','$desc','$deadline','assigned')");

        if ($query) {


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
                                            <strong>Project Details</strong>
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
                                                        <select id="selector" onchange="getProjectTask(selector.value)" name="project_id" class="form-control">
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

                                                    <div class="col-12 col-md-12">
                                                        <table class="table" id="task">

                                                        </table>
                                                    </div>
                                                </div>
                                                <!--  <div class="row form-group">

                                        <div class="col-12 col-md-12">
                                            <p style="font-size: 16px; color: black;" class="form-control-static">Developer</p>
                                        </div>
                                    </div>
                                    <div class="row form-group">

                                        <div class="col-12 col-md-9">
                                            <select id="developer" name="developer" class="form-control">
                                                <!-- <input type="text" id="task" name="name" placeholder="Enter Task Name" class="form-control"> 
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
                                            <!-- <input type="text" id="text-input" name="quantity" placeholder="enter quantity" class="form-control"> 

                                        </div>
                                    </div> -->












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
        const getProjectTask = (item) => {
            $.ajax({
                url: "getProjectTask.php",
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

        // const getUser = (item) => {
        //     $.ajax({
        //         url: "getUser.php",
        //         type: "POST",
        //         data: {
        //             item
        //         },
        //         success: function(data) {

        //             $("#developer").html(data);
        //             console.log(data);
        //         }
        //     })
        // }
    </script>
</body>

</html>
<!-- end document-->
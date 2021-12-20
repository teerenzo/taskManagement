<?php
include('connection.php');
if(isset($_POST['done'])){
$username=$_POST['username'];
$password=$_POST['password'];

  $query=mysqli_query($connect,"SELECT * FROM admin where username='$username' AND password='$password'");
  if(mysqli_num_rows($query)>0){
    session_start();
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
      echo "<script>window.open('index.php','_self')</script>";
  }else{
     echo "<script>alert('Wrong Password or Username')</script>";
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

<body style="background-image: url(images/ok.png );background-repeat: no-repeat;background-size: 60cm">
  <div class="container ">
    <center>
      <br><br>
      <h1>Login Admin Page </h1>
    </center>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-md-8 col-sm-8 col-xs-12 ">
      <form class=" jumbotron" id="login" method="post" action="login.php">
        <p class="text-center"></p>
        <div class="row">
          <div class="col-lg-1"></div>
          <div class="col-lg-10">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" placeholder="Enter username" required='' name="username">
            </div>
            <div class="form-group">
              <label for="password">password:</label>
              <input type="password" class="form-control" required='' placeholder="Enter password" name="password">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary from-control" value="Login" name="done">

            </div>
          
          </div>
        </div>
      </form>
    </div>

  </div>

</body>

</html>
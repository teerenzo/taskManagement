<?php
include "connection.php";
$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
$result = mysqli_query($connect, "$query");
if (mysqli_num_rows($result)) {
    $userInfor = mysqli_fetch_array($result);
    $userId = $userInfor[0];
    echo $userId;
} else {
    echo "Wrong Email or Password";
}

//update deadliine

$time = strtotime(date('d-M-Y'));
$time = date('Y-m-d', $time);

mysqli_query($connect, "UPDATE `assigned_tasks` SET `status`='deadline_exp' WHERE `deadline`<'$time' AND `status`='assigned'");

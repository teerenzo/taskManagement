<?php
include "connection.php";
$email = $_POST['email'];
$names = $_POST['names'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$ifExist = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `email`='$email'"));
if (!$ifExist) {
    $query = "INSERT INTO `users` (`id`, `email`, `names`, `tel`, `password`, `verified`) VALUES (NULL, '$email', '$names', '$phone', '$password', 'no');";
    $result = mysqli_query($connect, "$query");
    if ($result) {
        echo "Account created successful";
    } else {
        echo "ERROR: " + mysqli_error($connect);
    }
} else {
    echo "User with this email already exist in system";
}

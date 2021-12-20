<?php
include "connection.php";
$userId = $_POST['userId'];
$newPassword = $_POST['newPassword'];
$currentPassword = $_POST['currentPassword'];

$securityQuery = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$userId' AND `password`='$currentPassword'");

if (mysqli_num_rows($securityQuery)) {
    $query = "UPDATE `users` SET `password`='$newPassword' WHERE `id`='$userId';";
    $done = mysqli_query($connect, "$query");
    if ($done) {
        echo "Password Changed well";
    } else echo "Error" . mysqli_error($connect);
} else echo "Invalid Current Password";

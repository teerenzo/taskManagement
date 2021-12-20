<?php
include "connection.php";
$userId = $_POST['userId'];
$email = $_POST['email'];
$names = $_POST['names'];
$tel = $_POST['phone'];


$query = "UPDATE `users` SET `email`='$email',`names`='$names',`tel`='$tel' WHERE `id`='$userId';";
$done = mysqli_query($connect, "$query");
if ($done) {
    echo "Data updated well done";
} else echo "Error" . mysqli_error($connect);

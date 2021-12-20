<?php
include 'connection.php';
$id = $_GET['id'];
$query = "UPDATE  `users` SET verified='yes' WHERE `id`='$id'";
$done = mysqli_query($connect, "$query");
if ($done) {
    echo "<script>alert('user verified')</script>";
    header("Location:All_Users.php");
} else {
    echo "noo";
}

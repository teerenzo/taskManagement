<?php
include 'connection.php';
$id = $_GET['id'];
$query = "DELETE FROM `tasks` WHERE `id`='$id'";
$done = mysqli_query($connect, "$query");
if ($done) {
    echo "<script>window.open('allTask.php','_self')</script>";
} else {
    echo "noo";
}

<?php
include 'connection.php';
$id = $_GET['id'];
$query = "DELETE FROM `project` WHERE `id`='$id'";
$done = mysqli_query($connect, "$query");
if ($done) {
    echo "<script>window.open('projects.php','_self')</script>";
} else {
    echo "noo";
}

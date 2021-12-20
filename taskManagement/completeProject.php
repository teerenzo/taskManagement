<?php
include 'connection.php';
$id = $_GET['id'];
$query = "UPDATE  `project` SET status='completed' WHERE `id`='$id'";
$done = mysqli_query($connect, "$query");
if ($done) {
    echo "<script>alert'project completed')</script>";
    header("Location:projectStatus.php");
} else {
    echo "noo";
}

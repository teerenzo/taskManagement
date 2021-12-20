<?php
include "connection.php";
$userId = $_POST['userId'];
$skill = $_POST['skill'];



$query = "DELETE FROM `skills` WHERE user_id = '$userId' AND name='$skill'";
$done = mysqli_query($connect, "$query");
if ($done) {
    echo "Unchecked well";
} else echo "Error" . mysqli_error($connect);

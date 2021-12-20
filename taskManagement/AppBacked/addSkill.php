<?php
include "connection.php";
$userId = $_POST['userId'];
$skill = $_POST['skill'];

$skillExist = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `skills` WHERE `user_id`='$userId' AND `name`='$skill'"));

if (!$skillExist) {

    $query = "INSERT INTO `skills`  values('','$skill','$userId')";
    $done = mysqli_query($connect, "$query");
    if ($done) {
        echo "Data added well";
    } else echo "Error" . mysqli_error($connect);
}

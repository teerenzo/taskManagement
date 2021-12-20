<?php
include "connection.php";
$userId = $_POST['userId'];
$query = "SELECT * FROM `skills` WHERE `user_id`='$userId'";
$result = mysqli_query($connect, "$query");

$results = array();
while ($row = mysqli_fetch_array($result)) {
    $temp = array();
    $temp['name'] = $row['name'];


    array_push($results, $temp);
    // echo $row[1];
}
echo json_encode($results);

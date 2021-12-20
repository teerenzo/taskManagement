<?php
include "connection.php";
$userId = $_POST['userId'];
$query = "SELECT * FROM `users` WHERE `id`='$userId'";
$result = mysqli_query($connect, "$query");

$results = array();
while ($row = mysqli_fetch_array($result)) {
    $temp = array();
    $temp['names'] = $row['names'];
    $temp['email'] = $row['email'];
    $temp['phone'] = $row['tel'];

    array_push($results, $temp);
    // echo $row[1];
}
echo json_encode($results);

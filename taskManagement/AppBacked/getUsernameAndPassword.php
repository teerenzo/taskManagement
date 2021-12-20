a<?php
    include "connection.php";
    $userId = $_POST['userId'];
    $query = "SELECT `email`,`password` FROM `users` WHERE `id`='$userId'";
    $result = mysqli_query($connect, "$query");

    $results = array();
    while ($row = mysqli_fetch_array($result)) {
        $temp = array();
        $temp['username'] = $row[0];
        $temp['password'] = $row[1];

        array_push($results, $temp);
        // echo $row[1];
    }
    echo json_encode($results);

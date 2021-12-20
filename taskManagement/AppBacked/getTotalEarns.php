<?php
include "connection.php";

$userId = $_POST['userId'];


$query = "SELECT `amount` FROM `payments` WHERE `user_id`='$userId'";

$data = mysqli_query($connect, "$query");
$amount = 0;


while ($row = mysqli_fetch_array($data)) {
    $amount = $amount + $row[0];
}
echo "$amount";

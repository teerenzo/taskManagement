<?php

require "connection.php";

$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$select = mysqli_query($connect, "SELECT * FROM tasks WHERE date BETWEEN $date1 AND $date2");

if (mysqli_num_rows($select)) {
    echo "done";
} else {
    echo "not" . mysqli_error($connect);
}

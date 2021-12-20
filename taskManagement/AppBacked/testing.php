<?php
include 'connection.php';

$DBtime = mysqli_fetch_array(mysqli_query($connect, "SELECT `deadline` FROM `assigned_tasks` WHERE `id`=10"));
// $time2 = date('Y-m-d', $DBtime[0]);
echo $DBtime[0];

$time = strtotime(date('d-M-Y'));
$time = date('Y-m-d', $time);
echo "<br> $time <br>";
if ($DBtime[0] < $time) {
    echo "time ended";
} else echo "you have time";
// $time = strtotime(date('d M Y G:i:s') . ("+2 hours"));
//             $time = strtotime(date('d M Y G:i:s', $time) . ('-10 seconds'));
//             $time = date('d M Y G:i:s', $time);
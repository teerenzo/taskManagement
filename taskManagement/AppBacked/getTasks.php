<?php
include "connection.php";

$userId = $_POST['userId'];

$time = strtotime(date('d-M-Y'));
$time = date('Y-m-d', $time);

if (isset($_POST["userId"])) {
    $query = "SELECT `tasks`.`id`,date,tasks.proj_description,tasks.amount,deadline,task_name,project.proj_name,skills_required FROM `tasks`,`assigned_tasks`,project WHERE tasks.id=assigned_tasks.task_id AND project.id=tasks.proj_id AND assigned_tasks.status='assigned' AND assigned_tasks.user_id='$userId' AND `deadline`>'$time'";

    $data = mysqli_query($connect, "$query");

    if (mysqli_num_rows($data)) {
        $result = array();
        while ($row = mysqli_fetch_array($data)) {

            $tem = array();

            $tem['taskId'] = $row[0];
            $tem['date'] = $row[1];
            $tem['description'] = $row[2];
            $tem['amount'] = $row[3];
            $tem['deadline'] = $row[4];
            $tem['taskName'] = $row[5];
            $tem['projectName'] = $row[6];
            $tem['skills'] = $row[7];

            array_push($result, $tem);
        }
        echo json_encode($result);
    } else echo "You have no new task";
} else echo "user id is required!";

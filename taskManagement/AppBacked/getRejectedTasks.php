<?php
include "connection.php";

$userId = $_POST['userId'];

if (isset($_POST["userId"])) {
    $query = "SELECT `tasks`.`id`,task_name,project.proj_name,assigned_tasks.feedback FROM `tasks`,`assigned_tasks`,project WHERE tasks.id=assigned_tasks.task_id AND project.id=tasks.proj_id AND assigned_tasks.status='rejected' AND assigned_tasks.user_id='$userId'";

    $data = mysqli_query($connect, "$query");

    if (mysqli_num_rows($data)) {
        $result = array();
        while ($row = mysqli_fetch_array($data)) {

            $tem = array();

            $tem['taskId'] = $row[0];
            $tem['taskName'] = $row[1];
            $tem['projectName'] = $row[2];
            $tem['feedback'] = $row[3];


            array_push($result, $tem);
        }
        echo json_encode($result);
    } else echo "You have no new task";
} else echo "user id is required!";

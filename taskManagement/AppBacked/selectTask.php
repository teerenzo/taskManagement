<?php
include "connection.php";

$userId = $_POST['userId'];
$selectedProject = $_POST['project'];
$time = strtotime(date('d-M-Y'));
$time = date('Y-m-d', $time);

if (isset($_POST["userId"])) {
    $query = "SELECT DISTINCT tasks.task_name FROM project,tasks,assigned_tasks WHERE project.id=tasks.proj_id AND tasks.id=assigned_tasks.task_id AND (assigned_tasks.status='assigned' OR assigned_tasks.status='rejected' ) AND assigned_tasks.user_id='$userId' AND project.proj_name='$selectedProject' AND `deadline`>'$time'";

    $data = mysqli_query($connect, "$query");

    if (mysqli_num_rows($data)) {
        $result = array();
        while ($row = mysqli_fetch_array($data)) {
            $tem = array();

            $tem['id'] = '';
            $tem['name'] = $row[0];

            array_push($result, $tem);
        }
        echo json_encode($result);
    } else echo "No task found";
} else echo "user id is required!";

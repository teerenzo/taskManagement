<?php

include 'connection.php';

if (isset($_POST['PDF']) && isset($_POST['userId'])) {

    $encodedPDF = $_POST['PDF'];
    $userId = $_POST['userId'];
    $project = $_POST['project'];
    $task = $_POST['task'];
    $note = $_POST['note'];

    $projectlocation = mysqli_fetch_array(mysqli_query($connect, "SELECT `id`,`project_path` FROM `project` WHERE `proj_name`='$project'"));
    $project = $projectlocation[1];
    $project_id = $projectlocation[0];
    $fileLocation = "../$project/$task.zip";

    $select_task = mysqli_fetch_array(mysqli_query($connect, "SELECT id FROM tasks WHERE task_name='$task' AND proj_id='$project_id'"));
    $task_id = $select_task[0];

    $sqlQuery = "UPDATE  `assigned_tasks` SET link='$fileLocation',status='pending',`developer_note`='$note' WHERE task_id='$task_id'";


    if (mysqli_query($connect, $sqlQuery)) {
        mysqli_query($connect, "UPDATE `project` SET `status`='pending' WHERE `id`='$project_id'");
        file_put_contents($fileLocation, base64_decode($encodedPDF));

        $result["status"] = TRUE;
        $result["remarks"] = "document uploaded successfully";
        // array_push($result, $tem);
    } else {
        $result["status"] = FALSE;
        $result["remarks"] = "ERROR";
    }
} else {
    $result["status"] = FALSE;
    $result["remarks"] = "Please select file";
}

echo (json_encode($result));

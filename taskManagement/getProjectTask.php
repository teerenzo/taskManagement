<?php

include "connection.php";
$item = $_POST['item'];

$query = "SELECT *  FROM `tasks` WHERE `proj_id`='$item'";

$data = mysqli_query($connect, "$query");
if (mysqli_num_rows($data) <= 0) { ?>

    <div style="color: red;">No Task found on this project</div>
<?php

} else {
?>
    <p>
        <!-- <h2>Select Task</h2> -->
        <th>Task Name</th>

        <th>Developer name</th>
        <th>Developer Contact</th>
        <th>Deadline</th>
        <th>status</th>

        <th colspan="3">Action</th>
        <?php
        while ($row = mysqli_fetch_array($data)) {
            $taskid = $row[0];
            $select_assigned_task = mysqli_query($connect, "SELECT * FROM assigned_tasks WHERE task_id='$taskid'");

            while ($row1 = mysqli_fetch_array($select_assigned_task)) {
                $userid = $row1['user_id'];
                $select_user_info = mysqli_query($connect, "SELECT * FROM users WHERE id='$userid'");
                while ($row2 = mysqli_fetch_array($select_user_info)) {
        ?>
                    <tr>
                        <td><?php echo $row['task_name'] ?></td>
                        <td><?php echo $row2['names'] ?></td>
                        <td><?php echo "Tel: " . $row2['tel'] . " / email: " . $row2['email'] ?></td>
                        <td><?php echo $row1['deadline'] ?></td>
                        <td><?php echo $row1['status'] ?></td>
                        <td><?php if ($row1['link'] == null) {
                                // echo "nothing to download";
                            } else { ?>
                                <a href="download.php?link=<?php echo $row1['link'] ?>"><i class="zmdi zmdi-download" title="Download Task Folder"></i></a>

                            <?php }

                            ?>
                        </td>
                        <?php if ($row1['status'] == 'pending') {
                        ?>
                            <td> <a href="approveTask.php?id=<?php echo $row1[1] ?>"><i class="zmdi zmdi-check" title="Approve Task"></i></a> </td>
                            <td data-toggle="modal" data-target="#myModal"> <a title="Reject Task" href="rejectTask.php?task_id=<?php echo $row1[1] ?>">X</a></td>



                            <!-- <button type="button" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
                            </div>
                        <?php
                        } ?>

                        <td><?php if ($row1['status'] == 'approved') {
                            ?>
                                <a class="btn btn-primary" href="pay.php?id=<?php echo $row1['id'] ?>">Pay Developer</a>
                            <?php
                            } ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>


        <?php
        }
        $data1 = mysqli_query($connect, "SELECT * FROM project WHERE id='$item'");
        while ($result1 = mysqli_fetch_array($data1)) { ?>
            <tr>
                <td colspan="7" align="center">
                    <p style="color: blue;">Project Status: <?php echo $result1['status'] ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="4"><a class="btn btn-primary" href="downloadProject.php?link=<?php echo $result1[5] ?>">Download whole PROJECT</a></td>
                <td colspan="3">
                    <?php
                    $checkTaskStatus = "SELECT * FROM `tasks` WHERE proj_id='$item' AND status!='approved'";
                    if (!mysqli_num_rows(mysqli_query($connect, "SELECT * FROM project WHERE id='$item' AND status='completed'"))) {


                        if (!mysqli_num_rows(mysqli_query($connect, "$checkTaskStatus"))) {
                    ?>
                            <center><a class="btn btn-secondary" href="completeProject.php?id=<?php echo $item ?>">Complete Project</a></center>

                    <?php }
                    } ?>
                </td>
            </tr>

            </div>
            </div>


    <?php }
    }
    ?>

    </table>
    </p>
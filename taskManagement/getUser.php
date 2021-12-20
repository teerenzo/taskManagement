<?php
include "connection.php";
$item = $_POST['item'];



$query = "SELECT skills_required  FROM `tasks` WHERE `id`='$item'";

$query_data = mysqli_query($connect, "$query");

$result = mysqli_fetch_array($query_data);

$data = explode(',', $result[0]);


?>
<option value="#">Select Developer</option>
<?php
$allUsers = mysqli_query($connect, "SELECT id,names from users where verified = 'yes'");
$length = 0;
while ($user = mysqli_fetch_array($allUsers)) {
    $skillQuery = mysqli_query($connect, "select name from skills where user_id='$user[0]'");
    while ($row = mysqli_fetch_array($skillQuery)) {
        foreach ($data as $skill) {
            if ($skill == $row[0]) {
                $length++;
            }
        }
    }
    if ($length == count($data)) {
?>

        <option value="<?php echo $user[0] ?>"><?php echo $user[1] ?></option>
<?php

    }
    $length = 0;
}

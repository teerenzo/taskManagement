<?php
session_start();
$_SESSION['taskId'] = $_GET['taskId'];
?>
<script>
    window.close();
</script>
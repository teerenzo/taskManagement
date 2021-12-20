<?php
$filePath = $_GET['link'];
if (file_exists($filePath)) {
    $fileName = basename($filePath);
    $fileSize = filesize($filePath);

    //output headers
    header("Cache-Control:private");
    header("Content-Type:application/stream");
    header("Content-Length:" . $fileSize);
    header("Content-Disposition:attachment; filename=" . $fileName);

    //output file

    readfile($filePath);
    exit();
} else {
    die("path dont valid");
}

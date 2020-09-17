<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
session_start();

$target_path                = $_SESSION['fullpath'].'/'.$_POST['name'];
if (file_exists($target_path)) {
    echo 'exist';
    return;
} else {
    $result                 = mkdir($target_path, 0755);
}
if ($result) {
    $result_path            = $_SESSION['path'].'/'.$_POST['name'];
    if ($result_path == '') {
        $result_path        = 'HOME';
    }
} else {
    $result_path            = 'error';
}
echo $result_path;

session_write_close();

<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
session_start();

$old_path                   = $_SESSION['fullpath'].'/'.$_POST['oldname'];
$new_path                   = $_SESSION['fullpath'].'/'.$_POST['name'];
if (file_exists($new_path)) {
    echo 'exist';
    return;
} else {
    $result                 = rename($old_path, $new_path);
}
if ($result) {
    $result_path            = $_SESSION['path'];
    if ($result_path == '') {
        $result_path        = 'HOME';
    }
} else {
    $result_path            = 'error';
}
echo $result_path;

session_write_close();

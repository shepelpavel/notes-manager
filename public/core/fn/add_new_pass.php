<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
session_start();

$new_file                = $_SESSION['fullpath'].'/'.$_POST['name'].'.json';
$new_json                = json_encode($_POST['arr']);

if ($new_json && !file_exists($new_file)) {
    file_put_contents($new_file, print_r($new_json, true));
} else {
    echo 'error';
    return;
}

echo $_SESSION['path'];
session_write_close();

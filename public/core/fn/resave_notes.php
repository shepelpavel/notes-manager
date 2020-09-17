<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';
session_start();

$target_file                = $_SESSION['file'];
$target_json                = json_encode($_POST['arr']);

if ($_SESSION['backpath'] == 'HOME') {
    $new_file               = $BASEPATH.'/'.$_POST['name'].'.json';
} else {
    $new_file               = $BASEPATH.$_SESSION['backpath'].'/'.$_POST['name'].'.json';
}

if ($target_json && $target_file == $new_file) {
    file_put_contents($new_file, print_r($target_json, true));
} elseif ($target_json && $target_file != $new_file && !file_exists($new_file)) {
    unlink($target_file);
    file_put_contents($new_file, print_r($target_json, true));
} else {
    echo 'error';
    return;
}

echo $_SESSION['backpath'];
session_write_close();

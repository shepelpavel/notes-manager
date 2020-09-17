<?php
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

function Delete($path) {
    if (is_dir($path) === true) {
        $files = array_diff(scandir($path), array('.', '..'));
        foreach ($files as $file) {
            Delete($path . '/' . $file);
        }
        return rmdir($path);
    } else if (is_file($path) === true) {
        return unlink($path);
    }
    return false;
}

$target                 = $BASEPATH.$_POST['name'];
$result                 = Delete($target);
$result_path            = substr($_POST['name'], 0, strrpos($_POST['name'], '/'));
if ($result_path == '') {
    $result_path        = 'HOME';
}
echo $result_path;

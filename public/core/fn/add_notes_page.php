<?php
include $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';
session_start();

if ($_SESSION['file'] != '') {
    $backpath                       = $_SESSION['backpath'];
    $path                           = $_SESSION['backpath'];
} else {
    $backpath                       = $_SESSION['path'];
    $path                           = $_SESSION['path'];
}
if ($backpath == '') {
    $backpath                       = 'HOME';
}
if ($path == 'HOME') {
    $path                           = '';
}
$fullpath                           = $BASEPATH . $path;
$breadcrumbs                        = $_SESSION['breadcrumbs'];

$_SESSION['folders_res']            = '';
$_SESSION['backpath']               = $backpath;
$_SESSION['path']                   = $path;
$_SESSION['thisname']               = '';
$_SESSION['fullpath']               = $fullpath;
$_SESSION['file_res']               = '';
$_SESSION['breadcrumbs']            = $breadcrumbs;

?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/chunks/block/menu.php'; ?>

<div class="content">

    <div class="notes">
        <div class="notes__input notes__input_title">
            <input class="js-input-title" type="text" name="title" autocomplete="off" value="">
        </div>
        <div class="notes__input notes__input_note js-field">
            <textarea id="editor" class="js-input-note" name="note" autocomplete="off" rows="8" cols="80"></textarea>
        </div>

        <div class="notes__buttons">
            <div class="notes__buttons_link js-newnotes-save">Сохранить</div>
            <div class="notes__buttons_link js-tree-path" target="<?= $_SESSION['backpath'] ?>">Отмена</div>
        </div>
    </div>

</div>

<?php session_write_close(); ?>
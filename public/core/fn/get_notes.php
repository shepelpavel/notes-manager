<?php
include $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';
session_start();

$backpath                           = $_SESSION['path'];
if ($backpath == '') {
    $backpath                       = 'HOME';
}
$path                               = $_POST['name'];
$fullpath                           = $BASEPATH . $_POST['name'];
$file                               = $BASEPATH . $_POST['name'];
$file_res                           = json_decode(file_get_contents($file), true);
$tmp_with_json                      = substr($file, strrpos($file, '/') + 1);
$thisname                           = substr($tmp_with_json, 0, strrpos($tmp_with_json, '.json'));
$breadcrumbs                        = $_SESSION['breadcrumbs'];
$tmp_this_crumb                     = [
    'name'                              => $thisname,
    'link'                              => $path
];
array_push($breadcrumbs, $tmp_this_crumb);

$_SESSION['folders_res']            = '';
$_SESSION['backpath']               = $backpath;
$_SESSION['path']                   = $path;
$_SESSION['thisname']               = $thisname;
$_SESSION['fullpath']               = $fullpath;
$_SESSION['file']                   = $file;
$_SESSION['file_res']               = $file_res;
$_SESSION['breadcrumbs']            = $breadcrumbs;

?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/chunks/block/menu.php'; ?>

<div class="content">

    <div class="notes">
        <div class="notes__input notes__input_title">
            <input class="js-input-title" type="text" name="title" autocomplete="off" value="<?= $_SESSION['thisname'] ?>">
        </div>
        <div class="notes__input notes__input_note js-field">
            <textarea id="editor" class="js-input-note" name="note" autocomplete="off" rows="8" cols="80"><?= $_SESSION['file_res']['note'] ?></textarea>
        </div>

        <div class="notes__buttons">
            <div class="notes__buttons_link js-notes-save">Сохранить</div>
            <div class="notes__buttons_link js-tree-path" target="<?= $_SESSION['backpath'] ?>">Отмена</div>
        </div>
    </div>

</div>

<?php session_write_close(); ?>
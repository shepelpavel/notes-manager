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

    <h2>Add</h2>

    <div class="breadcrumbs">
        <?php
        if ($_SESSION['path'] == '') {
            echo '<div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div>';
        } elseif ($_SESSION['file'] != '') {
            echo '<div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div>';
            if ($_SESSION['backpath'] != 'HOME') {
                foreach ($_SESSION['breadcrumbs'] as $crumb) {
                    if (next($_SESSION['breadcrumbs'])) {
                        echo '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__link js-tree-path" target="' . $crumb['link'] . '">' . $crumb['name'] . '</div>';
                    }
                }
            }
        } else {
            echo '<div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div>';
            foreach ($_SESSION['breadcrumbs'] as $crumb) {
                echo '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__link js-tree-path" target="' . $crumb['link'] . '">' . $crumb['name'] . '</div>';
            }
        }
        ?>
    </div>

    <?php if ($_SESSION['path'] != '') { ?>
        <div class="controls">
            <div class="controls__link js-tree-path" target="<?= $_SESSION['backpath'] ?>">
                <img class="controls__link_icon" src="/_assets/img/svg/left-arrow.svg" alt="Back">
            </div>
            <div class="controls__link js-tree-path" target="HOME">
                <img class="controls__link_icon" src="/_assets/img/svg/home.svg" alt="Home">
            </div>
        </div>
    <?php } ?>

    <div class="pass">
        <div class="pass__input pass__input_title">
            <input class="js-input-title" type="text" name="title" autocomplete="off" value="">
        </div>
        <div class="pass__input pass__input_note js-field">
            <textarea class="js-input-note" name="note" autocomplete="off" rows="8" cols="80"></textarea>
        </div>

        <div class="pass__buttons">
            <div class="pass__buttons_link js-newpass-save">Сохранить</div>
            <div class="pass__buttons_link js-tree-path" target="<?= $_SESSION['backpath'] ?>">Отмена</div>
        </div>
    </div>

</div>

<?php session_write_close(); ?>
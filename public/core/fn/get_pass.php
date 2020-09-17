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

    <h2><?= $_SESSION['thisname'] ?></h2>

    <div class="breadcrumbs">
        <?php if ($_SESSION['path'] != '') {
            echo '<div class="breadcrumbs__link js-tree-path" target="HOME">HOME</div>';
            foreach ($_SESSION['breadcrumbs'] as $crumb) {
                if (next($_SESSION['breadcrumbs'])) {
                    echo '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__link js-tree-path" target="' . $crumb['link'] . '">' . $crumb['name'] . '</div>';
                } else {
                    echo '<div class="breadcrumbs__arrow"> > </div><div class="breadcrumbs__nolink">' . $crumb['name'] . '</div>';
                }
            }
        } ?>
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
            <input class="js-input-title" type="text" name="title" autocomplete="off" value="<?= $_SESSION['thisname'] ?>">
        </div>
        <div class="pass__input pass__input_link js-field">
            <input class="js-input-link js-crypt <?= empty($_SESSION['file_res']['link']) ? 'decrypted empty' : 'crypted' ?>" type="text" name="link" autocomplete="off" value="<?= $_SESSION['file_res']['link'] ?>" <?= empty($_SESSION['file_res']['link']) ? '' : 'disabled' ?>>
            <img class="pass__input_crypt js-crypt-decrypt <?= empty($_SESSION['file_res']['link']) ? 'hide decrypted' : 'crypted' ?>" src="/_assets/img/svg/eye.svg" alt="Crypt/Decrypt">
            <img class="pass__input_copy js-pass-copy <?= empty($_SESSION['file_res']['link']) ? 'hide' : '' ?>" src="/_assets/img/svg/copy.svg" alt="Copy">
        </div>
        <div class="pass__input pass__input_login js-field">
            <input class="js-input-login js-crypt <?= empty($_SESSION['file_res']['login']) ? 'decrypted empty' : 'crypted' ?>" type="text" name="login" autocomplete="off" value="<?= $_SESSION['file_res']['login'] ?>" <?= empty($_SESSION['file_res']['login']) ? '' : 'disabled' ?>>
            <img class="pass__input_crypt js-crypt-decrypt <?= empty($_SESSION['file_res']['login']) ? 'hide decrypted' : 'crypted' ?>" src="/_assets/img/svg/eye.svg" alt="Crypt/Decrypt">
            <img class="pass__input_copy js-pass-copy <?= empty($_SESSION['file_res']['login']) ? 'hide' : '' ?>" src="/_assets/img/svg/copy.svg" alt="Copy">
        </div>
        <div class="pass__input pass__input_pass js-field">
            <input class="js-input-pass js-crypt <?= empty($_SESSION['file_res']['pass']) ? 'decrypted empty' : 'crypted' ?>" type="text" name="pass" autocomplete="off" value="<?= $_SESSION['file_res']['pass'] ?>" <?= empty($_SESSION['file_res']['pass']) ? '' : 'disabled' ?>>
            <img class="pass__input_crypt js-crypt-decrypt <?= empty($_SESSION['file_res']['pass']) ? 'hide decrypted' : 'crypted' ?>" src="/_assets/img/svg/eye.svg" alt="Crypt/Decrypt">
            <img class="pass__input_copy js-pass-copy <?= empty($_SESSION['file_res']['pass']) ? 'hide' : '' ?>" src="/_assets/img/svg/copy.svg" alt="Copy">
        </div>
        <div class="pass__input pass__input_note js-field">
            <textarea class="js-input-note js-crypt <?= empty($_SESSION['file_res']['note']) ? 'decrypted empty' : 'crypted' ?>" name="note" autocomplete="off" rows="8" cols="80" <?= empty($_SESSION['file_res']['note']) ? '' : 'disabled' ?>><?= $_SESSION['file_res']['note'] ?></textarea>
            <img class="pass__input_crypt textarea_crypt js-crypt-decrypt <?= empty($_SESSION['file_res']['note']) ? 'hide decrypted' : 'crypted' ?>" src="/_assets/img/svg/eye.svg" alt="Crypt/Decrypt">
            <img class="pass__input_copy textarea_copy js-pass-copy <?= empty($_SESSION['file_res']['note']) ? 'hide' : '' ?>" src="/_assets/img/svg/copy.svg" alt="Copy">
        </div>

        <div class="pass__buttons">
            <div class="pass__buttons_link js-pass-save hide">Сохранить</div>
            <div class="pass__buttons_link js-tree-path" target="<?= $_SESSION['backpath'] ?>">Отмена</div>
        </div>
    </div>

</div>

<?php session_write_close(); ?>
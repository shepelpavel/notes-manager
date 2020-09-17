<?php
include $_SERVER['DOCUMENT_ROOT'] . '/core/config.php';
session_start();

function getDirContents($dir, $len, &$results = array())
{
    $files = scandir($dir);
    foreach ($files as $value) {
        $path = $dir . DIRECTORY_SEPARATOR . $value;
        if (!is_dir($path)) {
            $results[] = substr($path, $len + 1);
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $len, $results);
        }
    }
    return $results;
}

$all_json = getDirContents($BASEPATH, strlen($BASEPATH));

?>

<div class="content allpass">

    <h2>All pass</h2>

    <div class="allpass__buttons">
        <div class="button allpass__buttons_button allpass__buttons_decrypt js-decrypt-all">
            Decrypt all
        </div>
        <div class="button allpass__buttons_button allpass__buttons_backup js-make-backup">
            Make backup
        </div>
    </div>

    <div class="js-allpass-body">
        <?php foreach ($all_json as $val) {
            $file_res = json_decode(file_get_contents($BASEPATH . $val), true);
        ?>
            <div class="allpass__item js-allpass-item">
                <h3 class="allpass__item_field allpass__item_name js-allpass-path"><?= $val ?></h3>
                <div class="allpass__item_label"><sub>login</sub></div>
                <p class="allpass__item_field js-allpass-field js-allpass-login"><?= $file_res['login'] ?></p>
                <div class="allpass__item_label"><sub>pass</sub></div>
                <p class="allpass__item_field js-allpass-field js-allpass-pass"><?= $file_res['pass'] ?></p>
                <div class="allpass__item_label"><sub>link</sub></div>
                <p class="allpass__item_field js-allpass-field js-allpass-link"><?= $file_res['link'] ?></p>
                <div class="allpass__item_label"><sub>note</sub></div>
                <p class="allpass__item_field js-allpass-field js-allpass-note"><?= $file_res['note'] ?></p>
            </div>
            <hr>
        <?php } ?>
    </div>

</div>

<?php session_write_close(); ?>
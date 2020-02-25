<?php
require_once 'admin-setup.php';
login_required();

if(!qp_set('id')) {
    redirect(uri_resolve('/admin/releases'));
}

$id = qp_get('id');

if(!is_numeric($id)) {
    redirect(uri_resolve('/admin/releases'));
}

$id = (int) $id;

$release = PH_Query::release([
    "==id" => $id
]);

if(count($release) > 0) $release = $release[0];
else redirect(uri_resolve('/admin/releases'));

admin_template("Release " . $release->name, $menu, function() {
    global $release;
    ?>
    <a href="<?= uri_resolve('/admin/releases') ?>" class="link">🠐 Releases</a>
    <h1>Release <?= $release->name ?></h1>
    <?php

    $zip_downloaded = false;
    $zip_unpacked = false;

    if(file_exists(ROOT . 'releases/zip/' . $release->id . '.zip')) {
        if(filesize(ROOT . 'releases/zip/' . $release->id . '.zip') > 0) {
            $zip_downloaded = true;
        }
    }

    if(is_dir(ROOT . 'releases/unpacked/' . $release->id . '/')) {
        $zip_unpacked = true;
    }

    ?>
    <span style="display:none;" id="ID"><?= $release->id ?></span>
    <ul>
        <li>Downloaded: <i><?= $zip_downloaded ? "Yes" : "No" ?></i></li>
        <li>Unpacked: <i><?= $zip_unpacked ? "Yes" : "No" ?></i></li>
        <li>Installed: <i><?= $release->version_string == RELEASE_VERSION ? "Yes" : "No" ?></i></li>
    </ul><br><br>
    <?php
    if(!$zip_downloaded) {
        ?>
        <a href="#" class="button" id="download">Download</a>
        <?php
    } else {
        ?>
        <span class="tag blue">Already downloaded!</span>
        <?php
    }
    ?>
    <a href="#" class="button" id="install">Install</a>
    <br><br>
    <p><i><span id="status"></span></i></p>

    <script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
    <script src="<?= uri_resolve('/admin/js/install.js') ?>"></script>
    <?php
}, 'collection:settings', 'releases');

?>
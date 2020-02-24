<?php
require_once 'admin-setup.php';
login_required();

if(!qp_set('id')) {
    redirect(uri_resolve('/admin/releases'));
}

$id = qp_get('id');
$data = PH_Github::getReleaseInfo($id);

admin_template("Installing update...", $menu, function() {
    global $data, $id;
    ?>
    <span style="display:none;" id="update-id"><?= $id ?></span>
    <h1>Installing Update <?= isset($data->name) ? $data->name : null ?></h1>
    <p><i id="tasktext">Checking install...</i></p>
    <progress id="install-progress", value="0" max="100">0%</progress>

    <script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
    <script src="<?= uri_resolve('/admin/js/install.js') ?>"></script>
    <?php
}, 'collection:settings', 'releases');
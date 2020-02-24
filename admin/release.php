<?php
require_once 'admin-setup.php';
login_required();

if(!qp_set('id')) {
    redirect(uri_resolve('/admin/releases'));
}

$id = qp_get('id');

$data = PH_Github::getReleaseInfo($id);

admin_template("Release " . $data->name, $menu, function() {
    global $data;
    ?>
    <h1>Release <?= $data->name ?></h1>
    <p>
        <?php
        var_dump($data->zipball_url);
            if($data->tag_name == RELEASE_VERSION) {
                ?>
                <i>This is already the current version! Installing it won't make a difference...</i>
                <?php
            }
        ?>
    </p>
    <a href="<?= uri_resolve('/admin/install_release?id=' . $data->id) ?>" class="button">Install</a>
    <?php
}, 'collection:settings', 'releases');

?>
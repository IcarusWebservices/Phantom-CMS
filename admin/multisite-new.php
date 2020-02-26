<?php
require_once 'admin-setup.php';
login_required();

admin_template('New site', $menu, function() {
    ?>
    <h1>New site</h1>
    <form action="<?= uri_resolve('/admin/actions/multisite?mode=new') ?>" method="post">
        <div class="field">
            Website Name: <input type="text" name="name" placeholder="The display name of the website">
        </div>
        <div class="field">
            Website Slug: <input type="text" name="slug" placeholder="Used within the url. May not contain spaces or special characters">
        </div>
        <input type="submit" value="Save">
    </form>
    <?php
}, 'collection:settings', 'multisite');
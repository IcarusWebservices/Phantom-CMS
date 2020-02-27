<?php
require_once 'admin-setup.php';
login_required();

admin_template('New site', $menu, function() {
    ?>
    <h1>New site</h1>
    <form action="<?= uri_resolve('/admin/actions/multisite?mode=new') ?>" method="post" class="form flat placeholders narrow">
        <div class="field">
            <input type="text" name="name" placeholder="The display name of the website" autocomplete="off">
            <label for="name"><span>Website name</span></label>
        </div>
        <div class="field">
            <input type="text" name="slug" placeholder="Used within the url. May not contain spaces or special characters" autocomplete="off">
            <label for="slug"><span>Website slug</span></label>
        </div>
        <input type="submit" value="Save">
    </form>
    <?php
}, 'collection:settings', 'multisite');
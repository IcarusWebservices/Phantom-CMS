<?php
require_once 'admin-setup.php';
login_required();

if(!qp_set('id')) {
    redirect(uri_resolve('/admin/multisite'));
}

$id = qp_get('id');

$target_site = PH_Query::sites([
    "==site_id" => $id
]);

if(count($target_site)>0) {
    $target_site = $target_site[0];
} else redirect(uri_resolve('/admin/multisite'));

// var_dump(qp_set('id'));

admin_template("Clone Site", $menu, function() {
    global $target_site;
    ?>
    <h1>Clone "<?= $target_site->name ?>"</h1>
    <form action="" method="post">
        <div class="field">
            Website Name: <input type="text" name="name" placeholder="The display name of the website">
        </div>
        <div class="field">
            Website Slug: <input type="text" name="slug" placeholder="Used within the url. May not contain spaces or special characters">
        </div>
        <div class="field">
            <h3>What to clone</h3>
            <label class="control control-checkbox">
            Records
                <input type="checkbox" class="select-row" name="clone-records">
                <div class="control-indicator"></div>
            </label>
            <label class="control control-checkbox">
            Logic packs
                <input type="checkbox" class="select-row" name="clone-logic-packs">
                <div class="control-indicator"></div>
            </label>
        </div>
        <input type="submit" value="Clone">
    </form>
    
    <?php
}, 'collection:settings', 'multisite');
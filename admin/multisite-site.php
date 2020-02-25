<?php
require_once 'admin-setup.php';
login_required();

if(!qp_set('id')) redirect('/admin/multisite');

admin_template("Multisite", $menu, function() {
    $id = qp_get('id');

    if(!is_numeric($id)) redirect('/admin/multisite');

    $id = (int) $id;

    $site = PH_Query::sites([
        "==site_id" => $id 
    ]);

    if(count($site) > 0) {
        $site = $site[0];
    } else redirect('/admin/multisite');

?>
<h1>Site "<?= $site->name ?>"</h1>
<form action="<?= uri_resolve('/admin/actions/multisite?mode=edit') ?>" method="post">
    <input type="hidden" name="id" value="<?= $site->id ?>">
    <div class="field">
        Website Name: <input type="text" name="name" placeholder="The display name of the website" value="<?= $site->name ?>">
    </div>
    <div class="field">
        Website Slug: <input type="text" name="slug" placeholder="Used within the url. May not contain spaces or special characters" value="<?= $site->slug ?>">
    </div>
    <input type="submit" value="Save">
</form>
<?php
}, 'collection:settings', 'multisite');

<?php
require_once 'admin-setup.php';
login_required();


admin_template("Multisite", $menu, function() {
?>
<h1>Multisite</h1>
<small>Warning, this is an advanced setting.</small>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Slug</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $sites = PH_Query::sites([]);
            foreach ($sites as $st) {
                ?>
                <tr>
                    <td><?= $st->id ?></td>
                    <td><?= $st->slug ?></td>
                    <td><?= $st->name ?></td>
                    <td><a href="<?= uri_resolve('/admin/multisite-clone?id=' . $st->id) ?>" data-id="<?= $st->id ?>"><span class="tag blue">Clone</span></a> <a href="#" data-id="<?= $st->id ?>"><span class="tag red">Delete</span></a></td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<?php
}, 'collection:settings', 'multisite');

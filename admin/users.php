<?php
require_once 'admin-setup.php';
login_required();


admin_template("Users", $menu, function() {
    $users = PH_Query::users([]);
?>
<h1>Users</h1>
<table id="records-table">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email-adress</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($users as $user) {
                ?>
                <tr>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td>
                        <?php
                            // var_dump(session()->user->id);
                            if(session()->user->id != $user->id) {
                                ?><a href="<?= uri_resolve('/admin/actions/user?action=delete&id=' . $user->id) ?>" class="link">Delete</a><?php
                            } else echo "(Cannot delete self)";
                        ?>
                        
                    </td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<?php
}, "collection:settings", "users");
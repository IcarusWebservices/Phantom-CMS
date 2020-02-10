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
                        <a href="#" class="link">Delete</a>
                    </td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<?php
}, "collection:settings", "users");
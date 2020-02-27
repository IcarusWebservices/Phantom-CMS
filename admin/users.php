<?php
require_once 'admin-setup.php';
login_required();


admin_template("Users", $menu, function() {
    $users = PH_Query::admin_users([]);
?>
<div id="user-creation" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close-modal">&times;</span>
            <i class="fas fa-users circle-icon"></i>
        </div>
        <div class="modal-body">
            <h3>Add user</h3>
            <form id="newuserform" class="form flat">
                <div class="field">
                    <input type="text" id="username" name="username" placeholder=" " autocomplete="off">
                    <label for="username"><span>Username</span></label>
                </div>
                <div class="field">
                    <input type="email" id="email" name="email" placeholder=" " autocomplete="off">
                    <label for="email"><span>Email</span></label>
                </div>
                <div class="field">
                    <input type="password" id="password" name="password" placeholder=" " autocomplete="new-password">
                    <label for="password"><span>Password</span></label>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="action">
                <a class="button semi-rounded outline cancel">Cancel</a>
                <a class="button semi-rounded" id="createuser">Create</a>
            </div>
        </div>
    </div>
</div>

<h1>Users</h1>
<a href="#" class="button" id="newuseropen">New user</a>
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
                                ?><a data-delete-id="<?= $user->id ?>" class="link delete-user" href="#">Delete</a><?php
                            } else echo "(Cannot delete self)";
                        ?>
                        
                    </td>
                </tr>
                <?php
            }
        ?>
    </tbody>
</table>
<script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
<script src="<?= uri_resolve('/admin/js/users.js') ?>"></script>
<?php
}, "collection:settings", "users");
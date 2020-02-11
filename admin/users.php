<?php
require_once 'admin-setup.php';
login_required();


admin_template("Users", $menu, function() {
    $users = PH_Query::users([]);
?>
<div id="user-creation" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <span class="close">&times;</span>
    <h2>Add user</h2>
  </div>
  <div class="modal-body">
    <form id="newuserform">
        <p>Username: <input type="text" id="username" name="username" autocomplete="nope"></p>
        <p>Email: <input type="email" id="email" name="email"></p>
        <p>Password: <input type="password" id="password" autocomplete="new-password" name="password"></p>
    </form>
  </div>
  <div class="modal-footer">
    <h3><a href="#" id="createuser">Create</a></h3>
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
<?php
require_once 'admin-setup.php';
login_required();

admin_template("Dashboard", $menu, function() {
?>

<div style="display:block;width:100%;height:100%;background-color:white;">
    <h1>Heya</h1>
</div>

<?php
}, "item:dashboard", null);
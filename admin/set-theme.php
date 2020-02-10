<?php
require_once 'admin-setup.php';
login_required();


admin_template("Theme", $menu, function() {
    ?>

    <?php
}, "collection:appearance", "theme");
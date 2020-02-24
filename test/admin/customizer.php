<?php
require_once 'admin-setup.php';
login_required();

admin_template("Customizer", $menu, function() {

    ?>
    <iframe src="<?= uri_resolve('/') ?>" frameborder="0" style="width:100%; height: 700px; border: 1px solid black ;display: block;"></iframe>
    <?php

}, "item:dashboard", null);
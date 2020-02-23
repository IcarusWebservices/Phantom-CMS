<?php
require_once 'admin-setup.php';
login_required();


admin_template("Dashboard", $menu, function() {
global $config, $site;
?>

<div style="display:block;width:100%;height:100%;background-color:white;">
    <?php
        if($config->is_multisite) {
            ?>
            <h3>Multisite network enabled!</h3>
            <?php
        }
    ?>
</div>

<?php
}, "item:dashboard", null);
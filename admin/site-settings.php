<?php
require "admin-setup.php";
login_required();

admin_template("Site settings", $menu, function() {
?>
<h1>Site Settings</h1>
<ul>
    <li><a href="<?= uri_resolve('/admin/logic-packs') ?>" class="link">🛠 Logic Packs</a></li>
</ul>
<?php
}, 'collection:settings', 'site-settings');
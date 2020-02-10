<?php
/**
 * Settings display
 */
require_once 'admin-setup.php';
login_required();

admin_template("Settings", $menu, function() {
    global $theme_folder;
    ?>
    <div class="" id="snackbar-saved">Setting saved!</div>
    <h1>Settings</h1>
    <div>
        <label for="theme_name">Theme: </label>
        
        <select name="theme_name" id="theme">
            <?php
            
            foreach (glob(DATA . 'themes/*') as $dir) {
                
                $name = substr($dir, strlen(DATA . 'themes/'));
                if(is_dir($dir)) {
                    ?><option value="<?= $name ?>" <?php
                        if($name == $theme_folder) {
                            echo "selected";
                        }
                    ?>><?= $name ?></option><?php
                }
            }

            ?>
        </select>
        <button id="save-theme">Save</button>
    </div>
    <script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
    <script src="<?= uri_resolve('/admin/js/settings.js') ?>"></script>
    <?php
}, 'item:settings');
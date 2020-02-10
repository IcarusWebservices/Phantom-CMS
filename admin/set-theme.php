<?php
require_once 'admin-setup.php';
login_required();


admin_template("Theme", $menu, function() {
    global $theme_folder;
    $themes = PH_Loader::getValidThemes();
    // var_dump($themes);
    ?>
    <h1>Set Theme</h1>
    <?php
        foreach ($themes as $id => $values) {
            
            ?>
            <div class="card">
                <h3><?= $values["themeName"] ?></h3>
                <?php
                // echo $id . ' ' . $theme_folder;
                if($id != $theme_folder) {
                    ?><a href="<?= uri_resolve('/admin/actions/set-theme') ?>" class="link">Set active!</a><?php
                } else {
                    ?>Already active!<?php
                }
                ?>
                
            </div>
            <?php
        }
    ?>
    
    <?php
}, "collection:appearance", "theme");
<?php
require_once 'admin-setup.php';
login_required();

if($site_id) {
    $q_theme = PH_Query::settings([
        "==setting_key" => "appearance_theme",
        "==site" => $site_id
    ]);
} else {
    $q_theme = PH_Query::settings([
        "==setting_key" => "appearance_theme",
        "NLsite" => null
    ]);
}

if(count($q_theme)>0) {
    $theme_folder = $q_theme[0]->value;
} else {
    $theme_folder = null;
}

admin_template("Theme", $menu, function() {
    global $theme_folder;
    $themes = PH_Loader::getValidThemes();
    // var_dump($themes);
    ?>
    <h1>Set Theme</h1>
    <div class="polaroid-grid">
        <?php
            foreach ($themes as $id => $values) {
                
                ?>
                <div class="polaroid">
                    <div class="polaroid-top"></div>
                    <div class="polaroid-bottom">
                        <div class="polaroid-content">
                            <h3><?= $values["themeName"] ?></h3>
                            <?php
                            // echo $id . ' ' . $theme_folder;
                            if($id != $theme_folder) {
                                ?><a href="<?= uri_resolve('/admin/actions/set-theme?theme=' . $id) ?>" class="link">Set active!</a><?php
                            } else {
                                ?>Already active!<?php
                            }
                            ?>
                        </div>
                    </div>                    
                </div>
                <?php
            }
        ?>
    </div>
    
    <?php
}, "collection:appearance", "theme");
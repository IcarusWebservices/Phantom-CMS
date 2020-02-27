<?php
require "admin-setup.php";
login_required();

admin_template("Site settings", $menu, function() {
global $config, $q_site;
?>
<a href="<?= uri_resolve('/admin/site-settings'); ?>" class="link">🠐 Site settings</a>
<h1>Logic packs</h1>
<?php

$editing_for_site = null;

if($config->is_multisite) {
    ?><p> Editing for site: <?php
    if($q_site) {
        $editing_for_site = $q_site;
        echo $q_site->name;
    } else {
        echo "-- Main --";
    }
    ?></p><?php
}
?>
<form action="<?= uri_resolve('/admin/actions/save-logic-packs') ?>" method="post">
<table>
    <thead>
        <tr>
            <th>Enabled</th>
            <th>Name</th>
            <th>Folder</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $folders = glob(DATA . 'logic-packs/*');

        if($q_site) {
            $w = [
                "==site" => $q_site->id
            ];
        } else {
            $w =[
                "NLsite" => null
            ];
        }
        $loaded_packs = PH_Query::logic_packs($w);

        foreach ($folders as $folder) {
            if(file_exists($folder . '/logic-pack.json')) {
                $json_raw = file_get_contents($folder . '/logic-pack.json');

                $en = json_decode($json_raw);

                if($en) {
                    if(isset($en->logicPackName)) {

                        $folder_name = substr($folder, strlen(DATA . 'logic-packs/'));

                        ?>
                        <tr>
                            <td><input type="checkbox" name="enabled[]" value="<?= $folder_name ?>" <?php
                                foreach ($loaded_packs as $pck) {
                                    if($pck->folder_name == $folder_name) {
                                        echo "checked";
                                    }
                                }
                            ?>></td>
                            <td><?= $en->logicPackName ?></td>
                            <td><?= $folder_name ?></td>
                        </tr>
                        <?php
                    }

                }

            }
        }

        ?>
    </tbody>
</table>
<input type="submit" value="Save">
</form>

<?php
}, 'collection:settings', 'site-settings');
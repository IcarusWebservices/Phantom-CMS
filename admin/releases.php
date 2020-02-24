<?php
require_once 'admin-setup.php';
login_required();

admin_template("Releases", $menu, function() {

    $ch = curl_init('https://api.github.com/repos/IcarusWebservices/Phantom-CMS/releases');
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $github_response = curl_exec($ch);

    var_dump($github_response);

    $json = json_decode($github_response);

    ?>
    <h1>Releases</h1>
    <?php

    if($json) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>
                        Version
                    </th>
                    <th>
                        Release Name
                    </th>
                </tr>
            </thead>
            <tbody>
        <?php
        $curr_found = false;
        foreach ($json as $release) {
            ?>
            <tr>
                <th><?php
                    if($release->tag_name == RELEASE_VERSION) {
                        $curr_found = true;
                        ?>
                        <span class="tag blue">Current Version</span>
                        <?php
                    } elseif($curr_found) {
                        ?>
                        <span class="tag red">Older Version</span>
                        <?php
                    } else {
                        ?>
                        <span class="tag green">Newer version</span>
                        <?php
                    }
                ?></th>
                <th><a href="<?= uri_resolve('/admin/release?id=' . $release->id) ?>" class="link"><?= isset($release->name) ? $release->name : "Untitled (Not recommended downloading this version)" ?></a></th>
            </tr>
            <h2></h2>
            <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <strong>Updating service unavailable!</strong>
        <?php
    }
}, 'collection:settings', 'releases');
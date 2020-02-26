<?php
require_once 'admin-setup.php';
login_required();

admin_template("Releases", $menu, function() {

    $releases = PH_Query::release([]);
    ?>
    <a href="#" class="link" id="reload">Reload</a>
    <h1>Releases</h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Version</th>
                <th>Name</th>
                <th>Released at</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($releases as $release) {
                ?>
                <tr>
                    <td><?php
                        if($release->is_current_version) {
                            ?>
                            <span class="tag blue">Current</span>
                            <?php
                        }
                    ?></td>
                    <td><?= $release->version_string ?></td>
                    <td><?= $release->name ?></td>
                    <td><?= $release->released_at ?></td>
                    <td><a href="<?= uri_resolve('/admin/release?id=' . $release->id) ?>" class="link">Install</a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
    <script>
        let reload = document.getElementById('reload');
        reload.addEventListener('click', (e) => {
            DoAjaxGet('actions/reload-releases',(s) => {
                window.location.reload();
            })
        })
    </script>
    <?php
}, 'collection:settings', 'releases');
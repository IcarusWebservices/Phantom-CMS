<?php
require 'admin-setup.php';
login_required();
if(!qp_set('type')) redirect(uri_resolve('/admin'));
$type = qp_get('type');
if(!registry()->has(CAT_RECORD_MESSAGES, $type)) redirect(uri_resolve('/admin'));
admin_template('Messages', $menu, function() {
    global $type, $site_id;

    $records = PH_Query::records([
        "==record_type" => $type,
        "==site" => $site_id
    ]);

    $export = registry()->get(CAT_RECORD_MESSAGES, $type);

    $display = $type;

    if($export) {
        if($export->hasProperty('displayName')) {
            $display = $export->getProperty('displayName');
        }
    }

    ?>
    <h1><?= $display ?></h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Send on</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($records as $record) {
                    ?>
                    <tr>
                        <td></td>
                        <td><a href="<?= uri_resolve('/admin/message?id=' . $record->id) ?>" class="link"><?= $record->title ?></a></td>
                        <td><?= $record->created_gmt ?></td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <?php

}, 'collection:messages', $type);
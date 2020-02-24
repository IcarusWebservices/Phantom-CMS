<?php
require_once 'admin-setup.php';
login_required();

if(!qp_set('recordtype')) {
    redirect(uri_resolve('/admin'));
}

$type = qp_get('recordtype');

admin_template("Taxonomy", $menu, function() {
    global $type;
    ?>
    <h1>Taxonomy (<?= $type ?>)</h1>
    <table id="records-table">
        <thead>
            <tr class="action-overlay">
                <th></th>
                <th class="items-selected">1 item selected</th>
                <th class="table-actions">
                    <img src="/admin/img/trashcan.svg" alt="Delete" class="table-delete" id="delete">
                    <img src="/admin/img/ellipsis.svg" alt="Menu" class="table-ellipsis">
                </th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Taxonomy terms</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $records = PH_Query::records([
                "==record_type" => $type
            ]);
            // var_dump($records);
            foreach ($records as $record) {

                $taxonomy = PH_Query::taxonomy([
                    "==record_id" => $record->id
                ]);

                ?>
                <tr data-id="<?= $record->id ?>">
                    <td><?= $record->id ?></td>
                    <td><a class="link" href="<?= uri_resolve("/admin/taxonomy?id=" . $record->id) ?>"><?= $record->title ?></a></td>
                    <td>
                        <?php
                            foreach ($taxonomy as $term) {
                                ?><span class="tag green"><?= $term->type ?>: <?= $term->value ?></span> <?php
                            }
                        ?>
                        
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
    <?php
}, "collection:taxonomy", $type . '_tax');
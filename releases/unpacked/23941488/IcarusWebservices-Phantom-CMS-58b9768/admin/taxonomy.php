<?php
require_once 'admin-setup.php';
login_required();

if(!qp_set('id')) {
    redirect(uri_resolve('/admin'));
}

$id = (int) qp_get('id');
$record = PH_Query::records([
    "==record_id" => $id
]);

if(count($record) > 0) {
    $record = $record[0];
    $type = $record->type;
} else redirect(uri_resolve('/admin'));

admin_template("Taxonomy", $menu, function() {
    global $record;

    $taxonomy = PH_Query::taxonomy([
        "==record_id" => $record->id
    ]);

    $terms = [];

    foreach ($taxonomy as $row) {
        if(isset($terms[$row->type])) {
            if(is_array($terms[$row->type])) {
                array_push($terms[$row->type], $row);
            } else {
                $terms[$row->type] = [$row];
            }
        } else {
            $terms[$row->type] = [$row];
        }
        
    }

    ?>
    <h1>Taxonomy for "<?= $record->title ?>"</h1>
    <div class="types" style="margin: 20px;" id="types">
        <?php
            foreach ($terms as $type => $values) {
                ?>
                <div class="type" style="margin: 20px 0;">
                    <h3>Type: <?= $type ?></h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($values as $value) {
                                    ?>
                                    <tr>
                                        <th><?= $value->id ?></th>
                                        <th><?= $value->value ?></th>
                                        <th><a href="#" class="link deleteterm" data-id="<?= $value->id ?>">Delete term</a></th>
                                    </tr>
                                    <?php
                                }
                            ?>
                            <tr>
                                <th>Add</th>
                                <th><input type="text" id="<?= $type ?>:term" style="height: 20px"></th>
                                <th><a href="#" class="link addterm" data-record="<?= $record->id ?>" data-for-type="<?= $type ?>">Add term</a></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
            }
        ?>
        
    </div>
    <hr><br><br><br>
    <h2>Add new type</h2>
    <table style="margin: 20px;">
        <thead>
            <tr>
                <th></th>
                <th>Type name</th>
                <th>First value</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <th><input type="text" id="typeaddname" style="height: 20px"></th>
                <th><input type="text" id="typeaddfirst" style="height: 20px"></th>
                <th><a href="#" class="link" id="addtype" data-record="<?= $record->id ?>">Add Type</a></th>
            </tr>
        </tbody>
    </table>
    <script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
    <script src="<?= uri_resolve('/admin/js/taxonomy.js') ?>"></script>
    <?php
}, "collection:taxonomy", $type . '_tax');
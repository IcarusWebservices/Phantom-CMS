<?php
/**
 * Records overview page
 */
require_once 'admin-setup.php';
login_required();

if(!qp_set('type')) {
    redirect(uri_resolve('/admin/index'));
}

$type = qp_get('type');

$rtype = registry()->get(CAT_RECORD_TYPES, $type);

if(!$rtype) redirect(uri_resolve('/admin/index'));

$title = $rtype->hasProperty('displayName') ? $rtype->getProperty('displayName') : $type;

admin_template($title, $menu, function() {
    global $title, $type;
?>
    <h1><?= $title ?></h1>
    <a href="<?= uri_resolve('/admin/record?mode=new&type=' . $type) ?>" class="link">New record</a>
    
    <table id="records-table">
        <thead>
            <tr>
                <th><input type="checkbox" data-behaviour="tableCheckboxSelectAll" class="select-all"></th>
                <th>Name</th>
                <th>Created</th>
                <th>Status</th>
                <th>Author</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $records = PH_Query::records([
                "==record_type" => $type
            ]);
            // var_dump($records);
            foreach ($records as $record) {
                $time = new DateTime($record->created_gmt);
                ?>
                <tr data-id="<?= $record->id ?>">
                    <td><input type="checkbox" class="select-row" data-id="<?= $record->id ?>"></td>
                    <td><a class="link" href="<?= uri_resolve("/admin/record.php?mode=edit&id=" . $record->id) ?>"><?= $record->title ?></a></td>
                    <td><?= $time->format("l d F Y") . " at " . $time->format("g:i a") ?></td>
                    <td><?= $record->status ?></td>
                    <td>
                        <?php
                            $u = PH_Query::users([
                                "==id" => $record->author
                            ]);

                            if(count($u) > 0) {
                                $u = $u[0];

                                echo $u->username;
                            }
                        ?>
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
    <script src="<?= uri_resolve('/admin/js/records-overview.js') ?>"></script>
<?php
}, 'collection:recordtypes', $type);
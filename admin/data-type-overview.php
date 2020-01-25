<?php
include "setup.php";
include "admin-setup.php";

if(!ph_qp_set("datatype")) {
    ph_redirect("admin/");
    die();
}

$dt_id = ph_qp_get("datatype");

$dt_retr = ph_get_registered_item("@this", "datatypes", $dt_id);

if(!$dt_retr) {
    ph_redirect("admin/");
    die();
}

$dt_name = $dt_retr["displayTitle"];

ph_admin_template($dt_name, $menu, function() {
    global $dt_name, $dt_id, $project;
?>
<phantom-data>
    <variable name="data-type-id"><?= $dt_id ?></variable>
</phantom-data>

<h1><?= $dt_name ?></h1>

<table id="records-table">
    <thead>
        <tr>
            <th><input type="checkbox" data-behaviour="tableCheckboxSelectAll"></th>
            <th>Name</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $records = PH_Query::get_record_listing_by_datatype($project, $dt_id);

        foreach ($records as $record) {
            $time = new DateTime($record->created_at);
            ?>
            <tr>
                <th><input type="checkbox" data-behaviour="tableCheckboxSelectThisRow"></th>
                <th><a class="link" href="<?= ph_uri_resolve("admin/record.php?action=edit&id=" . $record->id) ?>"><?= $record->title ?></a></th>
                <th><?= $time->format("l d F Y") . " at " . $time->format("g:i a") ?></th>
            </tr>
            <?php
        }
    ?>
    </tbody>
</table>
<?php
}, "collection:datatypes", $dt_id);

?>
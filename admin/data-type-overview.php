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
    global $dt_name, $dt_id;
?>
<phantom-data>
    <variable name="data-type-id"><?= $dt_id ?></variable>
</phantom-data>

<h1><?= $dt_name ?></h1>

<table id="entries-table">
    <thead>
        <tr>
            <th><input type="checkbox" data-behaviour="tableCheckboxSelectAll"></th>
            <th>Name</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="checkbox" data-behaviour="tableCheckboxSelectRow"></td>
            <td>Test item 1</td>
            <td>Some date</td>
        </tr>
        <tr>
            <td><input type="checkbox" data-behaviour="tableCheckboxSelectRow"></td>
            <td>Test item 2</td>
            <td>Some other date</td>
        </tr>
        <tr>
            <td><input type="checkbox" data-behaviour="tableCheckboxSelectRow"></td>
            <td>Test item 3</td>
            <td>Wait? ANOTHER DATe?!!?</td>
        </tr>
    </tbody>
</table>

<script src="<?= ph_uri_resolve("admin/js/build/build.js") ?>"></script>
<script>

    let selection = ph._("#entries-table").behaviour(new PhantomTableBehaviour())
    console.log(selection);

</script>
<?php
}, "collection:datatypes", $dt_id);

?>
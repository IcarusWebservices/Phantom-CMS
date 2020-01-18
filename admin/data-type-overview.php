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

<table id="records-table">
    <thead>
        <tr>
            <th><input type="checkbox" data-behaviour="tableCheckboxSelectAll"></th>
            <th>Name</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

<script src="<?= ph_uri_resolve("admin/js/build/build.js") ?>"></script>
<script>

    // let selection = ph._("#entries-table").behaviour(new PhantomTableBehaviour())
    
    let recordsTable = ph._("#records-table");

    let body = recordsTable.Arr()[0]._("tbody");
    let rows = body.Arr()[0]._("tr");

    let records = ph.Api.getRecordsList("example", "blogpost").then((response) => {

        let records = response.data;
        console.log(response);
        records.forEach(record => {

            let rowElement = document.createElement("tr");

            let checkBox = document.createElement("input");
            checkBox.type = "checkbox";
            checkBox.dataset.behaviour = "tableCheckboxSelectRow";

            let cols = [{
                element: 'td',
                child: checkBox
            }, {
                element: 'td',
                child: document.createTextNode(record.title)
            }, {
                element: 'td',
                child: document.createTextNode(record.created_at)
            }];

            cols.forEach(collumn => {
                let element = document.createElement(collumn.element);
                let child = collumn.child;

                element.appendChild(child);

                rowElement.appendChild(element);
            })

            body.Arr()[0].element.appendChild(rowElement);
        })

        
    }).catch((response) => {
        console.log(response);
    });

    

    

</script>
<?php
}, "collection:datatypes", $dt_id);

?>
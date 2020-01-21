<?php
require "setup.php";
require "admin-setup.php";

define("MODE_NEW", 1);
define("MODE_EDIT", 2);

$action_mode = MODE_NEW;

$edit_mode_record = null;

$datatype = null;

if(ph_qp_set("action")) {

    $a = ph_qp_get("action");
    $a = strtolower($a);

    switch($a) {
        case "edit":
            if(ph_qp_set("id")) {

                $id = ph_qp_get("id");

                $record = PH_Query::get_record_by_id($id);

                if(!$record) {
                    ph_redirect("admin/");
                    die;
                } else {
                    $edit_mode_record = $record;
                    $datatype = $edit_mode_record->data_type_name;
                }

            } else {
                ph_redirect("admin/");
                die;
            }
        break;
    }

}

$editors = $projectVars["editors"];

$res = $editors->checkSet("datatypes", $datatype, "primary");
var_dump($res);

ph_admin_template("Record", $menu, function() {
global $edit_mode_record;
?>
<h1><?= $edit_mode_record->title; ?></h1>
<?php
})
?>
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
?>



<?php
}, "collection:datatypes", $dt_id);

?>
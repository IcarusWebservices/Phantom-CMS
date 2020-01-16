<?php
defined("PH_ROOT") or die("setup.php is required to be included first");

if(!session()->is_logged_in) {
    ph_redirect("admin/login.php");
    die();
}

if(session()->isset("working-project")) {
    $project = session()->get("working-project");
} else {
    ph_redirect("admin/set-project.php");
}

ph_autoload(PH_ROOT . 'admin/includes/');

ph_admin_project_loader($project);

$datatypes = ph_registry_get_category("@this", "datatypes");

$menu = [
    "Dashboard",
    "Data Types" => $datatypes
];
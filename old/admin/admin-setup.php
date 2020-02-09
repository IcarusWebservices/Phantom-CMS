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

$projectVars = ph_admin_project_loader($project);

$datatypes = ph_registry_get_category("@this", "datatypes");

$menu_items = [];

foreach ($datatypes as $key => $value) {
    $menu_items[$key] = [
        "display" => $value["displayTitle"],
        "url_to" => "data-type-overview.php?datatype=" . $key
    ];
}

$menu = [
    "item:dashboard" => [
        "display" => "Dashboard",
        "url_to" => "index.php"
    ],
    "collection:datatypes" => [
        "display" => "Data",
        "items" => $menu_items
    ]
];
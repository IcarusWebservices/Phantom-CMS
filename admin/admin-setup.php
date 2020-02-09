<?php
session_start();
// Root value
define("ROOT", dirname(dirname(__FILE__)) . '/');
require_once ROOT . 'ph-setup.php';
load_recursively(ROOT . 'admin/includes/');

$record_types = registry()->getCategory('');

$menu = [
    "item:dashboard" => [
        "display" => "Dashboard",
        "url_to" => "index"
    ],
    "collection:datatypes" => [
        "display" => "Records",
        "items" => $menu_items
    ]
];
<?php
session_start();
// Root value
define("ROOT", dirname(dirname(__FILE__)) . '/');
require_once ROOT . 'ph-setup.php';
load_recursively(ROOT . 'admin/includes/');

$menu = [
    "item:dashboard" => [
        "display" => "Dashboard",
        "url_to" => "index"
    ]
];
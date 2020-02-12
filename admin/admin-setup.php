<?php
session_start();
// Root value
define("ROOT", dirname(dirname(__FILE__)) . '/');
require_once ROOT . 'ph-setup.php';
load_recursively(ROOT . 'admin/includes/');

$record_types = registry()->getCategory(CAT_RECORD_TYPES);

/**
 * Requested stylesheets for the admin pages
 * 
 * @since 2.0.0
 */
$requested_stylesheets = [];

/**
 * Requested header scripts 
 * 
 * @since 2.0.0
 */
$requested_header_scripts = [];

/**
 * Requested body scripts
 * 
 * @since 2.0.0
 */
$requested_body_scripts = [];

$record_types_items = [];
$taxonomy_items = [];

foreach ($record_types as $name => $export) {

    if($export->getProperty('displayInAdmin')) {

        $display = $export->name;

        if($export->hasProperty('displayName')) {
            $display = $export->getProperty('displayName');
        }

        $record_types_items[$export->name] = [
            "display" => $display,
            "url_to" => "records-overview?type=" . $export->name
        ];

        $taxonomy_items[$export->name . "_tax"] = [
            "display" => $display,
            "url_to" => "taxonomy-overview?recordtype=" . $export->name
        ];

    }

    
}

$menu = [
    "item:dashboard" => [
        "display" => "Dashboard",
        "url_to" => "index"
    ],
    "collection:recordtypes" => [
        "display" => "Records",
        "items" => $record_types_items
    ],
    "collection:taxonomy" => [
        "display" => "Taxonomy",
        "items" => $taxonomy_items
    ],
    "collection:appearance" => [
        "display" => "Appearance",
        "items" => [
            "theme" => [
                "display" => "Theme",
                "url_to" => "set-theme"
            ],
            "strings" => [
                "display" => "Strings",
                "url_to" => "strings-overview"
            ]
        ]
    ],
    "collection:settings" => [
        "display" => "Settings",
        "items" => [
            "users" => [
                "display" => "Users",
                "url_to" => "users"
            ]
        ]
    ],
    
];
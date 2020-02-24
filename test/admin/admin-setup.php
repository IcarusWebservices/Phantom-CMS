<?php
session_start();

// Root value
define("ROOT", dirname(dirname(__FILE__)) . '/');
require_once ROOT . 'ph-setup.php';
load_recursively(ROOT . 'admin/includes/');

if($config->is_multisite) {
    if(qp_set('site')) {
        $site = qp_get('site');

        if($site == '__def') {
            $site = null;
        }

        $session->setVar('site', $site);

        $qp = [];

        $u = $_SERVER["REQUEST_URI"];
        $q = explode('?', $u);
        if(count($q) > 0) $u = $q[0];

        $u .= '?';

        foreach ($_GET as $key => $value) {
            if($key != 'site') {
                $u .= $key . '=' . $value . '&';
            }
        }

        $u = substr($u, 0, strlen($u) -1);

        redirect($u);
    } else {
        if(!$session->issetVars('site')) {
            $site = null;
        } else {
            $site = $session->getVar('site');
        
            if($site == '__def') {
                $site = null;
            }
        }
    }

    if($site) {
        $st = PH_Query::sites(["==site_slug" => $site]);
        if(count($st)>0) $site_id = $st[0]->id;
        else $site_id = null;
    } else $site_id = null;

}




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

if($config->is_multisite) {
    $menu["collection:settings"]["items"]["multisite"] = [
        "display" => "Multisite",
        "url_to" => "multisite"
    ];
}
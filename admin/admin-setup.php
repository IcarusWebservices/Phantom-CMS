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
        if(count($st)>0) {
            $site_id = $st[0]->id;
            $q_site = $st[0];

            
        } else {
            $site_id = null;
            $q_site = null;
        }
    } else {
        $site_id = null;
        $q_site = null;
    }

}

$______where = ["==enabled" => 1];

if($q_site) {
    $______where["==site"] = $q_site->id;
} else $______where["NLsite"] = null;

$packs = PH_Query::logic_packs($______where);

$loaded_packs = [];
$routes = [];

foreach ($packs as $pack) {
    // var_dump($pack);
    $json = PH_Loader::loadLogicPack($pack->folder_name);

    if($json) {

        if(isset($json->routes)) {
            foreach ($json->routes as $pattern => $proporties) {
                $routes[$pattern] = $proporties;
            }
        }

        if(isset($json->editors)) {
            $e = $json->editors;
            if(isset($e->record_types)) {
                foreach ($e->record_types as $type => $fields) {
                    if($fields) {
                        foreach ($fields as $field_name => $field) {
                            registry()->register('editors', 'record-types/' . $type . '/' . $field_name, $field);
                        }
                    }
                }
            }
        }
        
        array_push($loaded_packs, $json);
    }
}


$record_types = registry()->getCategory(CAT_RECORD_TYPES);

// var_dump($record_types);

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

$menu = [];
$menu["item:dashboard"] = [
    "display" => "Dashboard",
    "url_to" => "index"
];

if(count($record_types_items) > 0) {
    $menu["collection:recordtypes"] = [
        "display" => "Records",
        "items" => $record_types_items
    ];
}

if(count($taxonomy_items) > 0) {
    $menu["collection:taxonomy"] = [
        "display" => "Taxonomy",
        "items" => $taxonomy_items
    ];
}

$menu["collection:appearance"] = [
    "display" => "Appearance",
    "items" => [
        "theme" => [
            "display" => "Theme",
            "url_to" => "set-theme"
        ],
        "customizer" => [
            "display" => "Customizer",
            "url_to" => "customizer"
        ]
    ]
];
$menu["collection:settings"] = [
    "display" => "Settings",
    "items" => [
        "site-settings" => [
            "display" => "Site",
            "url_to" => "site-settings"
        ],
        "users" => [
            "display" => "Users",
            "url_to" => "users"
        ],
        "releases" => [
            "display" => "Releases",
            "url_to" => "releases"
        ]
    ]
];

if($config->is_multisite) {
    $menu["collection:settings"]["items"]["multisite"] = [
        "display" => "Multisite",
        "url_to" => "multisite"
    ];
}

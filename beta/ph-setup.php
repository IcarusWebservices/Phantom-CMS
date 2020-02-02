<?php
/**
 * Sets up the phantom environment
 * 
 * @since 2.0.0
 * 
 * @package Phantom.Main
 */
defined("ROOT") or die("This is an illegal route, please route through index.php");
// The core directory
define("CORE", ROOT . 'core/');
// Data directory
define("DATA", ROOT . 'data/');
// Require the loading functions
require_once CORE . 'ph-load.php';
// Now load the includes
load_recursively(CORE . 'includes/');
// Now set up the global variables
require_once CORE . 'pages/error.php';

// Load the configuration file (ph-config.php)
if(!file_exists(ROOT . 'ph-config.php')) {
    ph_die("ph-config.php was not found! Please reinstall Phantom...");
}

require_once ROOT . 'ph-config.php';

$dsn = "mysql:host=". $config->db_hostname . ";dbname=". $config->db_database . ";charset=" . $config->db_charset;

/**
 * The main database controller
 * 
 * @var PH_DB
 */
$database = new PH_DB($dsn, $config->db_username, $config->db_password);

/**
 * The hook controller
 * 
 * @var PH_Hooks
 */
$hooks = new PH_Hooks;

/**
 * The logging tool
 * 
 * @var PH_Logger
 */
$logger = new PH_Logger;

/**
 * The global registry
 * 
 * @var PH_Registry
 */
$registry = new PH_Registry;

// ======== Load the logic-packs ========
$packs = PH_Query::logic_packs([
    "==enabled" => 1
], "importance");

$loaded_packs = [];
$routes = [];

foreach ($packs as $pack) {
    $json = PH_Loader::loadLogicPack($pack->folder_name);

    if($json) {

        if(isset($json->routes)) {
            $r = $json->routes;

            foreach ($r as $pattern => $proporties) {
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

/**
 * The main request
 * 
 * @since 2.0.0
 */
$request = new PH_Request();

if($config->router_baseuri) {
    $request->applyBaseURI($config->router_baseuri);
}

/**
 * Whether a valid theme has been selected
 * 
 * @since 2.0.0
 */
$theme_valid = true;

/**
 * The name of the theme folder
 * 
 * @since 2.0.0
 */
$theme_folder = null;

/**
 * The theme JSON data
 * 
 * @since 2.0.0
 */
$theme_data = null;

/**
 * The language to be used
 * 
 * @since 2.0.0
 */
$language_code = 'nl';

// Try to get the theme
$t_q = PH_Query::settings([
    "==setting_key" => "appearance_theme"
]);

if(count($t_q) > 0) {
    $theme_folder = $t_q[0]->value;

    $loaded = PH_Loader::loadTheme($theme_folder);

    if($loaded) {
        $theme_data = $loaded;
    } else {
        $theme_valid = false;
    }
} else {
    $theme_valid = false;
}


// var_dump($registry);

define("SETUP", 1);
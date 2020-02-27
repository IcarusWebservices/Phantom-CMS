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
/**
 * The current version of the Phantom Content Management System
 * 
 * @since 2.0.0
 */
define('VERSION', '2.0.0');

/**
 * The GitHub version for the releases page
 * 
 * @since 2.0.0
 */
define("RELEASE_VERSION", "v1.0-prebeta1");
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

/**
 * The site that is currently being displayed.
 * 
 * Only if is_multisite is set to true in the config
 * 
 * @var string
 */
$site = null;

/**
 * Whether the front-end runs in customizer mode
 * 
 * @since 2.0.0
 */
$is_in_customizer_mode = false;

/**
 * The main request
 * 
 * @since 2.0.0
 */
$request = new PH_Request();


if($config->router_baseuri) {
    $request->applyBaseURI($config->router_baseuri);
}

read_and_register(CORE . 'native/editor-fields/', CAT_EDITOR_FIELDS);
read_and_register(CORE . 'native/template-record-types/', CAT_TEMPLATE_RECORD_TYPES);

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

/**
 * The session data
 * 
 * @since 2.0.0
 */
$session = new PH_Session;

// Try to get the theme



// var_dump($registry);

define("SETUP", 1);
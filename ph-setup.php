<?php
/**
 * Sets up the P H A N T O M (spooky) environment.
 * 
 * Can be included from everywhere within the environment, if the constants PH_ROOT and PH_CORE are defined
 */
defined("PH_ROOT") or die("Illegal entry point: PH_ROOT is not defined...");

// The core directory of the application
define("PH_CORE", PH_ROOT . 'core/');

// The projects directory
define("PH_PROJECTS", PH_ROOT . 'projects/');

$__setup__ = 1;

require_once PH_ROOT . 'ph-loader.php';

require_once PH_CORE . 'class-events.php';
require_once PH_CORE . 'ph-events.php';
require_once PH_CORE . 'ph-constants.php';

$events = new PH_Events;

ph_autoload(PH_CORE . "/", [PH_CORE . 'class-events.php', PH_CORE . 'ph-events.php', PH_CORE . 'ph-events-constants.php']);

require_once PH_ROOT . 'ph-config.php';

$registry = new PH_Registry;

$project_runner = new PH_Project_Runner;

$events->call_event(EVENT_REGISTRY_SETUP);

$database = new PH_DB($config->database_server_name, $config->database_username, $config->getDatabasePassword(), $config->database_database);

$session = new PH_Session();

if(session()->isset("username") && session()->isset("password")) {
    $user = session()->authorizeUserByPassword(session()->get("username"), session()->get("password"));

    if($user) {
        session()->setUser($user, session()->get("password"));
    }
}

unset($__setup__);


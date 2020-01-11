<?php
/**
 * Sets up the P H A N T O M (spooky) environment.
 * 
 * Can be included from everywhere within the environment, if the constants PH_ROOT and PH_CORE are defined
 */
defined("PH_CORE") or die("Illegal entry point: PH_CORE is not defined...");
defined("PH_ROOT") or die("Illegal entry point: PH_ROOT is not defined...");

$__setup__ = 1;

require_once PH_ROOT . 'ph-loader.php';

require_once PH_CORE . 'class-events.php';
require_once PH_CORE . 'ph-events.php';
require_once PH_CORE . 'ph-events-constants.php';

$events = new PH_Events;

ph_autoload(PH_CORE . "/", [PH_CORE . 'class-events.php', PH_CORE . 'ph-events.php', PH_CORE . 'ph-events-constants.php']);

require_once PH_ROOT . 'ph-config.php';

$registry = new PH_Registry;

$project_runner = new PH_Project_Runner;

$events->call_event(EVENT_REGISTRY_SETUP);

$database = new PH_DB($config->database_server_name, $config->database_username, $config->getDatabasePassword(), $config->database_database);

unset($__setup__);


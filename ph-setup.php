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

ph_autoload(PH_CORE . "/");

require_once PH_ROOT . 'ph-config.php';

unset($__setup__);

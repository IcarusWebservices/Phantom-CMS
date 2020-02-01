<?php
/**
 * Phantom Content Management System.
 * 
 * Version 2.0.0
 * 
 * Created by Icarus Webservices.
 * 
 * @copyright Daan Penning & Jesse Traas
 */
define('ROOT', dirname(__FILE__) . '/');

/**
 * The current version of the Phantom Content Management System
 * 
 * @since 2.0.0
 */
define('VERSION', '2.0.0');

/**
 * Whether Phantom should process requests in "Development mode".
 * 
 * Development mode adds diagnostic information to the response, so that developers can see what is happening behind the scenes.
 * 
 * !Warning!
 * Do not run dev in production. 
 * Only set this to "True" if the website is not published on a public server OR if the websites publish status has been set to "Login required"
 */
define("RUN_DEV", true);

// Config
require_once ROOT . 'ph-setup.php';
require_once ROOT . 'ph-front.php';

$logger->write_log();
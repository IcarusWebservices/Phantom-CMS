<?php
/**
 * Phantom CMS
 * Created by Icarus Webservices
 * 
 * @author IcarusWebservices
 */
define("PH_VERSION", "1.0.0");

// The root directory of the application
define("PH_ROOT", dirname(__FILE__) . '/');

// The core directory of the application
define("PH_CORE", PH_ROOT . 'core/');

require_once PH_ROOT . 'ph-setup.php';

$phantom = new Phantom( $config );

$request = new PH_Request;

$phantom->build( new PH_Request );

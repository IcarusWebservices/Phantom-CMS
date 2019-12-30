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

// The projects directory
define("PH_PROJECTS", PH_ROOT . 'projects/');

require_once PH_ROOT . 'ph-setup.php';

$phantom = new Phantom( $config );

$request = new PH_Request;

$response = $phantom->build( new PH_Request );

if($response instanceof PH_ResponseCode) {
    ph_default_code_generator($response->code, $response->description);
} else if(is_string($response)) {
    echo $response;
}

// if(!$response) {
//     ph_default_code_generator(404, "The requested document was not found on this server...");
// }

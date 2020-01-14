<?php
session_start();
/**
 * Phantom CMS
 * Created by Icarus Webservices
 * 
 * @author IcarusWebservices
 */
define("PH_VERSION", "1.0.0");

// The root directory of the application
define("PH_ROOT", dirname(__FILE__) . '/');

require_once PH_ROOT . 'ph-setup.php';

$phantom = new Phantom( $config );

$request = new PH_Request;

$response = $phantom->build( new PH_Request );

// var_dump($registry);

if($response instanceof PH_ResponseCode) {
    ph_default_code_generator($response->code, $response->description);
} else if($response instanceof PH_Template) {
    ph_document_generator($response);
}

// if(!$response) {
//     ph_default_code_generator(404, "The requested document was not found on this server...");
// }
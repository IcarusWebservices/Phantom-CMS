<?php
/**
 * Renders the front-end application
 * 
 * Requires that ROOT and SETUP has been defined
 * 
 * @since 2.0.0
 */
defined("ROOT") && defined("SETUP") or (die("This is an illegal route, please route through index.php"));

// echo "Tracing: OK";

$front = new PH_Front_End;
$result = $front->render( new PH_Request(), 0 );

if(var_instanceof($result, 'PH_DisplayEngine_Document')) {
    $result->render();
} else if(var_inherits($result, 'PH_Template')) {

    $document = PH_DisplayEngine::generateHTML5($result);
    $document->http_response_code = 200;

    $document->render();

}
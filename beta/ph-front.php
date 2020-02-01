<?php
/**
 * Renders the front-end application
 * 
 * Requires that ROOT and SETUP has been defined
 * 
 * @since 2.0.0
 */
defined("ROOT") && defined("SETUP") or (die("This is an illegal route, please route through index.php"));

$front = new PH_Front_End;
$result = $front->render( new PH_Request(), 0 );

if(var_check(TYPE_STRING, $result)) {
    echo $result;
}
<?php
/**
 * Renders the front-end application
 * 
 * Requires that ROOT and SETUP has been defined
 * 
 * @since 2.0.0
 */
defined("ROOT") && defined("SETUP") or (die("This is an illegal route, please route through index.php"));

$views = PH_Query::records([
    "==record_type" => "SYSTEM",
    "==record_slug" => "SYSTEM_VIEWS"
]);

if(count($views) > 0) {
    // Update the total loads counter
    $new_val = ((int) json_decode($views[0]->processed_content)->total) + 1;

    // echo $new_val;

    database()->update('ph_records', [
        "record_content" => '{"total": '. $new_val .'}'
    ], [
        "==record_type" => "SYSTEM",
        "==record_slug" => "SYSTEM_VIEWS"
    ]);
}

$front = new PH_Front_End;
$result = $front->render( new PH_Request(), 0 );

if(var_instanceof($result, 'PH_Document')) {
    $result->render();
} else if(var_inherits($result, 'PH_Template')) {

    $document = render_template($result);

    $document->render();

}
<?php

class Twenties_PageController {

    public function index($proporty) {

        // Request a template
        // $template = PH_Loader::requestTemplate("page");

    }

}

$export = new PH_Export('Twenties_Page');
$export->setProperty('class', 'Twenties_PageController');
$export->setProperty('checkerFunctions', [
    "page_exists" => function($parameters) {
        return false;
    }
]);

return $export;
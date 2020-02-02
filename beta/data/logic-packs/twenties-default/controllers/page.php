<?php

class Twenties_PageController {

    public function index($proporty) {

        // Request a template
        $template = PH_Loader::requestTemplate("page");
        
        return $template;

    }

}

return new PH_Export('Twenties_Page', [
    'class' => 'Twenties_PageController',
    'checkerFunctions' => [
        "page_exists" => function($parameters) {
            $slug = $parameters["page"];
            $record = PH_Query::records([
                "==record_type" => "page",
                "==record_slug" => $slug
            ]);
    
            if(count($record) > 0) return true;
            else return false;
        }
    ]
]);
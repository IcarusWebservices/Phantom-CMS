<?php
/**
 * Controller related to posts
 * 
 * @since 2.0.0
 */
class Demo_Page_Controller {

    public function page($parameters) {
        // echo "Hello ;(";
        $slug = $parameters->slug;

        $template = PH_Loader::requestTemplate('demopage');

        $template->addData([
            "slug" => $slug
        ]);

        $template->active_id = $slug;

        return $template;
    }

}

return export('demopagecontroller', [
    "class" => "Demo_Page_Controller",
    "checkerFunctions" => [
        "checkpage" => function($p) {
            $slug = $p["slug"];

            $record = PH_Query::records([
                "==record_type" => "demopage",
                "==record_slug" => $slug
            ]);

            if(count($record) > 0) {
                return true;
            } else return false;
            
        }
    ]
]);

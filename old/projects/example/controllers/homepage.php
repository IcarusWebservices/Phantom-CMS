<?php
/**
 * (Example)
 * The homepage controller.
 */
class Example_HomepageController extends PH_Controller {

    function index($parameters, $router)
    {
        $template = $this->loader->getTemplate("homepage");

        $record = PH_Query::get_record_by_id(1);

        $template->addData([
            "featured_post" => [
                "content" => $record->parsed_content
            ]
        ]);

        return $template;
    }

}

ph_register("@this", "controllers", "HomepageController", "Example_HomepageController");
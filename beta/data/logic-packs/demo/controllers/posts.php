<?php
/**
 * Controller related to posts
 * 
 * @since 2.0.0
 */
class Demo_Posts_Controller {

    public function overview($parameters) {

        $template = PH_Loader::requestTemplate('demoposts_overview');

        return $template;
    }

}

return export('demopostscontroller', [
    "class" => "Demo_Posts_Controller"
]);
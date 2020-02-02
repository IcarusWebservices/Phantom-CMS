<?php
/**
 * The general page template
 * 
 * @since 2.0.0
 */
class Twenties_Template_Page extends PH_Template {

    public function render($data)
    {
        get_template_part('menu.php');
    }

    public function __construct($theme_folder)
    {
        $this->requested_stylesheets = [
            request_stylesheet(uri_resolve('data/themes/' . $theme_folder . '/css/style.css'))
        ];
    }

}

return new PH_Export('page', ['class' => 'Twenties_Template_Page']);
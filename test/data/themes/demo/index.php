<?php
/**
 * Twenties Homepage
 * 
 * @since 2.0.0
 */
class Twenties_Homepage extends PH_Template {

    public function render($input)
    {

        get_template_part('header.php', [
            "active_id" => $this->active_id
        ]);

    ?>

    <main>
        <section>
            <h1>Homepage</h1>
        </section>
    </main>
        
    <?php
    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [ request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/bulma.css')) ];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
        $this->active_id = 'index';
    }

}

return new PH_Export('index', [
    "class" => "Twenties_Homepage"
]);

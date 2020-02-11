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

    <header class="banner">
        <div class="banner-content">
            <h1>Phantom CMS</h1>
            <p>The CMS of the future</p>
            <a href="/posts" class="button">Get Started</a>
        </div>
        <div class="banner-illustration">
            <img src="https://jezz.tech/sites/phantom/img/cms.svg" alt="CMS Icon" class="cms">
        </div>
    </header>
        
    <?php
    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [ request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/umbra.css')) ];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
        $this->active_id = 'index';
    }

}

return new PH_Export('index', [
    "class" => "Twenties_Homepage"
]);

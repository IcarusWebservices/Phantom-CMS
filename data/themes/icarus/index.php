<?php
/**
 * Icarus Homepage
 * 
 * @since 2.0.0
 */
class Icarus_Homepage extends PH_Template {

    public function render($input)
    {

        get_template_part('header.php', [
            "active_id" => $this->active_id
        ]);

    ?>

    <main>
        <section>
            <h1>Welcome to Icarus!</h1>
            <a href="<?= uri_resolve('/admin') ?>" class="button">Go to admin</a>
        </section>
    </main>
        
    <?php
    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [ request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/style.css')) ];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
        $this->active_id = 'index';
    }

}

return new PH_Export('index', [
    "class" => "Icarus_Homepage"
]);

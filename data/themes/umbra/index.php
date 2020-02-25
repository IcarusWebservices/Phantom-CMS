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
            <p><?php get_template_record('sonk', 'string', 'Whoa! This is not set...'); ?></p>
            <a href="/posts" class="button"></a>
        </div>
        <div class="banner-illustration">
            <img src="https://jezz.tech/sites/phantom/img/cms.svg" alt="CMS Icon" class="cms">
        </div>
    </header>


    <main class="content">
        <section class="duo">
            <div class="text">
                <h1 class="title">Choose Individuality</h1>
                <article></article>
                <a href="#" class="link learn-more"></a>
            </div>
            <div class="illustration">
                <img src="https://jezz.tech/sites/phantom/img/icon-diamond.svg" alt="Sparkles" class="svg">
            </div>
        </section>
        <section class="duo">
            <div class="text">
                <h1 class="title">Customer Oriented</h1>
                <article></article>
                <a href="#" class="link learn-more"></a>
            </div>
            <div class="illustration">
                <img src="https://jezz.tech/sites/phantom/img/phantom-mockup.png" alt="Phantom Mobile" class="phantom-mobile">
            </div>
        </section>
        <section class="duo">
            <div class="text">
                <h1 class="title">This is maybe a bit of a dodgy title</h1>
                <article></article>
                <a href="#" class="link learn-more"></a>
            </div>
            <div class="illustration">
                <img src="https://jezz.tech/sites/phantom/img/icon-diamond.svg" alt="Sparkles" class="svg">
            </div>
        </section>
        
    </main>
        
    <?php
    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [ request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/umbra.css')) ];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
        $this->requested_title = "Phantom CMS - ";
        $this->active_id = 'index';
    }

}

return new PH_Export('index', [
    "class" => "Twenties_Homepage"
]);

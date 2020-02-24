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
            <p><?= get_string("homepage_slogan", "Please enter this string! (id: homepage_slogan)"); ?></p>
            <a href="/posts" class="button"><?= get_string("general_getstarted", "Get Started"); ?></a>
        </div>
        <div class="banner-illustration">
            <img src="https://jezz.tech/sites/phantom/img/cms.svg" alt="CMS Icon" class="cms">
        </div>
    </header>


    <main class="content">
        <section class="duo">
            <div class="text">
                <h1 class="title">Choose Individuality</h1>
                <article><?= get_string("homepage_individuality", "Please enter this string! (id: homepage_individuality)") ?></article>
                <a href="#" class="link learn-more"><?= get_string("general_learnmore", "Learn More"); ?></a>
            </div>
            <div class="illustration">
                <img src="https://jezz.tech/sites/phantom/img/icon-diamond.svg" alt="Sparkles" class="svg">
            </div>
        </section>
        <section class="duo">
            <div class="text">
                <h1 class="title">Customer Oriented</h1>
                <article><?= get_string("homepage_customer_oriented", "Please enter this string! (id: homepage_customer_oriented)") ?></article>
                <a href="#" class="link learn-more"><?= get_string("general_learnmore", "Learn More"); ?></a>
            </div>
            <div class="illustration">
                <img src="https://jezz.tech/sites/phantom/img/phantom-mockup.png" alt="Phantom Mobile" class="phantom-mobile">
            </div>
        </section>
        <section class="duo">
            <div class="text">
                <h1 class="title">This is maybe a bit of a dodgy title</h1>
                <article><?= get_string("homepage_local_economy", "Please enter this string!") ?></article>
                <a href="#" class="link learn-more"><?= get_string("general_learnmore", "Learn More"); ?></a>
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
        $this->requested_title = "Phantom CMS - " . get_string("website_name");
        $this->active_id = 'index';
    }

}

return new PH_Export('index', [
    "class" => "Twenties_Homepage"
]);

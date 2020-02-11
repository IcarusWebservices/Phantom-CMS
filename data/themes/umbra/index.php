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


    <main class="content">
        <section class="duo">
            <div class="text">
                <h1 class="title">Choose Individuality</h1>
                <article>Imagine having a website truly designed for you and you only, not simply a template anyone can use. Contact us now and join our cause!</article>
                <a href="#" class="link learn-more">Learn More</a>
            </div>
            <div class="illustration">
                <img src="https://jezz.tech/sites/phantom/img/icon-diamond.svg" alt="Sparkles" class="svg">
            </div>
        </section>
        <section class="duo">
            <div class="text">
                <h1 class="title">Customer Oriented</h1>
                <article>Phantom CMS is completely user oriented. Every client sees a slightly different version of our CMS, because every client has different needs. Phantom isn't about the masses. It's about you.</article>
                <a href="#" class="link learn-more">Learn More</a>
            </div>
            <div class="illustration">
                <img src="https://jezz.tech/sites/phantom/img/phantom-mockup.png" alt="Phantom Mobile" class="phantom-mobile">
            </div>
        </section>
        <section class="duo">
            <div class="text">
                <h1 class="title">Make Zeeland Great Again</h1>
                <article>By supporting our cause and switching to Phantom CMS, you're not only setting yourself up for success, you also invest in the local market. This strengthens our economy and with your help, we will Make Zeeland Great Again!</article>
                <a href="#" class="link learn-more">Learn More</a>
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
        $this->active_id = 'index';
    }

}

return new PH_Export('index', [
    "class" => "Twenties_Homepage"
]);

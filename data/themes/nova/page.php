<?php
/**
 * The posts overview template
 * 
 * @since 2.0.0
 */
class Nova_SinglePage_Template extends PH_Template {

    public function render($input)
    {
        get_template_part('header.php', [
            "active_id" => $this->active_id
        ]);

        $records = PH_Query::records([
            "==record_type" => "demopage",
            "==record_status" => "published",
            "==record_slug" => $input->slug
        ]);

        if(count($records) > 0) {
            $record = $records[0];
            ?>

            <header class="banner low">
                <img src="https://jezz.tech/sites/wim/assets/img/kerstconcert.jpg" data-speed="-0.75" class="img-parallax">
                <div class="banner-text abs-centered">
                    <h1 class="title"><?= ucfirst($input->slug) ?></h1>
                </div>
            </header>

            <main>
                <section>
                    <div class="article-card">
                        <?php demo_render_post_full($record); ?>
                    </div>    
                </section>
            </main>
            <?php
            $this->requested_title = $record->title . ' - Website';
        }
        
    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [
            request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/nova.css')),
            request_stylesheet(uri_resolve('/data/themes/'. $theme_folder .'/css/musicplayer.css'))
        ];
        $this->requested_header_scripts = [
            request_script('https://kit.fontawesome.com/9d8cef91c5.js'),
            request_script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js')
        ];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
    
    }

}

return export('demopage', [
    "class" => "Nova_SinglePage_Template"
]);
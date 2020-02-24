<?php
/**
 * The posts overview template
 * 
 * @since 2.0.0
 */
class Demo_PostsOverview_Template extends PH_Template {

    public function render($input)
    {

        get_template_part('header.php', [
            "active_id" => $this->active_id
        ]);

        $records = PH_Query::records([
            "==record_type" => "demopost",
            "==record_status" => "published"
        ]);

        ?>
        <div class="container">
            <h1 style="font-size: 2rem; font-weight: bold;"><?= get_string('STRING_POSTS', 'Posts') ?></h1>
        <?php

        foreach($records as $record) {
            demo_render_post($record);
        }

        ?>       
        </div>
        <?php
        $this->requested_title = "Posts";
    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [request_stylesheet(uri_resolve('/data/themes/' . $theme_folder . '/css/bulma.css'))];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
    
    }

}

return export('demoposts_overview', [
    "class" => "Demo_PostsOverview_Template"
]);
<?php
/**
 * The posts overview template
 * 
 * @since 2.0.0
 */
class Demo_SinglePost_Template extends PH_Template {

    public function render($input)
    {
        // asd
        // echo "a";
        get_template_part('header.php', [
            "active_id" => $this->active_id
        ]);

        // echo $input->slug;

        $records = PH_Query::records([
            "==record_type" => "demopost",
            "==record_status" => "published",
            "==record_slug" => $input->slug
        ]);

        if(count($records) > 0) {
            $record = $records[0];
            ?>
            <main>
                <section>
                    
                    <div class="masonry-title"><a href="<?php
                        if(qp_set('origin')) {
                            echo qp_get('origin');
                        } else echo "#";
                    ?>">← Back to overview</a></div>
                    <?php
    
                    ?>
                    <div class="article-card">
                        <?php demo_render_post_full($record); ?>
                    </div>
                    <?php
    
                    ?>
    
                </section>
            </main>
            <?php
            $this->requested_title = $record->title . ' - Website';
        }
        
    }

    public function __construct()
    {
        global $theme_folder;
        $this->requested_stylesheets = [request_stylesheet(uri_resolve('/data/themes/' . $theme_folder . '/css/umbra.css'))];
        $this->requested_body_scripts = [request_script(ph_pattern('%THEME%/js/main.js'))];
    
    }

}

return export('demoposts_single', [
    "class" => "Demo_SinglePost_Template"
]);
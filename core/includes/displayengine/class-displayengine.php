<?php
/**
 * Display engine
 * 
 * Renders a full HTML document from a template
 * 
 * @since 2.0.0
 */
class PH_DisplayEngine {

    /**
     * Renders a template according to the HTML5 specification.
     * 
     * @param PH_Template   $template       The template to render.
     * @param bool          $return_buffer  (Optional) Return the rendered output as a buffer. If set to false, will return as PH_Document.
     * @param string        $language_code  (Optional) The language code to use for the HTML lang. Defaults to 'en'.
     * 
     * @since 2.0.0
     * 
     * @return PH_DisplayEngine_Document|string (Depending on whether $return_buffer is set to true)
     */
    public static function generateHTML5($template, $return_buffer = false, $language_code = 'en') {
        global $is_in_customizer_mode;

        $data = $template->__get_data();
        ob_start();
        $template->render($data);
        $rendered_content = ob_get_clean();
        
        ob_start();

        ?>
        <!DOCTYPE html>
        <html lang="<?= $language_code ?>">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php
                $stylesheets = $template->requested_stylesheets;
                foreach ($stylesheets as $stylesheet) {
                    if(var_instanceof($stylesheet, 'PH_Requested_Stylesheet')) {
                        $stylesheet->render();
                    }
                }

                if($is_in_customizer_mode) {
                    ?><link rel="stylesheet" href="<?= uri_resolve('/core/css/customizerpage.css')?>"><?php
                }
            ?>
            <?php
                $hscripts = $template->requested_header_scripts;
                foreach ($hscripts as $script) {
                    if(var_instanceof($script, 'PH_Requested_Script')) {
                        $script->render();
                    }
                }
            ?>
            <title><?= $template->requested_title ? $template->requested_title : 'Untitled' ?></title>
        </head>
        <body>
            <?php
                if($is_in_customizer_mode) {
                    ?>
                    <form method="post" id="__customizer_form">
                        <span style="display:none !important;" id="__customizer_base_path"><?= uri_resolve('/') ?></span>
                    <?php
                }
                echo $rendered_content;
                
                $bscripts = $template->requested_body_scripts;
                foreach ($bscripts as $script) {
                    if(var_instanceof($script, 'PH_Requested_Script')) {
                        $script->render();
                    }
                }

                if($is_in_customizer_mode) {
                    ?><script src="<?= uri_resolve('/core/js/customizer.js') ?>"></script>
                    <?php
                }
            ?>
        </body>
        </html>
        <?php

        $cnt = ob_get_clean();

        if($return_buffer) {
            return $cnt;
        } else {
            return new PH_DisplayEngine_Document($cnt);
        }
    }

}
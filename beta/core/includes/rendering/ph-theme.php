<?php
/**
 * This file contains functions related to the theme.
 * 
 * @since 2.0.0
 */

/**
 * Gets a template part from the currently selected theme
 * 
 * @param string $relative_path The relative path from ROOT/DATA/%theme_name/template-parts/
 * 
 * @since 2.0.0
 */
function get_template_part($relative_path) {

    global $theme_folder, $theme_valid;

    if($theme_valid) {
        if(file_exists(DATA . 'themes/' . $theme_folder . '/template-parts/' . $relative_path)) {
            include DATA . 'themes/' . $theme_folder . '/template-parts/' . $relative_path;
        }
    }

}
<?php
/**
 * The main class responsable for loading all kind of things within Phantom.
 * 
 * All methods are static, don't instantiate.
 * 
 * @since 2.0.0
 * 
 * @package Phantom.Core
 */
class PH_Loader {

    /**
     * Loads a logic pack from /data/logic-packs or from /data/projects/-name-/logic-packs
     * 
     * @param string $path The path to the logic pack
     * 
     * @static
     */
    public static function loadLogicPack($path) {
        // echo $path;
        if( is_dir($path) ) {
            // Try to get the logic-pack.json file
            if(file_exists($path . 'logic-pack.json')) {

                $get_json = get_json_file($path . 'logic-pack.json');

                if(!$get_json) {
                    return null;
                }
                // Include the folders, if they exist
                read_and_register($path . 'controllers/', 'controllers');
                read_and_register($path . 'editor-fields/', 'editor-fields');
                read_and_register($path . 'record-types/', 'record-types');

                return $get_json;

            } else {
                return null;
            }

        } else {
            return null;
        }
    }

    /**
     * Requests a template
     * 
     * @param string $template_slug The slug of the template
     * 
     * @since 2.0.0
     */
    public static function requestTemplate($template_slug) {
        global $theme_folder;

        $r = registry()->get('templates', $template_slug);

        if($r) {
            if(var_instanceof($r, 'PH_Export')) {

                if($r->hasProperty('class')) {
                    $class = $r->getProperty('class');
                    if(class_exists($class)) {
                        $instance = new $class($theme_folder);
                        return $instance;
                    } else return null;
                } else return null;

            } else return null;
        } else {
            return null;
        }

    }

    /**
     * Loads a theme
     * 
     * @since 2.0.0
     */
    public static function loadTheme($path) {

        if( is_dir($path) ) {
            
            // Try to get the logic-pack.json file
            if(file_exists($path . 'theme.json')) {

                $get_json = get_json_file($path . 'theme.json');

                if(!$get_json) {
                    return null;
                }

                // Start output buffering to prevent output from theme inclusions
                ob_start();
                // Include the folders, if they exist
                read_and_register($path, 'templates');
                // Close output buffering
                ob_clean();

                // Now load in util files, if they exist
                if(is_dir($path . 'util/')) {
                    load_recursively($path . 'util/');
                }

                return $get_json;

            } else {
                return null;
            }

        } else {
            return null;
        }
    }

    public static function getValidThemes() {
        $path = DATA . 'themes/';
        $themes = [];
        foreach (glob($path . '*') as $dir) {
            if(is_dir($dir)) {
                $dir = $dir . '/';
                // Try to get the logic-pack.json file
                if(file_exists($dir . 'theme.json')) {

                    $json = get_json_file($dir . 'theme.json');

                    if($json) {
                        
                        $theme_id = substr($dir, strlen(DATA . 'themes/'));
                        $theme_id = substr($theme_id, 0, strlen($theme_id) - 1);
                        $theme_name = isset($json->themeName) ? $json->themeName : null;

                        $themes[$theme_id] = [
                            "themeName" => $theme_name
                        ];

                    }

                } 

            }
        }

        return $themes;
    }

}

/**
 * Function used by the loader function.
 * 
 * Loads a file in a dir, and registers the export to a specific category
 * 
 * @since 2.0.0
 */
function read_and_register($dir_path, $export_category) {
    if(is_dir($dir_path)) {
        foreach (glob($dir_path . '*') as $p) {
            if( explode('.', $p)[count(explode('.', $p)) - 1] == "php" ) {

                $export = (require $p);
                
                if(var_instanceof($export, 'PH_Export')) {
                    registry()->registerExport($export_category, $export);
                }

            }
        }
    }
}
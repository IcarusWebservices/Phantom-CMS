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
     * Loads a logic pack from /data/logic-packs
     * 
     * @param string $logic_pack_name The folder name of the logic pack.
     * 
     * @static
     */
    public static function loadLogicPack($logic_pack_name) {

        if(!var_check(TYPE_STRING, $logic_pack_name)) var_dump($logic_pack_name);

        $path = DATA . 'logic-packs/' . $logic_pack_name . '/';
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
    public static function loadTheme($theme_name) {
        $path = DATA . 'themes/' . $theme_name . '/';

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

                return $get_json;

            } else {
                return null;
            }

        } else {
            return null;
        }
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
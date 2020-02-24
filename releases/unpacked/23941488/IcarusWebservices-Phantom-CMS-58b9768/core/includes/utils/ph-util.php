<?php
/**
 * Checks whether a variable is of a specific type.
 * 
 * @param int $type     The type to check for. Use constants labeled TYPE_*.
 * @param mixed $var    The variable to check.
 * 
 * @since 2.0.0
 * 
 * @return bool
 */
function var_check($type, $var) {
    
    switch($type) {

        case TYPE_STRING:
            return is_string($var);
        break;

        case TYPE_ARRAY:
            return is_array($var);
        break;

        case TYPE_INT:
            return is_integer($var);
        break;

        case TYPE_FUNCTION:
            return is_callable($var);
        break;

        default:
            return false;
        break;
    }

}

/**
 * Checks if a class is extending another class
 * 
 * @param mixed $object The object to check
 * @param string $class_name The name of the extending class
 * 
 * @since 2.0.0
 * 
 * @return bool
 */
function var_inherits($object, $class_name) {
    return is_subclass_of($object, $class_name);
}

/**
 * Checks whether a variable is instance of a specific class or interface.
 * Shorthand for instanceof.
 * 
 * @param mixed $var        The variable
 * @param object $object    The object to check
 * 
 * @since 2.0.0
 * 
 * @return bool
 */
function var_instanceof($var, $object) {
    if($var instanceof $object) {
        return true;
    } else return false;
}

/**
 * Resolves a uri to include the base-path
 * 
 * @param string $uri The uri, relative to the ROOT directory
 * 
 * @since 2.0.0
 * 
 * @return string
 */
function uri_resolve( $uri ) {
    global $config;

    $base_path = $config->router_baseuri;

    if(substr($base_path, strlen($base_path) -1) == '/') {
        $base_path = substr($base_path, 0, strlen($base_path) -1);
    } 

    return $base_path . $uri;
}

/**
 * Checks if all variables provided are true.
 * This is useful for checking query parameters or function arguments
 * 
 * @param mixed items
 * 
 * @since 2.0.0
 * 
 * @return bool
 */
function all_true() {
    $args = func_get_args();
    $result = true;
    foreach ($args as $arg) {
        if(!$arg) {
            $result = false;
        }
    }
    return $result;
}

/**
 * Opens a json file, and output a json_decode object or null
 * 
 * @param string $path The path to the JSON file
 * 
 * @since 2.0.0
 * 
 * @return stdClass|null
 */
function get_json_file($path) {
    if(file_exists($path)) {
        $contents = file_get_contents($path);

        $jdec = json_decode($contents);

        if($jdec) {
            return $jdec;
        } else {
            return null;
        } 
    } else {
        return null;
    }
}

/**
 * "Murders" The request.
 * 
 * Returns a message
 * 
 * @param string $message The message to log
 * 
 * @since 2.0.0
 */
function ph_die($message) {
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>An unexpected error occured!</title>
            <style>
                div {
                    background-color: #e0432b;
                    border-radius: 20px;
                    padding: 5px 20px;
                    display: block;
                    text-align: center;
                }

                h1 {
                    display: inline-block;
                    margin: 0 0 10px;
                }

                span {
                    display: inline-block;
                    margin-bottom: 10px;
                    font-size: 20px
                }
            </style>
        </head>
        <body>
            <div>
                <h1>Phantom Error</h1><br>
                <span><?= $message ?></span>
            </div>
        </body>
        </html>
    <?php
    die;
}

/**
 * Takes HTML within a function, and returns it as a string
 * 
 * @since 2.0.0
 * 
 * @param callback $function The function to get the HTML from
 * 
 * @return string
 */
function html_to_string($function) {
    if(var_check($function, TYPE_FUNCTION)) {
        ob_start();
        $function();
        $result = ob_get_clean();
        return $result;
    } else {
        return null;
    }
}

/**
 * Resolves a Phantom Pattern
 * 
 * @param string $input
 * 
 * @since 2.0.0
 * 
 * @return string
 */
function ph_pattern($input) {
    global $theme_folder, $site, $config;
    // Match all available patterns

    if($site && $config->is_multisite) {
        $base = "/" . $site;
    } else {
        $base = '';
    }

    $input = preg_replace("/(%BASE%)/", uri_resolve($base), $input);

    if($theme_folder) $input = preg_replace("/(%THEME%)/", uri_resolve('/data/themes/' . $theme_folder), $input);

    return $input;
}

/**
 * Returns an unresolved PHP_SELF value (value without the basuri)
 * 
 * @since 2.0.0
 */
function uri_self() {
    global $config;

    $uri = $_SERVER["PHP_SELF"];

    $base_path = $config->router_baseuri;

    return substr($uri, strlen($base_path));
}
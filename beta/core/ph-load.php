<?php
/**
 * Recursively loads a directory, excluding specific paths.
 * 
 * @param string $directory     The directory to load the PHP files from.
 * @param array $exclude_paths  The paths (files & folders) to exclude when loading.
 * 
 * @since 2.0.0
 */
function load_recursively($directory, $exclude_paths = []) {
    foreach (glob($directory . '*') as $path) {
          
        if($path != __FILE__) {
             if(is_dir($path)) {

                  if(!in_array($path, $exclude_paths)) {
                        load_recursively($path . "/");
                  }

             } else {

                  if(!in_array($path, $exclude_paths)) {
                       // Check if the extension is .php, include
                       $extension = explode('.', $path);

                       if($extension[count($extension) - 1] == "php") {

                            require_once $path;

                       }
                  } 
                 

             }

        }

   }
}
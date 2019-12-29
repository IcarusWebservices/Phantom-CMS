<?php
/**
 * > Can only be included from ph-setup.php
 * 
 */
isset($__setup__) or die("Illegal entry point: __setup__ is not defined...");

function ph_autoload($directory, $exclude_paths = []) {

     foreach (glob($directory . '*') as $path) {
          
          if($path != __FILE__) {

               if(is_dir($path)) {

                    ph_autoload($path . "/");

               } else {

                    // Check if the extension is .php, include
                    $extension = explode('.', $path);

                    if($extension[count($extension) - 1] == "php") {

                         require_once $path;

                    }

               }

          }

     }
     
}
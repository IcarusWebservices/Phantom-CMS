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

                    if(!in_array($path, $exclude_paths)) {
                         ph_autoload($path . "/");
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

function ph_createdirtree($directory) {

     $result_array = [
          "__FILES__" => []
     ];

     foreach (glob($directory . '*') as $path) {

          if(is_dir($path)) {

               $r = ph_createdirtree($path . "/");

               $result_array[$path] = $r;

          } else {

              array_push($result_array["__FILES__"], $path);

          }

     }

     return $result_array;
}
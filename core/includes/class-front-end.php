<?php
/**
 * Generates a front-end webpage
 * 
 * (Basically the main class for the FRONT side of Phantom)
 * 
 * @since 2.0.0
 */
class PH_Front_End {

    /**
     * Renders a front-end page
     * 
     * @param PH_Request $request   The request to generate a front-end page
     * @param int $mode             The render mode.
     *                              0 = Normal page.
     *                              1 = Template Customizer Mode.
     * 
     * @since 2.0.0
     */
    public function render($request, $mode = 0) {
        global $loaded_packs, $routes, $request, $theme_valid;

        if(count($loaded_packs) < 1) {
            do_error_page('No logic packs enabled...', 'Go into Settings > Logic Packs to enable a pack');
        } else if (!$theme_valid) {
            do_error_page('No (valid) theme selected', 'Select a (valid) theme through Settings > Theme');
        } else if( !$request->uri_startswith_baseuri ) {
            do_error_page('Invalid base uri!', 'Set your base URI in your ph-config.php file');
        } else {
            $router = new PH_Router($request);

            if(var_check(TYPE_ARRAY, $routes)) {

                $route_candidates = [];

                foreach ($routes as $pattern => $parameters) {
                    
                    $result = $router->matchRoute($pattern);

                    if($result["compares"]) {
                        if(isset($parameters->importance)) {
                            $route_candidates[$parameters->importance] = [
                                "parameters" => $parameters,
                                "__router_params" => $result["parameters"]
                            ];
                        } else {
                            $route_candidates[1000] = [
                                "parameters" => $parameters,
                                "__router_params" => $result["parameters"]
                            ];
                        }
                    }

                }

                if(count($route_candidates) < 1) {
                    return $this->get404();
                } else {

                    krsort($route_candidates);

                    $has_found_candidate = false;

                    $selected = null;

                    // var_dump($route_candidates);

                    foreach ($route_candidates as $candidate) {
                        if(!$has_found_candidate) {
                            if(isset($candidate["parameters"]->checkerFunction)) {
                                // var_dump($candidate);
                                $cr = $candidate["parameters"]->controller;
                                $i = registry()->get('controllers', $cr);
                                if($i) {
                                    $cFunctions = $i->getProperty('checkerFunctions');

                                    if($cFunctions) {
                                        if($cFunctions[$candidate["parameters"]->checkerFunction]) {
                                            // echo 0;
                                            $result = $cFunctions[$candidate["parameters"]->checkerFunction]($candidate["__router_params"]);

                                            if($result) {
                                                // echo 0;
                                                $has_found_candidate = true;
                                                $selected = $candidate;
                                            }
                                        }
                                    }
                                }
                            } else {
                                $has_found_candidate = true;
                                $selected = $candidate;
                            }
                        }
                    }

                    if($has_found_candidate) {
                        
                        // Now load the controller

                        if(isset($selected["parameters"]->controller)) {
                            $controller = $selected["parameters"]->controller;

                            $target_method = "index";

                            if(isset($selected["parameters"]->method)) {
                                $target_method = $selected["parameters"]->method;
                            }

                            $ex = registry()->get('controllers', $controller);

                            if(var_instanceof($ex, 'PH_Export')) {

                                if($ex->hasProperty('class')) {

                                    $class = $ex->getProperty('class');

                                    if(class_exists($class)) {
                                        $instance = new $class;

                                        if(method_exists($instance, $target_method)) {
                                            
                                            // Success! All factors are green, load the template

                                            $router_parameters = new PH_Data($selected["__router_params"]);

                                            $template = $instance->$target_method( $router_parameters );

                                            if(!$template) {
                                                return $this->get404();
                                            } else {
                                                return $template;
                                            }

                                        } else {
                                            return $this->get500("Method " . $target_method . " does not exist on controller class " . $class);
                                        }

                                    } else {
                                        return $this->get500("Controller " . $controller . "'s class does not exist (". $class . ")");
                                    }

                                } else {
                                    return $this->get500("Controller " . $controller . " has no valid class.");
                                }

                            } else {
                                return $this->get500("Controller " . $controller . " is invalid");
                            }

                        } else {
                            return $this->get404();
                        }

                    } else {
                        return $this->get404();
                    }

                }

            } else {
                return $this->get404();
            }
        }

    }

    /**
     * Gets the 500 template
     * 
     * @param string $message The error message
     * 
     * @since 2.0.0
     */
    public function get500($message) {
        ob_start();

        do_error_page('Internal Server Error', $message);

        $str = ob_get_clean();
        return new PH_Document($str, 500);
    }

    /**
     * Gets the 404 template, and sets the headers to 404
     * 
     * @since 2.0.0
     */
    public function get404() {
        global $theme_folder, $theme_valid;
        ob_start();
        if($theme_valid) {

            

            if(file_exists(DATA . 'themes/' . $theme_folder . '/404.php')) {
                
                include DATA . 'themes/' . $theme_folder . '/404.php';

            } else {

                do_error_page('404', 'This page was not found...');

            }

            $str = ob_get_clean();
            return new PH_Document($str, 404);
        } else {
            do_error_page('404', 'This page was not found...');
            $str = ob_get_clean();
            return new PH_Document($str, 404);
        }
    }

}
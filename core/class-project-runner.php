<?php
/**
 * The project runner "runs" a project.
 * It takes in the name of the project & the request data, and turns it into an
 * response.
 * 
 * @since 1.0.0
 */
class PH_Project_Runner {

    /**
     * The name of the project that the project runner is currently running.
     */
    public $running_project = null;

    /**
     * Runs a project.
     * 
     * Returns 404 if the project was not found.
     * 
     * @param string    $project_name   The name of the project directory
     * @param PH_Router $router         The router to be used
     */
    public function runProject($project_name, $router) {
        if(!$this->projectExists($project_name)) return new PH_ResponseCode(501, "The selected project was not found....");

        // Now load & run the project

        $this->running_project = $project_name;

        $project_dir        = PH_PROJECTS . $project_name . '/';
        $controllers_dir    = $project_dir . 'controllers/';
        $templates_dir      = $project_dir . 'templates/';
        $routes_file        = $project_dir . 'routes.php';

        ph_autoload($controllers_dir);
        ph_autoload($templates_dir);

        if(!file_exists($routes_file)) {
            return new PH_ResponseCode(501, "The selected project has no routes.php file");
        }

        // The routes variable. This variable will be filled by the routes.php file
        $routes = [];
        require_once $routes_file;

        // Routing:
        
        if(is_array($routes)) {
            $has_found_route = false;
            $controller_selected = null;
            $parameters = [];

            foreach ($routes as $pattern => $controller) {
                if(!$has_found_route) {
                    $result = $router->comparePattern($pattern);

                    if($result["compares"]) {
                        $has_found_route = true;
                        $controller_selected = $controller;
                        $parameters = $result["parameters"];
                    }
                }
            }

            if($has_found_route) {
                
                $spl = explode('/', $controller_selected);

                $c = $spl[0];
                $m = $spl[1];

            } else {
                
            }

        } else {
            return new PH_ResponseCode(501, "The $routes parameter is not an array!");
        }

        
    }

    /**
     * Checks whether a project exists
     * 
     * @param string $project_name The name of the project
     * 
     * @return bool
     */
    public function projectExists($project_name) {
    
        return is_dir(PH_PROJECTS . $project_name);
    
    }

}
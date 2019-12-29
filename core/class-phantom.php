<?php
/**
 * The Phantom main class.
 * 
 * Sets up the front-end rendering.
 */
class Phantom {

    /**
     * The configurations object.
     * 
     * @since 1.0.0
     */
    public $config;

    /**
     * The constructor method
     * 
     * @param PH_Config $config The configuration object
     */
    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * Builds the front-end application.
     * 
     * @param PH_Request $request The request to handle routing.
     */
    public function build($request) {
        
        $uri = $request->uri;
        $base_uri = $this->config->base_uri;

        $router = new PH_Router($uri, $base_uri);

        if(!$router->has_base) {
            return 404;
        }

        $project_runner = new PH_Project_Runner;

        $root_project = $this->config->root_project;

        $output = null;

        if($this->config->only_root_project) {
            $output = $this->runRootProject($project_runner, $root_project, $router);
        } else {

            if(count($router->uri_segments) == 0) {
                $output = $this->runRootProject($project_runner, $root_project, $router);
            } else {

                $first = $router->uri_segments[0];

                if($project_runner->projectExists($first)) {

                    array_shift($router->uri_segments);

                    $output = $project_runner->runProject($first, $router);
                } else {
                    $output = $this->runRootProject($project_runner, $root_project, $router);
                }

            }

        }

        return $output;

    }
    
    /**
     * Runs the root project or returns null if the root project doesn't exist
     */
    protected function runRootProject($project_runner, $root_project, $router) {
        if($project_runner->projectExists($root_project)) {
            return $project_runner->runProject($root_project, $router);
        } else {
            return null;
        }
    }

}
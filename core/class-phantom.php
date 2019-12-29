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
        
        global $project_runner;

        $uri = $request->uri;
        $base_uri = $this->config->base_uri;

        $router = new PH_Router($uri, $base_uri);

        if(!$router->has_base) {
            return 404;
        }

        $project_runner = new PH_Project_Runner;

        $root_project = $this->config->root_project;

        $project_to_run = null;

        if($this->config->only_root_project) {
            if($project_runner->projectExists($root_project)) {
                $project_to_run = $root_project;
            } else {
                $project_to_run = null;
            }
        } else {

            if(count($router->uri_segments) == 0) {
                if($project_runner->projectExists($root_project)) {
                    $project_to_run = $root_project;
                } else {
                    $project_to_run = null;
                }
            } else {

                $first = $router->uri_segments[0];

                if($project_runner->projectExists($first)) {

                    array_shift($router->uri_segments);

                    $project_to_run = $first;
                } else {
                    if($project_runner->projectExists($root_project)) {
                        $project_to_run = $root_project;
                    } else {
                        $project_to_run = null;
                    }
                }

            }

        }

        return $project_runner->runProject($project_to_run, $router);

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
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
     * Runs a project.
     * 
     * Returns 404 if the project was not found.
     * 
     * @param string    $project_name   The name of the project directory
     * @param PH_Router $router         The router to be used
     */
    public function runProject($project_name, $router) {
        if(!$this->projectExists($project_name)) return 404;

        // Now load & run the project

        $project_dir        = PH_PROJECTS . $project_name . '/';
        $controllers_dir    = $project_dir . 'controllers/';

        return 200;
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
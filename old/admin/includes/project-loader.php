<?php
/**
 * The project loader.
 * 
 * Loads all the project files into the registry
 * 
 * @param string $project_name The name of the project
 * 
 * @since 1.0.0
 */
function ph_admin_project_loader($project_name) {
    $project = PH_PROJECTS . $project_name . '/';

    $routes = [];

    ph_autoload($project . 'controllers/');
    ph_autoload($project . 'data-types/');
    ph_autoload($project . 'templates/');

    require $project . 'routes.php';

    $editors = new PH_JSON($project . 'editors.json');

    return [
        "editors" => $editors
    ];
}
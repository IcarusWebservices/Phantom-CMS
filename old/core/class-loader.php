<?php
/**
 * Used to load classes and files within a project.
 * 
 * Shortcut code
 */
class PH_Loader {

    /**
     * Gets a template from the project
     * 
     * @param string $template_name The registered name of the template.
     * @param string $project_name  (Optional) The name of the project to be supplied to the loaded template
     * 
     * @since 1.0.0
     * 
     * @return object|null The template class instance or null if the class was not found
     */
    public function getTemplate($template_name, $project_name = null) {

        if(ph_registered("@this", "templates", $template_name)) {

            $template_class = ph_get_registered_item("@this", "templates", $template_name);

            if(class_exists($template_class)) {

                if(ph_check_class_inherits($template_class, "PH_Template")) {

                    $obj = new $template_class;

                    if($project_name) {
                        $obj->project_name = $project_name;
                    }

                    return $obj;
                } else {
                    return null;
                }

            } else {
                return null;
            }

        } else {
            return null;
        }

    }

    /**
     * Gets a controller from the project
     * 
     * @param string $controller_name The name of the registered controller.
     * @param string $project_name (Optional) The name of the running project to be supplied to the loaded controller
     * 
     * @since 1.0.0
     * 
     * @return object|null
     */
    public function getController($controller_name, $project_name = null) {
        if(ph_registered("@this", "controllers", $controller_name)) {

            $controller_class = ph_get_registered_item("@this", "controllers", $controller_name);

            if(class_exists($controller_class)) {

                if(ph_check_class_inherits($controller_class, "PH_Controller")) {

                    $obj = new $controller_class;

                    if($project_name) {
                        $obj->project_name = $project_name;
                    }

                    return $obj;
                } else {
                    return null;
                }

            } else {
                return null;
            }

        } else {
            return null;
        }
    }

}
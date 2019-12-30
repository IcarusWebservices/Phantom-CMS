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
     * 
     * @since 1.0.0
     * 
     * @return object|null The template class instance or null if the class was not found
     */
    public function getTemplate($template_name) {

        if(ph_registered("@this", "templates", $template_name)) {

            $template_class = ph_get_registered_item("@this", "templates", $template_name);

            if(class_exists($template_class)) {

                if(ph_check_class_inherits($template_class, "PH_Template")) {

                    $obj = new $template_class;

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
     * 
     * @since 1.0.0
     * 
     * @return object|null
     */
    public function getController($controller_name) {
        if(ph_registered("@this", "templates", $controller_name)) {

            $controller_class = ph_get_registered_item("@this", "templates", $controller_name);

            if(class_exists($controller_class)) {

                if(ph_check_class_inherits($controller_class, "PH_Controller")) {

                    $obj = new $controller_class;

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
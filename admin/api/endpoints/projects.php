<?php
/**
 * Endpoint for everything related to projects
 */
class Api_Endpoint_Projects extends PH_Endpoint {

    public function setWorkingProject($parameters) {
        if(session()->is_logged_in) {

            if(ph_fp_set("project_name")) {
                $name = ph_fp_get("project_name");

                session()->set("working-project", $name);

                json_response(false, []);

            } else {
                json_response(true, null, "form:notSet:project_name");
            }

        } else {
            json_response(true, null, "auth:not_logged_in");
        }
    }

}


ph_register("@api", "endpoints", "projects", [
    "class" => "Api_Endpoint_Projects",
    "routes" => [
        "/set-working-project/" => "setWorkingProject"
    ]
]);
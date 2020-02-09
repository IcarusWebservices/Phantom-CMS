<?php
require dirname(dirname(__FILE__)) . '/setup.php';

ph_autoload(PH_ROOT . 'admin/api/includes');
ph_autoload(PH_ROOT . 'admin/api/endpoints');

$router = new PH_Router($_SERVER["REQUEST_URI"], $config->base_uri . '/admin/api/');

if(isset($router->uri_segments[0])) {

    $endpoint = $router->uri_segments[0];

    if(ph_registered("@api", "endpoints", $endpoint)) {

        $item = ph_get_registered_item("@api", "endpoints", $endpoint);

        $class = $item["class"];
        $routes = $item["routes"];

        if(class_exists($class) && ph_check_class_inherits($class, "PH_Endpoint")) {

            $endpoint_controller = new $class;

            $found = false;

            foreach ($routes as $route => $method) {
                if(!$found) {

                    $full_route = $endpoint . $route;

                    $result = $router->comparePattern( $full_route );

                    if($result["compares"]) {
                        if(method_exists($endpoint_controller, $method)) {
                            $endpoint_controller->$method( $result["parameters"] );
                            $found = true;
                        }
                    }
                }
            }

            if(!$found) {
                json_response(true, null, "This route was not found");
            }

        }

    } else {
        json_response(true, null, "The endpoint was not found");
    }

} else {
    json_response(true, null, "No endpoint was provided");
}

?>
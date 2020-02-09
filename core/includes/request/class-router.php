<?php
/**
 * The main routing class.
 * 
 * Routes request to specific patterns
 * 
 * @since 2.0.0
 */
class PH_Router {

    /**
     * The request used by the router
     * 
     * @since 2.0.0
     */
    public $request;

    /**
     * Initializes the router
     * 
     * @param PH_Request $request The request to use
     * 
     * @since 2.0.0
     */
    public function __construct($request)
    {
        if(var_instanceof($request, 'PH_Request')) {
            $this->request = $request;
        }
    }

    /**
     * Compares a route pattern to the request
     * 
     * @since 2.0.0
     */
    public function matchRoute($route_pattern) {
        $auri = $this->request->request_uri;
        $aseg = explode('/', $auri);

        $pseg = explode('/', $route_pattern);

        if(count($aseg) > 0) {
            if($aseg[0] == "") {
                array_shift($aseg);
            }
            if(isset($aseg[count($aseg) - 1])) {
                if($aseg[count($aseg) - 1] == "") {
                    array_pop($aseg);
                }
            }
        }

        if(count($pseg) > 0) {
            if($pseg[0] == "") {
                array_shift($pseg);
            }
            if(isset($pseg[count($pseg) - 1])) {
                if($pseg[count($pseg) - 1] == "") {
                    array_pop($pseg);
                }
            }
        }

        if(count($pseg) == count($aseg)) {
            $going = true;
            $parameters = [];

            for ($i=0; $i < count($pseg); $i++) { 
                if($going) {
                    $psegment = $pseg[$i];
                    $asegment = $aseg[$i];
    
                    if(substr($psegment, 0, 1) == ':') {
                        
                        $parameters[substr($psegment, 1)] = $asegment;

                    } elseif($psegment != $asegment ) {
                        $going = false;
                    } 
                }
            }

            return [
                "compares" => $going,
                "parameters" => $parameters
            ];
        } else {
            return [
                "compares" => false,
                "parameters" => []
            ];
        }
    }

}
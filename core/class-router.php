<?php
/**
 * The router class.
 * Used for a) comparing routing patterns and b) for getting specific URI segments.
 * 
 * @since 1.0.0
 */
class PH_Router {

    /**
     * The URI (base-uri removed)
     */
    protected $uri;

    /**
     * The URI segments.
     * The base-uri has been removed
     */
    public $uri_segments = [];

    /**
     * The base uri.
     * Usually set from the config.
     */
    public $base_uri = null;

    /**
     * If the uri starts with the base_uri
     */
    public $has_base = false;

    /**
     * The constructor method
     * 
     * @param string $uri       The uri to route
     * @param string $base_uri  (Optional) The base-uri to remove from the URI. 
     *                          If the URI does not start with the base uri, 
     *                          the proporty "has_base" will be set to false.
     */
    public function __construct($uri, $base_uri = null) {
        
        $blength = strlen($base_uri);

        $startc = substr($uri, 0, $blength);

        if( $startc == $base_uri ) {
            $this->uri = substr($uri, $blength);
            $this->has_base = true;

            $this->setUriSegments();
        } else {
            $this->uri = null;
            $this->has_base = false;
        }

    }

    /**
     * Sets up the URI segments from the uri proporty
     * 
     * @since 1.0.0
     */
    protected function setUriSegments() {
        $split = explode('/', $this->uri);

        if(count($split) > 0) {
            if($split[0] == "") {
                array_shift($split);
            }
    
            if(isset($split[count($split)  - 1])) {
                if($split[count($split) - 1] == "") {
                    array_pop($split);
                }
            }
        } 

        $this->uri_segments = $split;
    }

    /**
     * This method compares a URI pattern to the actual URI.
     * 
     * The pattern is according to the IcarusURIPattern specification
     * 
     * @since 1.0.0
     */
    public function comparePattern($pattern) {

        $pattern_segments = explode('/', $pattern);

        if(count($pattern_segments) > 0) {
            if($pattern_segments[0] == "") {
                array_shift($pattern_segments);
            }

            if(isset($pattern_segments[count($pattern_segments) - 1])) {
                if($pattern_segments[count($pattern_segments) - 1] == "") {
                    array_pop($pattern_segments);
                }
            }
        }

        $pl = count($pattern_segments);
        $ul = count($this->uri_segments);

        $isGoing = true;
        $parameters = [];

        if($pl == $ul) {

            for ($i=0; $i < $pl; $i++) { 
                if($isGoing) {
                    $pseg = $pattern_segments[$i];
                    $useg = $this->uri_segments[$i];
    
                    if(substr($pseg, 0, 1) == ":") {
                        
                        $parname = substr($pseg, 1);
                        $value = $useg;

                        $parameters[$parname] = $value;

                    } else {
                        if($pseg != $useg) {
                            $isGoing = false;
                        }
                    }
                } 
            }

        } else {
            $isGoing = false;
        }

        return [
            "compares" => $isGoing,
            "parameters" => $parameters
        ];

    }

}
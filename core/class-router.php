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

        if($split[0] == "") {
            array_shift($split);
        }

        if($split[count($split) - 1] == "") {
            array_pop($split);
        }

        $this->uri_segments = $split;
    }

}
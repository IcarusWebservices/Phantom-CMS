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
        
    } 

}
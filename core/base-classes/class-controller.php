<?php
/**
 * The base controller class
 * Inherit this class to make a controller.
 * Controller who do not inherit this class, will not be seen as valid by Phantom
 * 
 * @since 1.0.0
 * @abstract
 */
abstract class PH_Controller {

    /**
     * The index method must always be set.
     * Will be called whenever a route has a reference to a non-existing method OR reference to method at all.
     * 
     * @param array     $parameters The parameters from the route.
     * @param PH_Router $router     The router with the request data.
     */
    abstract function index( $parameters, $router );

    /**
     * The load class.
     * 
     * Will be supplied by the project runner
     * 
     * @since 1.0.0
     */
    public $loader = null;

}
<?php
/**
 * (Example)
 * The homepage controller.
 */
class Example_HomepageController extends PH_Controller {

    function index($parameters, $router)
    {
        
    }

}

ph_register("@this", "controllers", "HomepageController", "Example_HomepageController");
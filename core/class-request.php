<?php
/**
 * The request class.
 * 
 * Contains the raw URI, the query parameters and the form data.
 * 
 */
class PH_Request {

    /**
     * The URI used.
     * A URI is everything after the website name.
     * (
     *  Full URL: https://www.example.com/my-project/my-first-route-param/my-second-route-param/
     *  Full URI: /my-project/my-first-route-param/my-second-route-param/
     * )
     * 
     * Gathered either from $_SERVER["REQUEST_URI"] or via manual input
     */
    public $uri = "";

    /**
     * The query parameters.
     * Gathered either from $_GET or via manual input.
     */
    public $query_parameters = [];

    /**
     * The form data parameters.
     * Gathered either from $_POST or via manual input.
     */
    public $form_data = [];

    /**
     * The constructor method
     * 
     * @param string $uri               (Optional) Manually set the URI param
     * @param array  $query_parameters  (Optional) Manually set the query parameters
     * @param array  $form_data         (Optional) Manually set the form data
     */
    public function __construct($uri = null, $query_parameters = null, $form_data = null) {
        if(!$uri) {
            $this->uri = $_SERVER["REQUEST_URI"];
        } else $this->uri = $uri;

        if(!$query_parameters) {
            $this->query_parameters = $_GET;
        } else $this->query_parameters = $query_parameters;

        if(!$form_data) {
            $this->form_data = $_POST;
        } else $this->form_data = $form_data;
    }

}
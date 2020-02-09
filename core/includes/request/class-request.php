<?php
/**
 * The request to the server
 * 
 * @since 2.0.0
 */
class PH_Request {

    /**
     * The query parameters
     * 
     * @since 2.0.0
     */
    public $query_parameters = [];

    /**
     * The request URI
     * 
     * @since 2.0.0
     */
    public $request_uri = null;

    /**
     * The request method
     * 
     * @since 2.0.0
     */
    public $request_method = GET;

    /**
     * The form data parameters
     * 
     * @since 2.0.0
     */
    public $form_parameters = [];

    /**
     * Whether the uri starts with the base-uri from the config
     * 
     * @since 2.0.0
     */
    public $uri_startswith_baseuri = true;

    /**
     * The constructor method
     * 
     * @since 2.0.0
     */
    public function __construct($uri = null, $method = null, $query_parameters = null, $form_parameters = null)
    {
        if($uri) $this->request_uri = $uri;
        else $this->request_uri = $_SERVER["REQUEST_URI"];

        if($method) $this->request_method = $method;
        else {
            $o = GET;
            switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $o = GET;
                break;
                case "POST":
                    $o = POST;
                break;
                default: 
                    $o = GET;
                break;
            }
            $this->request_method = $o;
        }

        if($query_parameters) $this->query_parameters = $query_parameters;
        else $this->query_parameters = $_GET;

        if($form_parameters) $this->form_parameters = $form_parameters;
        else $this->form_parameters = $_POST;
        
    }

    /**
     * Applies a base uri to the uri, to check whether the uri starts with the base uri.
     * After that, the base-uri is subtracted from the uri.
     * 
     * @param string $base_uri The base uri
     * 
     * @since 2.0.0
     */
    public function applyBaseURI($base_uri) {
        $uri_start = substr($this->request_uri, 0, strlen($base_uri));

        if($uri_start === $base_uri) {
            $this->request_uri = substr($this->request_uri, strlen($base_uri));
            $this->uri_startswith_baseuri = true;
        } else {
            $this->uri_startswith_baseuri = false;
        }
    }

}
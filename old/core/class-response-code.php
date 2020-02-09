<?php
/**
 * Represents a response code for a request.
 * 
 * @since 1.0.0
 */
class PH_ResponseCode {

    /**
     * The code for the request.
     * Must be according to the HTTP standards.
     * 
     * Example:
     * 200 - Request OK
     * 403 - Forbidden
     * 404 - The requested document was not found
     * 501 - Internal server error
     * @since 1.0.0
     */
    public $code = 200;

    /**
     * A small description to be passed to the default response generator
     * @since 1.0.0
     */
    public $description = null;

    /**
     * The constructor method
     * 
     * @param int       $code           The response code.
     * @param string    $description    The description for the response.
     * 
     * @return void
     */
    public function __construct($code, $description)
    {
        $this->code = $code;
        $this->description = $description;
    }

}
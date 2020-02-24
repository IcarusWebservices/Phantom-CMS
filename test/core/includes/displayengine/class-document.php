<?php
/**
 * The document class holds a full string of HTML to be rendered by the main pipe-line,
 * together with additional response headers like the response code.
 * 
 * 
 * @since 2.0.0
 */
class PH_DisplayEngine_Document {

    /**
     * The string containing the document string
     * 
     * @since 2.0.0
     */
    public $document = null;

    /**
     * The HTTP response code
     * 
     * @since 2.0.0
     */
    public $http_response_code = 200;

    /**
     * The content type to return
     * 
     * @since 2.0.0
     */
    public $content_type = "text/html";

    /**
     * The constructor method
     * 
     * @param string    $document       The document string.
     * @param int       $code           (Optional) The http response code. Must follow the HTTP specification.
     * @param string    $content_type   (Optional) The content type. Must follow the HTTP specification.
     * 
     * @since 2.0.0
     */
    public function __construct($document, $code = 200, $content_type = "text/html")
    {
        $this->document = $document;

        // Now process the document before setting up the headers
        $this->processDocument();

        $this->http_response_code = is_integer($code) ? $code : 200;
        $this->content_type = is_string($content_type) ? $content_type : "text/html";
    }

    /**
     * Renders a the document, and sets the headers
     * 
     * @since 2.0.0
     */
    public function render() {
        // Set the response code
        http_response_code($this->http_response_code);
        // Set the other headers
        header('Content-Type: ' . $this->content_type);
        // Echo the webpage
        echo $this->document;
    }

    /**
     * Does some text processing on the document to make it more efficient
     * 
     * @since 2.0.0
     */
    protected function processDocument() {
        $this->document = trim($this->document);
    }

}

<?php
/**
 * Represents a requested stylesheet
 * 
 * @since 2.0.0
 */
class PH_Requested_Stylesheet {

    /**
     * The relative URI to the stylesheet.
     * Use uri_resolve().
     * 
     * @since 2.0.0
     */
    public $relative_uri = null;

    /**
     * Constructor method
     * 
     * @param string $relative_uri The relative uri to the stylesheet
     * 
     * @since 2.0.0
     */
    public function __construct($relative_uri)
    {
        $this->relative_uri = $relative_uri;
    }

    /**
     * Renders the requested stylesheet
     * 
     * @since 2.0.0
     */
    public function render() {
        ?>
        <link rel="stylesheet" href="<?= $this->relative_uri ?>">
        <?php
    }
}
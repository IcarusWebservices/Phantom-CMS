<?php
/**
 * Editor field base class
 * 
 * @since 2.0.0
 */
abstract class PH_Editor_Field {

    /**
     * Renders the element
     * 
     * @since 2.0.0
     */
    abstract function render($exportID, $preData);

    /**
     * Requested scripts for the editor
     * 
     * @since 2.0.0
     */
    public $requested_scripts = [];

}
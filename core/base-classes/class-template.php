<?php
/**
 * The base template class.
 * 
 * Contains a rendered body and some requested headers.
 * 
 * @since 1.0.0
 * @abstract
 */
abstract class PH_Template {

    /**
     * Is called whenever the template is being rendered.
     * HTML can either be placed by closing PHP tags and opening them after (output buffering is enabled by default)
     * or by return an HTML string.
     * 
     * The output buffer is ignored if the method returns a string.
     * 
     * @param array $input_data The input data from the controller
     * 
     * @return string|null
     * 
     * @abstract
     */
    abstract function renderBody( $input_data );

}
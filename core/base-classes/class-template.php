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

    /**
     * This proporty contains the assigned data from the controller.
     * 
     * This data is transfered to the renderBody method in the form of the first argument
     */
    protected $assigned_data = [];

    /**
     * The title of the webpage.
     * 
     * Will be displayed before the name of the website:
     * [Webpage title] - [Website name]
     */
    public $title = "default";

    /**
     * This adds a value to the assigned data proporty
     * 
     * @param array $data The data to add. Add in the form of an ASSOC array!
     * 
     * @since 1.0.0
     */
    public function addData( $data ) {
        
        if(is_array($data)) {
            $this->assigned_data = array_merge($this->assigned_data, $data);
        }
  
    }

    /**
     * Returns the full array of assigned data
     * 
     * @since 1.0.0
     * 
     * @return array
     */
    public function getData() {
        return $this->assigned_data;
    }

}
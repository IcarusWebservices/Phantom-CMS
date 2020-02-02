<?php
/**
 * The base-class for templates
 * 
 * @since 2.0.0
 */
abstract class PH_Template {
    
    /**
     * Render method. 
     * Must return either a string of HTML OR must output html code to be picked up by an output buffer.
     * 
     * @param PH_Data $input The input data delivered by a controller
     * 
     * @abstract
     * @since 2.0.0
     */
    abstract public function render($input);

    /**
     * The stylesheets to be requested on rendering
     * 
     * @since 2.0.0
     */
    public $requested_stylesheets = [];

    /**
     * The header-scripts to be requested on rendering
     * 
     * @since 2.0.0
     */
    public $requested_header_scripts = [];

    /**
     * The end-of-body scripts to be requested on rendering
     * 
     * @since 2.0.0
     */
    public $requested_body_scripts = [];

    /**
     * The requested meta-tags to be placed within the header
     * 
     * @since 2.0.0
     */
    public $requested_meta_tags = [];

    /**
     * The requested title.
     * 
     * @since 2.0.0
     */
    public $requested_title = null;

    /**
     * The data to be used when rendering
     * 
     * @since 2.0.0
     */
    protected $data = null;

    /**
     * Adds data to the template data
     * 
     * @param array $data The array containing the data for the template.@ 
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function addData($data) {
        if(var_check(TYPE_ARRAY, $this->data)) {
            array_merge($this->data, $data);
        } else {
            $this->data = $data;
        }
    }

    /**
     * (Only used by Phantom CMS itself)
     * 
     * Turns the data property into a PH_Data object
     * 
     * @since 2.0.0
     * 
     * @return PH_Data
     */
    public function __get_data() {
        if(var_check(TYPE_ARRAY, $this->data)) {
            return new PH_Data($this->data);
        } else return new PH_Data([]);
    }

}
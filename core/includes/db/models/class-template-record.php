<?php
/**
 * Represents a template record within the database
 * 
 * @since 2.0.0
 */
class PH_Template_Record extends PH_Model_Base {

    public $id;

    public $type;

    public $data;

    public $slug;

    public $language;

    public $site;

    public function __construct($data)
    {
        $this->processInputData($data);   
    }

}
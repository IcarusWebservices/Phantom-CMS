<?php
/**
 * Represents a site within the database
 * 
 * @since 2.0.0
 */
class PH_Site extends PH_Model_Base {

    public $id = null;
    public $slug = null;
    public $name = null;

    public function __construct($data)
    {   
        $this->processInputData($data);
    }

}
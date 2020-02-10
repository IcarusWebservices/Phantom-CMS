<?php
/**
 * Represents a taxonomy term in the database
 * 
 * @since 2.0.0
 */
class PH_Taxonomy extends PH_Model_Base{

    public $id;
    public $record_id;
    public $type;
    public $value;

    public function __construct($data)
    {
        $this->processInputData($data);        
    }

}
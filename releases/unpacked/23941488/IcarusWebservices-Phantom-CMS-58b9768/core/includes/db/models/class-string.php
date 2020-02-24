<?php
/**
 * Represents a string within the database
 * 
 * @since 2.0.0
 */
class PH_String extends PH_Model_Base
{

    public $id = null;
    public $language_code = "en";
    public $string_name = null;
    public $string_value = null;

    public function __construct($data)
    {
        $this->processInputData($data);
    }

}
<?php
/**
 * Represents a logic pack within the database
 * 
 * @since 2.0.0
 */
class PH_Logic_Pack_DB extends PH_Model_Base {

    public $id = null;
    public $folder_name = null;
    public $enabled = null;
    public $importance = null;

    /**
     * The constructor method
     * 
     * @param array $data An assoc object with values
     * 
     * @since 2.0.0
     */
    public function __construct($data = [])
    {
        $this->processInputData($data);
    }

}
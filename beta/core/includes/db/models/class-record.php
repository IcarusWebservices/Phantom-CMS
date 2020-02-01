<?php
/**
 * Represents a record within the database
 * 
 * @since 2.0.0
 */
class PH_Record extends PH_Model_Base {

    // ========= Rows =========
    public $id = null;
    public $type = null;
    public $status = null;
    public $title = null;
    public $content = null;
    public $created_gmt = null;
    public $updated_gmt = null;
    public $author = null;

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
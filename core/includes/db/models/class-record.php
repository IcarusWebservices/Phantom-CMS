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
    public $slug = null;
    public $title = null;
    public $content = null;
    public $created_gmt = null;
    public $updated_gmt = null;
    public $author = null;
    public $site = null;

    // ========= Non-rows properties =========
    public $processed_content = null;

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

    /**
     * Gets the record type and applies its content processing
     * 
     * @since 2.0.0
     */
    public function applyRecordType() {
        $r_type = get_record_type($this->type);

        if(is_object($r_type)) {
            if(var_inherits($r_type, 'PH_Record_Type') || var_inherits($r_type, 'PH_Message_Record_Type')) {
                $this->processed_content = $r_type->processContent( $this->content );
            } else {
                $this->processed_content = $this->content;
            }
        } else {
            $this->processed_content = $this->content;
        }
    }

}
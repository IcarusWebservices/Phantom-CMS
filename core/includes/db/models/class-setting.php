<?php
/**
 * Represents a setting within the DB.
 * 
 * Reference: Accepted Settings
 * - `appearance_theme` : The name of the theme folder
 * 
 * @since 2.0.0
 */
class PH_Setting extends PH_Model_Base {

    /**
     * Whether the setting exists on the database
     * 
     * (Used for PH_Save)
     */
    public $exists_on_db = false;

    /**
     * The name of the setting
     * 
     * @since 2.0.0
     */
    public $key;

    /**
     * The value of the settings
     * 
     * @since 2.0.0
     */
    public $value;

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
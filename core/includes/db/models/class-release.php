<?php
/**
 * Represents a release within the database
 * 
 * @since 2.0.0
 */
class PH_Release extends PH_Model_Base {

    /**
     * The ID of the release
     * 
     * @since 2.0.0
     */
    public $id;

    /**
     * The version-string of the release
     * 
     * @since 2.0.0
     */
    public $version_string;

    /**
     * The name of the release
     * 
     * @since 2.0.0
     */
    public $name;

    /**
     * Whether the release is the currently installed version
     * 
     * @since 2.0.0
     */
    public $is_current_version;

    /**
     * The URL to the zipball for a release download
     * 
     * @since 2.0.0
     */
    public $zipball;

    /**
     * The date of release
     * 
     * @since 2.0.0
     */
    public $released_at;

    /**
     * Constructor method
     * 
     * @param array $data The data to insert into this class
     * 
     * @since 2.0.0
     */
    public function __construct($data)
    {
        $this->processInputData($data);
    }

}
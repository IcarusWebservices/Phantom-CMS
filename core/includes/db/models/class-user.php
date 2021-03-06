<?php
/**
 * Represents a user within the database
 * 
 * @since 2.0.0
 */
class PH_Admin_User extends PH_Model_Base {

    public $id = null;
    public $permissions_int = null;
    public $first_name = null;
    public $last_name = null;
    public $username = null;
    public $email = null;
    public $password_hash = null;
    public $password = null;
    public $data = null;

    public function __construct($data)
    {
        $this->processInputData($data);
    }

}
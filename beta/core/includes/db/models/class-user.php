<?php
/**
 * Represents a user within the database
 * 
 * @since 2.0.0
 */
class PH_User extends PH_Model_Base {

    public $username = null;
    public $email = null;
    public $password_hash = null;
    public $password = null;

    public function __construct($data)
    {
        $this->processInputData($data);
    }

}
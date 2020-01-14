<?php
/**
 * Represents a user within the database
 * 
 * @since 1.0.0
 */
class PH_User {

    /**
     * The id of the user.
     * Should be null if the user does not exist yet.
     * 
     * @since 1.0.0
     */
    public $id;

    /**
     * The username of the user.
     * 
     * @since 1.0.0
     */
    public $username;

    /**
     * The password of the user (hashed)
     * 
     * @since 1.0.0
     */
    public $hashed_password;

    /**
     * The constructor method.
     * 
     * @param int       $id                 (Optional) The id of the user. Only set if the user exists within the database.
     * @param string    $username           The username of the user.
     * @param string    $hashed_password    The hashed password of the user
     * 
     * @since 1.0.0
     */
    public function __construct($id = null, $username, $hashed_password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->hashed_password = $hashed_password;
    }

}
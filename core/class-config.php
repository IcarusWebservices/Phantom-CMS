<?php
/**
 * The configuration class.
 * 
 * Contains keys with values.
 * 
 * @since 1.0.0
 */
class PH_Config {

    /**
     * (Value)
     * Which project should be called from the root directory.
     * If the flag "only_root_project" is set to true, only the routes from this project will be used.
     * @since 1.0.0
     */
    public $root_project = "main";

    /**
     * (Flag)
     * Whether the root project should be the only project.
     * If set to true, all the routes after the root will be controlled by the project.
     * If set to false, the root project will be set from the URI root, while other projects will be accessed
     * from the first subdirectory (with the same name) ('/' = root project, '/:project/' = other project)
     * @since 1.0.0
     */
    public $only_root_project = true;

    /**
     * (Value)
     * The server-name of the database.
     * In most cases, this is 'localhost'.
     * @since 1.0.0
     */
    public $database_server_name = "localhost";

    /**
     * (Value)
     * The username of the database
     * @since 1.0.0
     */
    public $database_username = null;

    /**
     * (Value)
     * The name of the database which stores the Phantom tables
     * @since 1.0.0
     */
    public $database_database = null;

    /**
     * !Protected! Set using the method setDatabasePassword()
     * (Value)
     * The password of the database.
     * @since 1.0.0
     */
    protected $database_password = null;

    /**
     * Sets the password to the database
     * 
     * @param string $password The database password.
     * 
     * @return void
     */
    public function setDatabasePassword($password) {
        $this->database_password = $password;
    }

}
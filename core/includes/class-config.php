<?php
/**
 * Configuration class.
 * 
 * Holds all the config values.
 * 
 * @since 2.0.0
 * 
 * @package Phantom.Core
 */
class PH_Config {

    // The username of the database
    public $db_username = "";

    // The password of the database
    public $db_password = "";

    // The hostname of the database
    public $db_hostname = "";

    // The name of the database
    public $db_database = "";

    // The character set used by the database
    public $db_charset = "utf8mb4";

    // The base-path for the router
    public $router_baseuri = "/";

    // Whether the site is a multisite
    public $is_multisite = false;

}

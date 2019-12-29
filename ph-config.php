<?php
$config = new PH_Config();

// The server name of the database
$config->database_server_name = "localhost";
// The username of the database
$config->database_username = "test";
// The password to the database
$config->setDatabasePassword("test");
// The name of the database
$config->database_database = "phantom";
// The base-uri to be removed from the URI
$config->base_uri = null;
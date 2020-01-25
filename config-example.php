<?php
// !Do not modify this file!
// Phantom edits this file based on the line number. Do NOT change the lines.
$config = new PH_Config();

// The root project
$config->root_project = "example";
// Whether there should only be the root project
$config->only_root_project = true;
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
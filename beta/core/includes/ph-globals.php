<?php
/**
 * This file contains functions accessing global variables
 * 
 * @since 2.0.0
 */

/**
 * Returns the global logger
 * 
 * @since 2.0.0
 */
function logger() {
    global $logger;
    return $logger;
}

/**
 * Returns the global database
 * 
 * @since 2.0.0
 */
function database() {
    global $database;
    return $database;
}

/**
 * Returns the global registry
 * 
 * @since 2.0.0
 */
function registry() {
    global $registry;
    return $registry;
}
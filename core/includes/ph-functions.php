<?php
/**
 * All general functions to be used within Phantom
 * 
 * @package Phantom.Core
 */

/**
 * Gets a record type controller by slug
 * 
 * @param string $slug The record type slug
 * 
 * @return PH_Record_Type|false
 * 
 * @since 2.0.0
 */
function get_record_type($slug) {
    if(record_type_exists($slug)) {
        $data = registry()->get(CAT_RECORD_TYPES, $slug);
        if(var_instanceof($data, 'PH_Export')) {

            // Do validation
            $is_valid = validate_record_type($data);

            if($is_valid) {

                $class = $data->getProperty('class');

                if(class_exists($class)) {

                    $instance = new $class;

                    return $instance;

                } else {
                    return false;
                }

            } else {
                return false;
            }

        }
    } else {
        return false;
    }
}

/**
 * Checks if a record type exists
 * 
 * @param string $slug The record type slug
 * 
 * @return bool
 * 
 * @since 2.0.0
 */
function record_type_exists($slug) {
    return registry()->has(CAT_RECORD_TYPES, $slug);
}

/**
 * Creates a PH_Export object
 * 
 * @since 2.0.0
 */
function export($slug, $data = []) {
    return new PH_Export($slug, $data);
}
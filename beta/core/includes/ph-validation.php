<?php
/**
 * This file contains functions related to validation, of all sorts
 * 
 * @since 2.0.0
 */

/**
 * Checks if a registered record type follow the required fields
 * 
 * @param PH_Export $record_type    The registered record type to check
 * 
 * @return bool
 * 
 * @since 2.0.0
 */
function validate_record_type($record_type) {
    // Now check all the required parameters
    // This is according to the record type specification
    return all_true(
        $record_type->hasProperty('class')
    );
}
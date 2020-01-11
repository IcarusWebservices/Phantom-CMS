<?php
/**
 * The base class for all record data types
 * 
 * @since 1.0.0
 */
abstract class PH_Data_Type {

    /**
     * Should process the content.
     * 
     * Should return an assoc array if the content was parsed correctly, 
     * and return NULL when the content wasn't parsed correctly.
     * 
     * @since 1.0.0
     */
    public function process_content($content) {
        return null;
    }

}
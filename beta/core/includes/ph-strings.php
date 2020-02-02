<?php
/**
 * Gets a translational string.
 * 
 * Strings retrieved from the ph_strings table.
 * If the string doesn't exists, it will create a new row in the database.
 * 
 * @param string $string    The ID of the string
 * 
 * @since 2.0.0
 * 
 * @return string
 */
function get_string($string) {
    global $language_code;

    $a = PH_Query::strings([
        "==string_name" => $string
    ]);

    if(count($a) > 0) {
        // The string for the language was found
        $language_string = null;

        foreach ($a as $string) {
            if($string->language_code == $language_code) {
                $language_string = $string;
            }
        }

        if($language_string) {
            return $language_string->string_value;
        } else {
            return $a[0]->string_value;
        }
    } else {
        return null;
    }
}

/**
 * Gets a setting string from the database
 * 
 * @param string $key   The key of the setting
 * 
 * @since 2.0.0
 * 
 * @return string
 */
function get_setting_string() {

}
<?php
/**
 * The base class for all record data types
 * 
 * @since 1.0.0
 */
abstract class PH_Data_Type extends PH_BASE {

    /**
     * Should process the content.
     * 
     * Should return an assoc array if the content was parsed correctly, 
     * and return NULL when the content wasn't parsed correctly.
     * 
     * @since 1.0.0
     */
    public abstract function processContent($content);

    /**
     * Takes in the input data from the editor on either a 'new save' or 'edit save'.
     * 
     * Should return a PH_Record object. 
     * 
     * @param PH_JSON $input The data from the editor
     * 
     * @return PH_Record
     * 
     * @since 1.0.0
     */
    public abstract function editorDataToRecord($input);

}
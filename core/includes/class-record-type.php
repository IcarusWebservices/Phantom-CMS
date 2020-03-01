<?php
/**
 * The base class for record types.
 * 
 * Extend to create a record type.
 * 
 * @since 2.0.0
 */
abstract class PH_Record_Type {

    /**
     * Takes in the raw text from the `record_content` column in the `ph_records` table, 
     * and must transform it into a `PH_Data` object.
     * 
     * @abstract 
     * 
     * @param string $content   The content delivered by the database
     * 
     * @return PH_Data The data to be returned
     * 
     * @since 2.0.0
     */
    abstract public function processContent($content);

    /**
     * Takes in the PH_Data object delivered by the editor associated with the record type (see `logic-pack.json`), 
     * and must return a `PH_Record` object with the edited data. 
     * If the $previousRecord argument is null it means that the record is a new record. 
     * If the $previousRecord argument is a `PH_Record` object it means that this is already an existing record that needs to be updated.
     * 
     * @param PH_Data $rawEditorData The editor data delivered by the editor associated with the record type.
     * @param PH_Record $previousRecord The previous record, only if the save is for an already existing record (mode = edit).
     * 
     * @return PH_Record The record to be saved 
     * 
     * @since 2.0.0
     */
    abstract public function saveRecord($rawEditorData, $previousRecord = null);

    /**
     * Provides the editor with data. Only called when editing a record.
     * 
     * @param string $content   The content delivered by the database
     * 
     * @return array $content   The data to be delivered to the editor fields
     * 
     * @since 2.0.0
     */
    abstract public function provideEditordata($content);

}
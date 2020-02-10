<?php
/**
 * The action class executes actions on the database, like UPDATE and INSERT
 * 
 * @since 2.0.0
 */
class PH_Save {

    /**
     * Inserts or updates a record, depending on whether the ID exists
     * 
     * @param PH_Record $record The record to perform the action on.
     * 
     * @since 2.0.0
     */
    public static function record( $record ) {
        
        $properties = [
            "record_type" => $record->type,
            "record_status" => $record->status,
            "record_slug" => $record->slug,
            "record_title" => $record->title,
            "record_content" => $record->content,
            "record_author" => $record->author
        ];

        if($record->id) {
            $properties["record_updated_gmt"] = date("Y-m-d H:i:s");
            return database()->update('ph_records', $properties, [
                "==record_id" => $record->id
            ]);
        } else {
            $properties["record_created_gmt"] = date("Y-m-d H:i:s");
            
            return database()->insert('ph_records', $properties);

        }

    }

}
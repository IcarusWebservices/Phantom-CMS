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
            "record_author" => $record->author,
            "site" => $record->site
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

    /**
     * Inserts or updates a setting
     * 
     * @param PH_Setting $setting The setting to update
     * 
     * @since 2.0.0
     * 
     * @return bool
     */
    public static function setting($setting) {
        global $site_id;
        
        $where = [
            "==setting_key" => $setting->key
        ];

        if($site_id) {
            $where["==site"] = $site_id;
        } else {
            $where["NLsite"] = null;
        }

        if($setting->exists_on_db) {
            $properties = [
                "setting_value" => $setting->value
            ];
            
            return database()->update('ph_settings', $properties, $where);
        } else {
            $properties = [
                "setting_key" => $setting->key,
                "setting_value" => $setting->value
            ];
            return database()->insert('ph_settings', $properties);
        }
    }

}
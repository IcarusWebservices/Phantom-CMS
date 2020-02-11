<?php
/**
 * Query makes executing queries to the Phantom tables easier
 * 
 * @since 2.0.0
 */
class PH_Query {

    /**
     * Records table query
     * 
     * Returns an array of PH_Record-s
     * 
     * @since 2.0.0
     */
    public static function records($where = []) {
        if(qp_set('dbless')) {
            return [];
        }
        if(var_check(TYPE_ARRAY, $where)) {
            $result = database()->select('ph_records', ['*'], $where);

            if($result->hasResult()) {
                $o = [];

                foreach ($result as $i) {

                    $dbstat = $i->record_status;
                    $status = PUBLISHED;

                    switch($dbstat) {

                        case PUBLISHED:
                            $status = PUBLISHED;
                        break;

                        case AWAITING_REVIEW:
                            $status = AWAITING_REVIEW;
                        break;

                        case PRIVATE_RECORD:
                            $status = PRIVATE_RECORD;
                        break;

                        case DRAFT:
                            $status = DRAFT;
                        break;

                    }

                    $record = new PH_Record([
                        "id" => $i->record_id,
                        "type" => $i->record_type,
                        "status" => $status,
                        "slug" => $i->record_slug,
                        "title" => $i->record_title,
                        "content" => $i->record_content,
                        "created_gmt" => $i->record_created_gmt,
                        "updated_gmt" => $i->record_updated_gmt,
                        "author" => $i->record_author
                    ]);

                    $record->applyRecordType();

                    array_push($o, $record);
                }

                return $o;
            } else return [];

        } else return [];
    }

    /**
     * Logic packs query
     * 
     * @param array $where      The where parameters
     * @param string $order_by  Order by column
     * 
     * @since 2.0.0
     */
    public static function logic_packs($where = [], $order_by = null) {
        
        if(var_check(TYPE_ARRAY, $where)) {
            
            $result = database()->select('ph_logic_packs', ['*'], $where, null, null, $order_by);

            if($result->hasResult()) {
                $o = [];

                foreach ($result as $i) {
                    array_push($o, new PH_Logic_Pack_DB([
                        "id" => $i->id,
                        "folder_name" => $i->folder_name,
                        "enabled" => $i->enabled,
                        "importance" => $i->importance
                    ]));
                }

                return $o;
            } else return [];

        } else return [];
    }

    /**
     * Returns a setting from the database
     * 
     * @param array $where The where clause
     * 
     * @since 2.0.0
     * 
     * @return array Array of settings
     */
    public static function settings($where = []) {
        if(var_check(TYPE_ARRAY, $where)) {
            $result = database()->select('ph_settings', ['*'], $where);

            if($result->hasResult()) {
                $o = [];

                foreach ($result as $i) {
                    array_push($o, new PH_Setting([
                        "key" => $i->setting_key,
                        "value" => $i->setting_value,
                        "exists_on_db" => true
                    ]));
                }

                return $o;
            } else return [];

        } else return [];
    }

    /**
     * Gets a string from the database
     * 
     * @param array $where The where data to query
     * 
     * @since 2.0.0
     * 
     * @return array Array of strings
     */
    public static function strings($where) {
        if(var_check(TYPE_ARRAY, $where)) {
            $result = database()->select('ph_strings', ['*'], $where);

            if($result->hasResult()) {
                $o = [];

                foreach ($result as $i) {
                    array_push($o, new PH_String([
                        "id" => $i->id,
                        "language_code" => $i->language_code,
                        "string_name" => $i->string_name,
                        "string_value" => $i->string_value
                    ]));
                }

                return $o;
            } else return [];

        } else return [];
    }

    /**
     * Queries a user from the database
     * 
     * @param array $where The where data to query
     * 
     * @since 2.0.0
     * 
     * @return array
     */
    public static function users($where) {
        if(var_check(TYPE_ARRAY, $where)) {
            $result = database()->select('ph_users', ['*'], $where);

            if($result->hasResult()) {
                $o = [];

                foreach ($result as $i) {
                    array_push($o, new PH_User([
                        "id" => $i->id,
                        "username" => $i->user_username,
                        "password_hash" => $i->user_password,
                        "email" => $i->user_email
                    ]));
                }

                return $o;
            } else return [];

        } else return [];
    } 

    /**
     * Queries menu items from the database
     * 
     * @param array $where The where data to query
     * 
     * @since 2.0.0
     * 
     * @return array
     */
    public static function menu_items($where) {

        if(qp_set('dbless')) {
            return [];
        }

        if(var_check(TYPE_ARRAY, $where)) {
            $result = database()->select('ph_menu_items', ['*'], $where);

            if($result->hasResult()) {
                $o = [];

                foreach ($result as $i) {
                    array_push($o, new PH_Menu_Item([
                        "id" => $i->id,
                        "menu_name" => $i->item_menu_name,
                        "display_text" => $i->item_display_text,
                        "active_id" => $i->item_active_id,
                        "links_to" => $i->item_links_to,
                        "parent" => $i->item_parent
                    ]));
                }

                return $o;
            } else return [];

        } else return [];
    }

    /**
     * Queries a taxonomy term from the database
     * 
     * @since 2.0.0
     */
    public static function taxonomy($where) {
        if(var_check(TYPE_ARRAY, $where)) {
            $result = database()->select('ph_taxonomy', ['*'], $where);

            if($result->hasResult()) {
                $o = [];

                foreach ($result as $i) {
                    array_push($o, new PH_Taxonomy([
                        "id" => $i->id,
                        "record_id" => $i->record_id,
                        "type" => $i->taxonomy_type,
                        "value" => $i->taxonomy_value
                    ]));
                }

                return $o;
            } else return [];

        } else return [];
    }

}
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
                        "created_gmt" => $i->created_gmt,
                        "updated_gmt" => $i->updated_gmt,
                        "author" => $i->record_author
                    ]);

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
                        "value" => $i->setting_value
                    ]));
                }

                return $o;
            } else return [];

        } else return [];
    }

}
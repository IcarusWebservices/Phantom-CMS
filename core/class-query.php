<?php
/**
 * The query class contains queries that can be used.
 * 
 * @since 1.0.0
 */
class PH_Query {

    public static function get_record_by_id($id) {
        global $database;

        $result = $database->query("SELECT * FROM `records` WHERE `id` = ?", [["i", $id]]);

        if($result) {
            $r = $result[0];

            $record = new PH_Record( $r["id"], $r["data_type"], $r["slug"] or null, $r["content"], $r["created_at"], $r["updated_at"] or null, $r["created_by_user"] or null );
        
            return $record;
        } else {
            return false;
        }
    }

    public static function get_user_by_username($username) {
        global $database;

        $result = $database->query("SELECT * FROM `users` WHERE `username` = ?", [["s", $username]]);

        if($result) {
            $r = $result[0];

            $user = new PH_User($r["id"], $r["username"], $r["password_hash"]);

            return $user;
        } else {
            return false;
        }
    }

}
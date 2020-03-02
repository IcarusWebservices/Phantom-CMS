<?php
/**
 * Pre-made queries, easier to use
 * 
 * @since 2.0.0
 */

/**
 * Returns a menu from the database
 * 
 * @param string $menu_name The name of the menu
 * 
 * @since 2.0.0
 */
function get_menu($menu_name) {
    global $q_site;
    $result = PH_Query::menu_items([
        "==item_menu_name" => $menu_name,
        "NLitem_parent" => null,
        "==site" => isset($q_site) ? $q_site->id : null
    ]);
    return $result;
}

/**
 * Returns an array of posts by taxonomy type and value
 * 
 * @since 2.0.0
 */
function get_records_by_taxonomy( $record_type, $taxonomy_type, $taxonomy_value ) {

    

}
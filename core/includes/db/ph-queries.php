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
    $result = PH_Query::menu_items([
        "==item_menu_name" => $menu_name,
        "NLitem_parent" => null
    ]);
    return $result;
}
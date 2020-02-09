<?php
/**
 * Represents a menu item within the Database
 * 
 * @since 2.0.0
 */
class PH_Menu_Item extends PH_Model_Base {

    public $id = null;
    public $menu_name = 'main';
    public $display_text = null;
    public $active_id = null;
    public $links_to = null;
    public $parent = null;
    public $sub_items = [];

    /**
     * Constructor
     * 
     * @param array $data                   Object parameters delivered in an array form
     * @param bool $sub_items_auto_query    Whether the constructor should automatically query the database for sub items
     * 
     * @since 2.0.0
     */
    public function __construct($data, $sub_items_auto_query = true)
    {
        $this->processInputData($data);
        $this->querySubItems();
    }

    /**
     * Whether the menu item has sub-items
     * 
     * @since 2.0.0
     * 
     * @return
     */
    public function hasSubItems() {
        if(count($this->sub_items) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function querySubItems() {
        if($this->id) {
            $items = PH_Query::menu_items([
                "==item_parent" => $this->id
            ]);

            $this->sub_items = $items;
        }
    }

}
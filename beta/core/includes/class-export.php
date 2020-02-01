<?php
/**
 * An export object contains certain items that need to be 'exported' to a registry or model.
 * 
 * Example: Template that needs to be exported to the global registry; Controller that needs to be exported to the logic-pack object.
 * 
 * @since 2.0.0
 */
class PH_Export {

    /**
     * The exported items, stored within an array
     * 
     * @since 2.0.0
     */
    protected $export = [];

    /**
     * The name of the item being exported
     * 
     * @since 2.0.0
     */
    public $name;

    /**
     * The constructor method
     * 
     * @param string $name The name of the item being exported
     * 
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Sets a proporty
     * 
     * @param string $name  The name of the proporty
     * @param mixed $value  The value of the proporty
     * 
     * @since 2.0.0
     * 
     * @return void
     */
    public function setProperty($name, $value) {
        $this->export[$name] = $value;
    }

    /**
     * Returns a proporty
     * 
     * @param string $name  The name of the proporty
     * 
     * @since 2.0.0
     * 
     * @return mixed The item
     */
    public function getProperty($name) {
        if(isset($this->export[$name])) {
            return $this->export[$name];
        } else {
            return null;
        }
    }

}
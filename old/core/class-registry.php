<?php
/**
 * The registry class.
 * Contains registered items.
 * 
 * @since 1.0.0
 */
class PH_Registry {

    /**
     * The registry array.
     * Contains all the registered data.
     * 
     * How the registry works:
     * Each item is stored within a category, which is then stored in a namespace.
     * The namespace can be one of three things (custom namespaces are also allowed):
     * - @this: Used within a project. @this refers to the current project & the project selected at runtime.
     * - @global: Used by extensions. Adds registered items without binding it to a project.
     * - @system: Used by the Phantom system itself.
     * 
     * The category is usually the type of item that you're registering, like `controllers` or `datacontrollers`.
     *  
     */
    protected $registry = [];

    /**
     * Adds an item to the registry
     * 
     * @param string $namespace The namespace to register to.
     * @param string $category  The category to register to.
     * @param string $name      The name of the registered item. Used to refer to the item.
     * @param mixed  $value     The value of the item. Can be a class name.
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function addItem($namespace, $category, $name, $value) {
        $this->prepareCategory($namespace, $category);

        $this->registry[$namespace][$category][$name] = $value;
    }

    /**
     * Gets an item from the registry
     * 
     * @param string $namespace The item's namespace
     * @param string $category  The item's category
     * @param string $name      The item's name
     * 
     * @return mixed|null The item OR null if the item doesn't exist
     */
    public function getItem($namespace, $category, $name) {
        if($this->itemExists($namespace, $category, $name)) {
            return $this->registry[$namespace][$category][$name];
        }
    }

    /**
     * Checks whether an item exists
     * 
     * @param string $namespace The item's namespace
     * @param string $category  The item's category
     * @param string $name      The item's name
     * 
     * @return bool
     */
    public function itemExists($namespace, $category, $name) {
        return isset($this->registry[$namespace][$category][$name]);
    }

    /**
     * Prepares a category before adding items to it.
     * 
     * Should be called whenever adding an item to the category.
     * 
     * @param string $namespace The namespace to check.
     * @param string $category  The category to check.
     */
    protected function prepareCategory($namespace, $category) {

        if(!isset($this->registry[$namespace])) {
            $this->registry[$namespace] = [
                $category => []
            ];
        } else {
            if(!isset($this->registry[$namespace][$category])) {
                $this->registry[$namespace][$category] = [];
            }
        }

    }

    /**
     * Returns all the items within an category
     * 
     * @param string $namespace The namespace to get the category from
     * @param string $category  The name of the category
     * 
     * @since 1.0.0
     * 
     * @return array|null
     */
    public function getCategory($namespace, $category) {
        if(isset($this->registry[$namespace][$category])) {
            return $this->registry[$namespace][$category];
        } else {
            return null;
        }
    }

}
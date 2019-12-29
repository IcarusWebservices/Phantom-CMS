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

    }

    /**
     * Prepares a category before adding items to it.
     * 
     * Should be called whenever adding an item to the category.
     * 
     * @param string $namespace The namespace to check.
     * @param string $category  The category to check.
     */
    protected function prepareCategory() {
        
    }

}
<?php
/**
 * Contains functions related to the global registry
 * 
 * @since 1.0.0
 */

/**
 * Checks whether an item is registered to the global registry
 * 
 * @param string $namespace The namespace of the registered item
 * @param string $category  The category of the item
 * @param string $name      The item's name
 * 
 * @return bool
 */
function ph_registered( $namespace, $category, $name ) {
    global $registry;

    return $registry->itemExists($namespace, $category, $name);
}

/**
 * Gets an item from the global registry
 * 
 * @param string $namespace The namespace of the registered item
 * @param string $category  The category of the item
 * @param string $name      The item's name
 * 
 * @return mixed The item
 */
function ph_get_registered_item($namespace, $category, $name) {
    global $registry;

    return $registry->getItem($namespace, $category, $name);
}

/**
 * Registers an item to the global registry
 * 
 * @param string $namespace The namespace to register to
 * @param string $category  The category of the item that is being registered
 * @param string $name      The name of the item that is being registered
 * @param string $value     The item to register
 * 
 * @return void
 */
function ph_register($namespace, $category, $name, $value) {

    await(EVENT_REGISTRY_SETUP, function($data) {
        global $registry;

        $registry->addItem($data["namespace"], $data["category"], $data["name"], $data["value"]);
    }, [
        "namespace" => $namespace,
        "category" => $category,
        "name" => $name,
        "value" => $value
    ]);
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
function ph_registry_get_category($namespace, $category) {
    global $registry;
    return $registry->getCategory($namespace, $category);
}
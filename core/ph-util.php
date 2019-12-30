<?php
// General utility functions

/**
 * Checks if a class inherits another class
 * 
 * @param string $class_name    The name of the class to check.
 * @param string $inherit_class The name of the class that the other class is inheriting.
 * 
 * @return bool
 */
function ph_check_class_inherits($class_name, $inherit_class) {

    $reflection = new ReflectionClass($class_name);

    if($reflection->isSubclassOf($inherit_class)) {

        return true;

    } else {
        return false;
    }

}
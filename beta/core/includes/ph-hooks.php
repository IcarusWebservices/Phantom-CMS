<?php
/**
 * This file contains functions related to hooks
 * 
 * @since 2.0.0
 */

/**
 * Adds a hook to the global hook manager
 * 
 * @param string $hookname  The name of the hook
 * @param callback $hook    The hook function
 * 
 * @since 2.0.0
 */
function add_hook($hookname, $hook) {
    global $hooks;

    if($hooks instanceof PH_Hooks) {
        $hooks->addHook($hookname, $hook);
    }
}

/**
 * Does a hook on the global hook manager
 * 
 * @param string $hookname  The name of the hook
 * @param array  $arguments The arguments to be passed to the hooks
 * 
 * @since 2.0.0
 */
function do_hook($hookname, $arguments) {
    global $hooks;

    if($hooks instanceof PH_Hooks) {
        $hooks->doHook($hookname, $arguments);
    }
}
<?php
/**
 * This file contains functions related to hooks
 * 
 * @since 2.0.0
 */

/**
 * Adds a hook to the global hook manager
 * 
 * @param string $hookname          The name of the hook
 * @param callback $hook            The hook function
 * @param array $pass_parameters    Parameters to pass to the hook function on call
 * 
 * @since 2.0.0
 */
function add_hook($hookname, $hook, $pass_parameters = []) {
    global $hooks;

    if($hooks instanceof PH_Hooks) {
        $hooks->addHook($hookname, $hook, $pass_parameters);
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

/**
 * Adds javascript to the body
 * (Shorthand for the 'javascript_queue' hook)
 * 
 * @since 2.0.0
 */
function add_javascript($javascript) {
    add_hook(HOOK_JAVASCRIPT_QUEUE, function($p) {
        $js = $p[0];
        
        if(var_instanceof($js, 'PH_Requested_Script')) {
            $js->render();
        } elseif(var_check(TYPE_STRING, $js)) {
            echo $js;
        }
    }, [$javascript]);
}
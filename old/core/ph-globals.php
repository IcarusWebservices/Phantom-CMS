<?php
/**
 * This file contains functions related to global variables
 * 
 * @since 1.0.0
 */

/**
 * Returns the global session controller
 * 
 * @since 1.0.0
 * 
 * @return PH_Session The global session
 */
function session() {
    global $session;
    return $session;
}
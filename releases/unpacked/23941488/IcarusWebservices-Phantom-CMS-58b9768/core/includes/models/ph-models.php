<?php
/**
 * This file contains functions to easily instantiate certain models
 * 
 * @since 2.0.0
 */

/**
 * Creates a stylesheet request
 * 
 * @param string $relative_uri The relative uri to the root. Use uri_resolve();
 * 
 * @since 2.0.0
 */
function request_stylesheet($relative_uri) {
    return new PH_Requested_Stylesheet($relative_uri);
}

/**
 * Creates a script request
 * 
 * @param string|null $uri  (Optional) The uri to the javascript file. 
 *                          If empty, will take in a direct javascript string
 * @param string|null $raw  (Optional) The javascript string if no URI was provided
 * 
 * @param string|null $extra_attb (Optional) extra attributes HTML
 * 
 * @since 2.0.0
 */
function request_script($uri = null, $raw = null, $extra_attb = null) {
    return new PH_Requested_Script($uri, $raw);
}
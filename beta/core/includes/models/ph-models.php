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
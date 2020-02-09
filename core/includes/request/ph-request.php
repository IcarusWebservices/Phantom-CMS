<?php
/**
 * This file contains functions related to the request
 * 
 * @since 2.0.0
 */

/**
 * Checks whether query parameter(s) are set
 * 
 * @since 2.0.0
 */
function qp_set() {
    
    global $request;

    $args = func_get_args();

    $found_all = true;

    foreach ($args as $arg) {
        if($found_all) {
            if( !isset($request->query_parameters[$arg]) ) {
                $found_all = false;
            }
        }
    }

    return $found_all;

}

/**
 * Gets a query parameters
 * 
 * @param string $query_parameter The name of the QP
 * 
 * @since 2.0.0
 * 
 * @return mixed|null
 */
function qp_get($query_parameter) {
    global $request;

    if(qp_set($query_parameter)) {
        return $request->query_parameters[$query_parameter];
    } else return null;
}

/**
 * Gets a form parameters
 * 
 * @param string $form_parameter The name of the FP
 * 
 * @since 2.0.0
 * 
 * @return mixed|null
 */
function fd_get($form_parameter) {
    global $request;

    if(fd_set($form_parameter)) {
        return $request->form_parameters[$form_parameter];
    } else return null;
}

/**
 * Tests whether form parameters are set
 * 
 * @since 2.0.0
 */
function fd_set() {
    global $request;

    $args = func_get_args();

    $found_all = true;

    foreach ($args as $arg) {
        if($found_all) {
            if( !isset($request->form_parameters[$arg]) ) {
                $found_all = false;
            }
        }
    }

    return $found_all;
}

/**
 * Checks whether the request method is a specific method
 * 
 * @since 2.0.0
 */
function request_method_is($method) {
    global $request;
    return $request->request_method === $method;
}

/**
 * Sets a redirect header
 * 
 * @param string $uri The uri to redirect to
 * 
 * @return void
 * 
 * @since 2.0.0
 */
function redirect($uri) {

    header('Location: ' . $uri);

    die;

}
<?php
/**
 * This file contains functions related to requests
 * 
 * @since 1.0.0
 */

/**
 * Checks whether a QP was set from a request
 * 
 * @param string $query_parameter   The name of the QP
 * @param PH_Request $request       (Optional) The request to get the QP from. If not set will create a new request
 * 
 * @since 1.0.0
 * 
 * @return bool 
 */
function ph_qp_set($query_parameter, $request = null) {

    if($request) $r = $request;
    else $r = new PH_Request();

    return isset($r->query_parameters[$query_parameter]);
        
}

/**
 * Gets a QP from a request.
 * 
 * @param string $query_parameter   The name of the QP
 * @param PH_Request $request       (Optional) The request to get the QP from. If not set will create a new request
 * 
 * @since 1.0.0
 * 
 * @return mixed|null
 */
function ph_qp_get($query_parameter, $request = null) {

    if($request) $r = $request;
    else $r = new PH_Request();


    if(ph_qp_set($query_parameter, $r)) {
        return $r->query_parameters[$query_parameter];
    } else {
        return null;
    }

}

/**
 * Checks whether a form parameter (or multiple if an array is provided) is set
 * 
 * @param string|array $form_parameters The name of the form parameters
 * @param PH_Request $request           (Optional) the request to get the parameters from. Otherwhise creates a new request.
 * 
 * @since 1.0.0
 * 
 * @return bool
 */
function ph_fp_set($form_parameters, $request = null) {

    if($request) {
        $r = $request;
    } else {
        $r = new PH_Request();
    }

    if(is_array($form_parameters)) {
        foreach ($form_parameters as $param) {
            if(!isset($r->form_data[$param])) {
                return false;
            }
        }
        return true;
    } else {
        return isset($r->form_data[$form_parameters]);
    }
}

/**
 * Returns a value from the form parameters
 * 
 * @param string $form_parameter    The name of the form parameter
 * @param PH_Request $request       (Optional) The request to get the form parameters from
 * 
 * @since 1.0.0
 * 
 * @return mixed|null
 */
function ph_fp_get($form_parameter, $request = null) {
    if($request) {
        $r = $request;
    } else {
        $r = new PH_Request();
    }

    if(ph_fp_set($form_parameter, $r)) {
        return $r->form_data[$form_parameter];
    } else {
        return null;
    }
}
<?php
/**
 * Sends a quick json response, without having to fully type out a class constructor
 * 
 * @param bool $is_error        Whether the request resulted in an error
 * @param array $data           (Optional) The data to attach to the request if it is not an error
 * @param string $error_reason  (Optional) The reason why an error was provided
 * 
 * @since 1.0.0
 */
function json_response($is_error, $data = null, $error_reason = null) {
    $r = new PH_JSON_Response($is_error, $data, $error_reason);
    $r->respond();
}
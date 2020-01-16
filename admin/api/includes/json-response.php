<?php
/**
 * Represents an JSON response
 * 
 * @since 1.0.0
 */
class PH_JSON_Response {

    protected $response_data = [];

    public function __construct($is_error = false, $data = null, $error_reason = null)
    {
        $this->response_data = [
            "error" => $is_error
        ];

        if($is_error) {
            $this->response_data["reason"] = $error_reason;
        } else {
            $this->response_data["data"] = $data;
        }
    }

    public function respond() {

        header("Content-Type: application/json");

        echo json_encode($this->response_data);
    }

}
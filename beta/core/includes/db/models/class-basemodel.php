<?php
/**
 * The base model class
 * 
 * Models inherit this class
 * 
 * @since 2.0.0
 */
class PH_Model_Base {

    /**
     * Takes input data and transforms it into proporties
     * 
     * @param array $data the input data
     * 
     * @since 2.0.0
     */
    protected function processInputData($data) {
        foreach ($data as $var_name => $value) {
            if(property_exists($this, $var_name)) {
                $this->$var_name = $value;
            }
        }
    }

}
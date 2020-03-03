<?php
/**
 * The data object stores data to be used by templates
 * 
 * @since 2.0.0
 */
class PH_Data {

    /**
     * Data array
     * 
     * @since 2.0.0
     */
    protected $data = [];

    /**
     * The current location.
     * Default to be the same as the data array
     * 
     * @since 2.0.0
     */
    protected $location = [];

    /**
     * Getter function
     * 
     * @since 2.0.0
     */
    public function __get($name)
    {
        if(isset($this->location[$name])) {
            
            $var = $this->location[$name];

            if( var_check(TYPE_ARRAY, $var) ) {

                if(array_keys($var) !== range(0, count($var) - 1)) {
                    $copy = new PH_Data($this->data, $var);
                    return $copy;
                } else {
                    return $var;
                }

            } else return $var;

        }
    }

    /**
     * Checks if a var has been set
     * 
     * @since 2.0.0
     */
    public function __has($var) {
        return isset($this->location[$var]);
    }

    /**
     * Constructor
     * 
     * @since 2.0.0
     */
    public function __construct($data, $location = null)
    {
        $this->data = $data;

        if(var_check(TYPE_ARRAY, $location)) {
            $this->location = $location;
        } else $this->location = $data;
        
    }

}
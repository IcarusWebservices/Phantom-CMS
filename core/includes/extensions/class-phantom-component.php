<?php
/**
 * A Phantom Component is a component that is part of Phantom.
 * Extensions can append to or edit components
 */
class PH_Phantom_Component {

    /**
     * The type of the component.
     * 
     * Phantom natively supports a few different types:
     * - `array` The component consists of an array which can be edited by extensions.
     * 
     * @since 2.0.0
     */
    public $type;

    /**
     * (This method should only be used by the CSR)
     */

    /**
     * Processes data and returns set data
     * 
     * @param callback $cb The processing callback function. Takes as argument the data. The return value will be the return value of this method.
     * 
     * @return mixed The return value from the $cb callback.
     * 
     * @since 2.0.0
     */
    public function processData($cb) {
        if(var_check(TYPE_FUNCTION, $cb)) {
            $val = $cb($this->data);
            return $val;
        } else {
            return $this->data;
        }
    }

    /**
     * Constructor
     * 
     * @param string $type (See $type for all the types available)
     * 
     * @since 2.0.0
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

}
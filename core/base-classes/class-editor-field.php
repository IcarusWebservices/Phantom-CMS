<?php
/**
 * The base editor field class
 * 
 * Inherit to create a editor field
 * 
 * @since 1.0.0
 */
abstract class PH_Editor_Field {

    /**
     * This method must render the editor field
     */
    abstract function renderField($fieldID, $preData);

}
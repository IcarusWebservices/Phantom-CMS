<?php
/**
 * Inherit to create a template record type
 * 
 * @since 2.0.0
 */
abstract class PH_Template_Record_Type {

    /**
     * Renders the record type
     * 
     * @param mixed $data   The data delivered by the database
     * @param int $slug     The slug of the database record
     * 
     * @since 2.0.0
     */
    public function render($data, $slug) {
        $this->body($data);
    }

    /**
     * Renders the body
     * 
     * @param string $data The data delivered by the database
     * 
     * @since 2.0.0
     */
    abstract protected function body( $data );

    /**
     * Renders an editor
     * 
     * @param mixed $data The data to be displayed
     * @param string $slug The slug.
     * @param string $record_type The name of the record type
     * 
     * @since 2.0.0
     */
    abstract public function editor( $data, $slug, $record_type );

    /**
     * Should save the template record
     * 
     * @param array $data The input data
     * 
     * @since 2.0.0
     */
    abstract public function save( $data );

}
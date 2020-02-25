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
        global $is_in_customizer_mode;

        if($is_in_customizer_mode) {
            ?>
            <div class="__customizer_block" data-slug="<?= $slug ?>">
                <span style="background-color:white;border:1px solid black;padding:5px;">Edit</span>
                <?php
                    $this->body($data);
                ?>
            </div>
            <?php
        } else {
            $this->body($data);
        }
    }

    /**
     * Renders the body
     * 
     * @param string $data The data delivered by the database
     * 
     * @since 2.0.0
     */
    abstract protected function body( $data );

}
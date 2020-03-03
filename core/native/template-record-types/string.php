<?php
/**
 * The string template record type
 * 
 * @since 2.0.0
 */
class PH_String_TRT extends PH_Template_Record_Type {

    protected function body($data) {
        echo $data;
    }

    public function editor($data) {
        if($data) {
            ?>
            <textarea cols="30" rows="10"><?= $data ?></textarea>
            <?php
        } else {
            ?>
            <textarea cols="30" rows="10"></textarea>
            <?php
        }
    }

}

return export('string', [
    "class" => "PH_String_TRT"
]);
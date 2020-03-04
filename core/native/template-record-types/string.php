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

    public function editor($data, $slug, $record_type) {
        if($data) {
            ?>
            <textarea cols="30" rows="10" name="customizer:<?= $record_type . ':' . $slug . ':content' ?>"><?= $data ?></textarea>
            <?php
        } else {
            ?>
            <textarea cols="30" rows="10" name="customizer:<?= $record_type . ':' . $slug . ':content' ?>"></textarea>
            <?php
        }
    }

    public function save($data)
    {
        return isset($data["content"]) ? $data["content"] : "Invalid string!";
    }

}

return export('string', [
    "class" => "PH_String_TRT"
]);
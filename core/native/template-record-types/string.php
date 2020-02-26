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

}

return export('string', [
    "class" => "PH_String_TRT"
]);
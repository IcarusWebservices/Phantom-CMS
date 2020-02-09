<?php
/**
 * Renders an editor field
 */
function ph_admin_get_editor_field($fieldname, $exportID, $editordata = null) {

    if(ph_registered("@global", "editorfields", $fieldname)) {

        $class = ph_get_registered_item("@global", "editorfields", $fieldname);

        if(class_exists($class)) {

            $instance = new $class;

            $instance->renderField($exportID, $editordata);

        } 

    }

}
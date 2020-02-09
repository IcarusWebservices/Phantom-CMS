<?php
/**
 * The record editor
 * 
 * @since 2.0.0
 */
require_once 'admin-setup.php';
login_required();

if(!qp_set('mode')) {
    redirect(uri_resolve('/admin/index'));
}

$mode = qp_get('mode');

$predata = null;

$type = null;

switch($mode) {
    case "edit":

        if(!qp_set('id')) redirect(uri_resolve('/admin/index'));

        $id = (int) qp_get('id');
        // var_dump($id);
        if(!var_check(TYPE_INT, $id)) redirect(uri_resolve('/admin/index'));

        $record = PH_Query::records([
            '==record_id' => $id
        ]);

        if(count($record) > 0) {
            $record = $record[0];

            $type = $record->type;

        } else redirect(uri_resolve('/admin/index'));

    break;
}

// Try to find field data
$field_data = null;
foreach ($loaded_packs as $pack) {
    if(isset($pack->editors->record_types->$type)) {
        $field_data = $pack->editors->record_types->$type;
    }
}

admin_template("Edit", $menu, function() {
    global $predata, $record, $field_data;
?>
<form action="<?= uri_resolve('/admin/actions/save-record') ?>" method="post">
    <input type="text" name="system:title" class="editor-title" placeholder="Title">
    <div id="editors">
        <div id="primary">
            <?php

                if(isset($field_data->primary)) {
                    // echo 0;
                    if(var_check(TYPE_ARRAY, $field_data->primary)) {
                        // echo 1;
                        foreach ($field_data->primary as $data) {
                            $exportID = isset($data->exportid) ? $data->exportid : null;
                            $fieldSlug = isset($data->fieldslug) ? $data->fieldslug : null;

                            $field = registry()->get(CAT_EDITOR_FIELDS, $fieldSlug);

                            if($field) {
                                // echo 2;
                                if($field->hasProperty('class')) {
                                    // echo 3;
                                    $class = $field->getProperty('class');

                                    if(class_exists($class)) {
                                        // echo 4;
                                        $instance = new $class;

                                        if(var_inherits($instance, 'PH_Editor_Field')) {
                                            // echo 5;
                                            $instance->render($exportID, []);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            ?>
        </div>
        <div id="side">
            <div class="field">
                <label for="system:status">Status: </label>
                Published <input type="radio" name="system:status" value="published">
                Private <input type="radio" name="system:status" value="private">
            </div>
            
        </div>
    </div><br>
    
    <input type="submit" value="Save">
</form>
<?php
}, "collection:recordtypes", $type);
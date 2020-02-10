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
$processed_mode = null;

$predata = null;

$type = null;

switch($mode) {
    case "edit":

        $processed_mode = 'save-edit';

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
            $tce = registry()->get(CAT_RECORD_TYPES, $type);

            if($tce) {
                $class = $tce->getProperty('class');
                $type_controller = new $class;
            }
            

        } else redirect(uri_resolve('/admin/index'));

    break;

    case "new":
        $processed_mode = 'save-new';

        if(!qp_set('type')) redirect(uri_resolve('/admin/index'));

        $type = qp_get('type');

        $tce = registry()->get(CAT_RECORD_TYPES, $type);

        if($tce) {
            $class = $tce->getProperty('class');
            $type_controller = new $class;
        }
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
    global $type_controller, $record, $field_data, $processed_mode, $type;
?>
<div class="" id="snackbar-saved">Record saved!</div>
<form action="<?= uri_resolve('/admin/actions/save-record') ?>" method="post" id="recordsform">
    <?php
        if($processed_mode == 'save-edit' || $processed_mode == 'draft-edit' && $record) {
            ?><input type="hidden" name="system:id" value="<?= $record->id ?>"><?php
        }
    ?>
    <input type="hidden" name="system:mode" value="<?= $processed_mode ?>">
    <input type="hidden" name="system:recordtype" value="<?= $type ?>">
    <input type="text" id="title" name="system:title" class="editor-title" placeholder="Title" value="<?= isset($record) ? $record->title : null ?>" required>
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
                            $required = isset($data->required) ? $data->required : false;

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
                                            
                                            if($record && $type_controller) {
                                                $editordata = $type_controller->provideEditordata( $record->content );
                                                
                                                if(isset($editordata[$exportID])) {
                                                    $instance->render($exportID, $editordata[$exportID], $required);
                                                } else $instance->render($exportID, [], $required);
                    
                                            } else {
                                                $instance->render($exportID, [], $required);
                                            }

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
                Published <input type="radio" name="system:status" value="published" checked>
                Private <input type="radio" name="system:status" value="private">
            </div>
            <div class="field">
                Slug: <input type="text" id="slug" name="system:slug" value="<?= isset($record) ? $record->slug : null ?>" required>
            </div>
        </div>
    </div><br>
    
    <input type="submit" value="Save">
</form>
<script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
<script src="<?= uri_resolve('/admin/js/record.js') ?>"></script>
<?php
}, "collection:recordtypes", $type);
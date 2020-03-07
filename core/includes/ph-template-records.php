<?php
/**
 * The template records related functions
 * 
 * @param string $slug          The slug used to query the record from the database
 * @param string $new_type      (Optional) If the record doesn't exist yet, it will create a new one with this type. 
 *                              (! Phantom only creates a new record IF both $new_ arguments are set)
 * @param string $new_def_data  (Optional) The default data used when the record doesn't exist yet.
 *                              (! Phantom only creates a new record IF both $new_ arguments are set)
 * 
 * @since 2.0.0
 * 
 * @return void
 */
function get_template_record($slug, $new_type = null, $new_def_data = null) {
    global $language_code, $q_site, $is_in_customizer_mode;
    $where = [
        "==template_record_slug" => $slug,
        "__OR" => [
            [
                "==template_record_language" => ["en", $language_code]
            ]
        ],
        "==site" => isset($q_site->id) ? $q_site->id : null
    ];

    $r = PH_Query::template_record($where);

    if(count($r) > 0) {

        $record = $r[0];

        $type = $record->type;

        $tys = registry()->get(CAT_TEMPLATE_RECORD_TYPES, $type);

        if($tys) {
            if($tys->hasProperty('class')) {

                $class = $tys->getProperty('class');

                if(class_exists($class)) {

                    $instance = new $class;

                    if(var_inherits($instance, 'PH_Template_Record_Type')) {
                        ?>
                        <div class="__template_record">
                        <?php
                        if($is_in_customizer_mode) {
                            ?>
                            <div class="__c_modal" data-type="edit" data-slug="<?= $record->slug ?>">
                                <div class="__c_modal-content">
                                <div class="__c_modal-header">
                                    <h2>Edit</h2>
                                </div>
                                <div class="__c_modal-body">
                                    <?php $instance->editor($record->data, $record->slug, $record->type); ?>
                                </div>
                                <div class="__c_modal-footer">
                                    <div class="action">
                                    <a class="__c_button neutral semi-rounded __customizer_editor_cancel">Cancel</a>
                                    <input class="__c_button button semi-rounded __customizer_editor_save" type="submit" value="Save">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php $instance->render($record->data, $record->slug); ?>
                            <a href="#" class="__c_button blue __customizer_editor_open" data-slug="<?= $slug ?>">Edit</a>
                            <?php
                        } else {
                            $instance->render($record->data, $record->slug);
                        }
                        ?>
                        </div>
                        <?php
                    }
                    
                }

            }
        } 

    } else {
        // First, try if there is any version of this string on the database
        $w = [
            "==template_record_slug" => $slug,
            "==site" => isset($q_site->id) ? $q_site->id : null
        ];


        $t = PH_Query::template_record($w);

        if(count($t)>0) {

            $record = $t[0];

            $type = $record->type;

            $tys = registry()->get(CAT_TEMPLATE_RECORD_TYPES, $type);

            if($tys) {
                if($tys->hasProperty('class')) {

                    $class = $tys->getProperty('class');

                    if(class_exists($class)) {

                        $instance = new $class;

                        if(var_inherits($instance, 'PH_Template_Record_Type')) {
                            ?>
                            <div class="__template_record">
                            <?php
                            if($is_in_customizer_mode) {
                                ?>
                            <div class="__c_modal" data-type="new" data-slug="<?= $record->slug ?>">
                                <div class="__c_modal-content">
                                <div class="__c_modal-header">
                                    <h2>Edit</h2>
                                </div>
                                <div class="__c_modal-body">
                                    <p><?php $instance->editor($record->data, $record->slug, $record->type); ?></p>
                                </div>
                                <div class="__c_modal-footer">
                                    <div class="action">
                                    <a class="__c_button neutral semi-rounded __customizer_editor_cancel">Cancel</a>
                                    <input class="__c_button button semi-rounded __customizer_editor_save" type="submit" value="Save">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php $instance->render($record->data, $record->slug); ?>
                            <a href="#" class="__c_button blue __customizer_editor_open" data-slug="<?= $slug ?>">Edit</a>
                            <?php
                            } else {
                                $instance->render($record->data, $record->slug);
                            }
                            ?>
                            </div>
                            <?php
                        }
                        
                    }

                }
            } 

        } else {

            if($new_type && $new_def_data) {
                $tys = registry()->get(CAT_TEMPLATE_RECORD_TYPES, $new_type);

                if($tys) {
                    if($tys->hasProperty('class')) {
    
                        $class = $tys->getProperty('class');
    
                        if(class_exists($class)) {
    
                            $instance = new $class;
    
                            if(var_inherits($instance, 'PH_Template_Record_Type')) {
                                ?>
                                <div class="__template_record">
                                <?php
                                if($is_in_customizer_mode) {
                                    ?>
                            <div class="__c_modal" data-type="new" data-slug="<?= $slug ?>">
                                <div class="__c_modal-content">
                                <div class="__c_modal-header">
                                    <h2>Edit</h2>
                                </div>
                                <div class="__c_modal-body">
                                    <p><?php $instance->editor($new_def_data, $slug, $new_type); ?></p>
                                </div>
                                <div class="__c_modal-footer">
                                    <div class="action">
                                    <a class="__c_button neutral semi-rounded __customizer_editor_cancel">Cancel</a>
                                    <input class="__c_button button semi-rounded __customizer_editor_save" type="submit" value="Save">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php $instance->render($new_def_data, $slug); ?>
                            <a href="#" class="__c_button blue __customizer_editor_open" data-slug="<?= $slug ?>">Edit</a>
                            <?php
                                    
                                } else {
                                    $instance->render($new_def_data, $slug);
                                }
                                ?>
                                </div>
                                <?php
                            }
                            
                        }
    
                    }
                }
            }

           
        }
    }
}
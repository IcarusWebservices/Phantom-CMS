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
    global $language, $site_id;
    // var_dump($site_id);

    $where = [
        "==template_record_slug" => $slug,
        "__OR" => [
            [
                "==template_record_language" => ["en", $language]
            ]
        ]
    ];

    if(!$site_id) {
        $where["NLsite"] = null;
    } else {
        $where["==site"] = $site_id;
    }

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
                        $instance->render($record->data, $record->slug);
                    }
                    
                }

            }
        } 

    } else {
        // First, try if there is any version of this string on the database
        $w = [
            "==template_record_slug" => $slug
        ];
    
        if(!$site_id) {
            $w["NLsite"] = null;
        } else {
            $w["==site"] = $site_id;
        }

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
                            $instance->render($record->data, $record->slug);
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
                                $instance->render($new_def_data, $slug);
                            }
                            
                        }
    
                    }
                }
            }

           
        }
    }
}
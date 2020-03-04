<?php
require "../admin-setup.php";
login_required();

// Process all form parameters
if(request_method_is(POST)) {

    $target_language = 'en';

    $tr = [];

    foreach ($_POST as $name => $value) {
        
        if(substr($name, 0, strlen('customizer')) == 'customizer') {
            // Candidate

            $methods = explode(':', $name);

            if(count($methods) == 4) {
                
                if($methods[0] == 'customizer') {

                    if(registry()->has(CAT_TEMPLATE_RECORD_TYPES, $methods[1])) {

                        $slug = $methods[2];

                        $tr[$slug] = [
                            "type" => $methods[1]
                        ];

                        if(isset($tr[$slug]["fields"])) {
                            $tr[$slug]["fields"][$methods[3]] = $value;
                        } else {
                            $tr[$slug]["fields"] = [
                                $methods[3] => $value
                            ];
                        }

                    }

                }

            }

        }

    }

    // Now process all the fields

    foreach ($tr as $slug => $data) {
        $type = $data["type"];

        $e = registry()->get(CAT_TEMPLATE_RECORD_TYPES, $type);

        if($e->hasProperty('class')) {

            $class = $e->getProperty('class');

            if(class_exists($class)) {
                $instance = new $class;

                $content = $instance->save( $data["fields"] );

                // Now check if the record already exists

                $ex = PH_Query::template_record([
                    "==template_record_type" => $type,
                    "==template_record_slug" => $slug,
                    "==template_record_language" => $target_language
                ]);

                if(count($ex) > 0) {

                    $r = database()->update('ph_template_records', [
                        "template_record_data" => $content
                    ], [
                        "==template_record_id" => $ex[0]->id
                    ]);

                    if($r) {
                        echo "Succesful";
                    } else {
                        echo "Unsuccesful";
                    }

                } else {

                    $r = database()->insert('ph_template_records', [
                        "template_record_type" => $type,
                        "template_record_data" => $content,
                        "template_record_slug" => $slug,
                        "template_record_language" => $target_language,
                        "site" => isset($q_site->id) ? $q_site->id : null
                    ]);

                    if($r) {
                        echo "Succesful";
                    } else {
                        echo "Unsuccesful";
                    }

                }
            }

        }
    }

}
<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

if(!fd_set('system:mode', 'system:recordtype')) {
echo json_encode([
    "error" => true
]);
} else {

    $mode = fd_get('system:mode');
    $record_type = fd_get('system:recordtype');

    if(registry()->has(CAT_RECORD_TYPES, $record_type)) {
        $rt_e = registry()->get(CAT_RECORD_TYPES, $record_type);

        if($rt_e->hasProperty('class') && class_exists($rt_e->getProperty('class'))) {
            $class = $rt_e->getProperty('class');
            $instance = new $class();

            // The record's status
            $status = fd_set('system:status') ? fd_get('system:status') : PUBLISHED;

            // The record's title
            $title = fd_set('system:title') ? fd_get('system:title') : 'Untitled';

            // The record's slug
            $slug = fd_set('system:slug') ? fd_get('system:slug') : (string) random_int(-10000, 100000);

            $type = fd_set('system:recordtype') ? fd_get('system:recordtype') : null;

            $user_id = isset(session()->user->id) ? session()->user->id : 0;
            // var_dump($_POST);
            switch($mode) {

                case 'draft-new':
        
                break;
        
                case 'draft-edit':
        
                break;
        
                case 'save-new':
                    $sv = $instance->saveRecord($_POST);

                    $sv->status = $status;
                    $sv->title = $title;
                    $sv->slug = $slug;
                    $sv->type = $type;
                    $sv->author = $user_id;
                    // var_dump($sv);

                    $s = PH_Save::record($sv);

                    if($s->hasResult()) {

                        echo json_encode([
                            "error" => false,
                            "new" => true
                        ]);
                    } else {
                        echo json_encode([
                            "error" => true
                        ]);
                    }
                break;
        
                case 'save-edit':
                    if(fd_set('system:id')) {

                        $id = (int) fd_get('system:id');

                        if(var_check(TYPE_INT, $id)) {
                            $record = PH_Query::records([
                                "==record_id" => $id
                            ]);

                            if(count($record) > 0) {
                                $sv = $instance->saveRecord($_POST, $record[0]);

                                $sv->status = $status;
                                $sv->title = $title;
                                $sv->slug = $slug;
                                $sv->author = $user_id;
                               

                                $s = PH_Save::record($sv);

                                if($s->hasResult()) {
                                    echo json_encode([
                                        "error" => false
                                    ]);
                                }
                            } else {
                                echo json_encode([
                                    "error" => true
                                ]);
                            }
    
                            
                        } else {
                            echo json_encode([
                                "error" => true
                            ]);
                        }
                        
                    } else {
                        echo json_encode([
                            "error" => true
                        ]);
                    }
                break;
        
            }

        } else {
            echo json_encode([
                "error" => true
            ]);
        }
    } else {
        echo json_encode([
            "error" => true
        ]);
    }

    

}

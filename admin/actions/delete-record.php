<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

if(fd_set('id')) {
    $id = fd_get('id');

    if(is_numeric($id)) {

        $id = (int) $id;

        $r = PH_Query::records([
            "==record_id" => $id
        ]);

        if(count($r) > 0) {
            $result = database()->delete('ph_records', [
                "==record_id" => $id
            ]);

            if($result->hasResult()) {
                echo json_encode([
                    "error" => false
                ]);
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
} else {
    echo json_encode([
        "error" => true
    ]);
}

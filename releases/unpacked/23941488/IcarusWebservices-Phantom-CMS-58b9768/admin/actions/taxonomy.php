<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

if(qp_set('action')) {

    switch(qp_get('action')) {
        case "delete":

            if(fd_set('id')) {
                $id = (int) fd_get('id');

                $r = database()->delete('ph_taxonomy', [
                    "==id" => $id
                ]);

                if($r->hasResult()) {
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

        break;

        case "add":

            if(fd_set('value', 'type', 'recordid')) {
                $type = fd_get('type');
                $value = fd_get('value');
                $id = (int) fd_get('recordid');

                $r = database()->insert('ph_taxonomy', [
                    "record_id" => $id,
                    "taxonomy_value" => $value,
                    "taxonomy_type" => $type
                ]);

                if($r->hasResult()) {
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

        break;
    }

} else {
    echo json_encode([
        "error" => true
    ]);
}